<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/modal_info.php");
?>

<!doctype html>
<html lang="pl">
  <head>
    
    <title>INVENTORY</title>
    
    <link rel="stylesheet" href="../../../css/body_style.css">
    <link rel="stylesheet" href="../../../css/dashboard_style.css">
    <link rel="stylesheet" href="../../../css/notification_modals.css">
    <link rel="stylesheet" href="../../../css/products_style.css">
    <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">

    
  </head>

  <body>
  <body>

  
<?php
   echo'<div class="nav">';
   echo' <img src="../../../images/inventura_logo_full.png"/>';


   //Panel admina
   if($_SESSION['permission'] == 1){
    
    echo'
    <a href="../Dashboard/dashboard.php"><button>Strona główna</button></a>
    <a href="../Products/products.php"><button>Produkty</button></a>
    <a href="../Users/users.php"><button>Użytkownicy</button></a>
    <a href="../Reports/reports.php">   <button>Raporty</button></a>
    
    <a href="../Inventory/Inventory.php"><button>Inwentaryzacja</button></a>
    ';
   }
   
   //Panel użytkownika gdy nie ma inwentaryzacji
   if($_SESSION['permission'] == 0 && $_SESSION['activeInventory'] == 0){
      echo '<a href="../Dashboard/dashboard.php"><button>Strona główna</button></a>';
      echo '<a href="../Products/products.php"><button>Produkty</button></a>';
   }

   //Panel użytkownika gdy trwa inwentaryzacja
   if($_SESSION['permission'] == 0 && $_SESSION['activeInventory'] == 1){
        echo '<a href="../Inventory/Inventory.php"><button>Inwentaryzacja</button></a>';  
    }

     echo '<a href="../../auth/logout.php"><button>Wyloguj się</button></a>';
     echo'</div>';
?>


<div class="topLogo">  <img src="../../../images/inventura_logo_full.png"/> 

<div class="dropdown">
  <span> <img src="../../../images/more.png"> </span>
  <div class="dropdown-content">
      <ul> <a href="../Dashboard/dashboard.php">Strona główna</a> </ul>
      <ul> <a href="../Products/products.php">Produkty</a> </ul>
      <ul> <?php if($_SESSION['permission'] == 1) { echo '<a href="../Users/users.php">   Użytkownicy</a>'; } ?> </ul>
      <ul> <?php if($_SESSION['permission'] == 1) { echo '<a href="../Reports/reports.php">   Raporty</a>'; } ?> </ul> </ul>
      <ul> <a href="../../auth/logout.php">Wyloguj się</a> </ul>
  </div>
</div>
</div>


<div class="mainbox">
  <div class="topLogo">  <img name="menuBurger" src="../../../images/inventura_logo_full.png"/> </div>
  <div class="welcometext">Inwentaryzacje</div>
      <div class="tableOfProducts">
<?php
require_once "../../../includes/connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
} else {
    
        $rowsPerPage = 20; 
      $currentPage = $_GET['page'] ?? 1;
  
      $start = ($currentPage - 1) * $rowsPerPage;
  
      $sql = "SELECT inventorypositions.idp, inventorypositions.namep, inventorypositions.categoryp, inventorypositions.serialp, 
      inventorypositions.registrationp, inventorypositions.checked, uzytkownicy.login 
      FROM inventorypositions 
      LEFT JOIN uzytkownicy ON inventorypositions.userid = uzytkownicy.id LIMIT $start, $rowsPerPage";

      $result = $conn->query($sql);
  
      if($_SESSION['activeInventory'] == 1){
        echo '<table class="table_productsAll">';
        echo <<<END
          <thead>
            <tr>
             <th style="width: 3vw;">ID</th>
              <th style="width: 25vw;">Nazwa</th>
              <th>Kategoria</th>
              <th>Nr seryjny</th>
              <th>Nr ewidencyjny</th>
              <th>Status</th>
              <th>Ostatni sprawdzający</th>
              <th>Akcje</th>
            </tr>
          </thead>
          END;
        echo "<tbody>";
        
        if ($result->num_rows > 0) {
          
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["idp"] . "</td>";
                echo "<td>" . $row["namep"] . "</td>";
                echo "<td>" . $row["categoryp"] . "</td>";
                echo "<td>" . $row["serialp"] . "</td>";
                echo "<td>" . $row["registrationp"] . "</td>";
                echo "<td>" . $row["checked"] . "</td>";
                echo "<td>" . $row["login"] . "</td>";
                echo '<td><a href="#" id="myBtn" class="edit-inventory" data-id="' . $row["idp"] . '">Potwierdź</a></td>';
                echo "</tr>";
            }
    
            $totalRows = $conn->query("SELECT COUNT(*) as total FROM inventorypositions")->fetch_assoc()['total'];
            $totalPages = ceil($totalRows / $rowsPerPage);
    
            echo '<tr>';
            echo '<td colspan="8">';
            echo '<div class="pagination">';
            for ($i = 1; $i  <= $totalPages; $i++) {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
            echo '</div>';
            echo '</td>';
            echo '</tr>';
        } else {
            echo "<tr><td colspan='8'>Brak rekordów w tabeli.</td></tr>";
        }
    
        echo "</tbody>";
        echo "</table>";
      }
      if($_SESSION['activeInventory'] == 0)
      {
        echo'
        <h3>Brak aktywnej Inwentaryzacji<h3>
        <h4>Tutaj krótki opis jak wygląda inwentaryzacja...<h4>
        ';
      }
      


    $conn->close();
}
?>

<?php 
if($_SESSION['permission'] == 1){
  echo'<button id="myBtn2">Rozpocznij nową Inwentaryzację</button>';
  if($_SESSION['activeInventory'] == 1){
    echo '<button id="myBtn3">Zakończ Inwentaryzację</button>';
  }
}

?>

  <!-- MODAL EDYCJI PRODUKTU -->
  <div id="myModal" class="modalP">
    <div class="modal-contentP">
      <span class="closeP">&times;</span>
      <p></p>
    </div>
  </div>
  


  <!-- ROZPOCZĘCIE NOWEJ INWENTARYZACJI -->
  <div id="myModal2" class="modalA">
    <div class="modal-contentA">
      <span class="closeA">&times;</span>
      <h3>Czy na pewno chcesz rozpocząć nową inwentaryzację?</h3>
      <form id="addInventoryForm" action="addinventory.php" method="post">
          
          <input type="submit" value="Tak">
      </form>
    </div>
  </div>


    <!-- MODAL ZAKOŃCZENIA INWENTARYZACJI -->
    <div id="myModal3" class="modalD">
    <div class="modal-contentD">
      <span class="closeD">&times;</span>
      <h3>Czy na pewno chcesz zakończyć inwentaryzację?</h3>
      <i>Zakończenie inwentaryzacji wiążę się z poprawieniem aktualnej listy magazynowej</i>
      <form id="endInventoryForm" action="endinventory.php" method="post">
          
          <input type="submit" value="Tak">
      </form>
    </div>
  </div>




  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
  <!-- AJAX FORMUARZA EDYCJI PRODUKTU -->
  <script src="../../../js/inventory_edit.js"></script>

  <script>
  var modal = document.getElementById("myModal2");
  var btn = document.getElementById("myBtn2");
  var span = document.getElementsByClassName("closeA")[0];


    btn.onclick = function() {
      modal.style.display = "block";
    }
    span.onclick = function() {
      modal.style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>


<script>
  var modal1 = document.getElementById("myModal3");
  var btn1 = document.getElementById("myBtn3");
  var span1 = document.getElementsByClassName("closeD")[0];


    btn1.onclick = function() {
      modal1.style.display = "block";
    }
    span1.onclick = function() {
      modal1.style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == modal1) {
        modal1.style.display = "none";
      }
    }
  </script>

  
</body>
</html>
 





