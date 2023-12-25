<?php
  require_once("../../../includes/authorized.php");
  require_once("../../../includes/modal_info.php");
  require_once("../../../includes/side_panel.php");
?>

<!doctype html>
<html lang="pl">
  <head>
    
    <title>PRODUCTS</title>
    
    <link rel="stylesheet" href="../../../css/body_style.css">
    <link rel="stylesheet" href="../../../css/dashboard_style.css">
    <link rel="stylesheet" href="../../../css/notification_modals.css">
    <link rel="stylesheet" href="../../../css/products_style.css">
    <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">

    
  </head>

  <body>
  <body>

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
  <div class="welcometext">Produkty</div>
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

    $sql = "SELECT * FROM produkty LIMIT $start, $rowsPerPage";
    $result = $conn->query($sql);

    echo '<table class="table_productsAll">';
    echo <<<END
      <thead>
        <tr>
         <th style="width: 3vw;">ID</th>
          <th style="width: 25vw;">Nazwa</th>
          <th>Kategoria</th>
          <th>Nr seryjny</th>
          <th>Nr ewidencyjny</th>
          <th>Cena ewidencyjna</th>
      END;
          if($_SESSION['permission'] == 1) { echo '<th colspan="2">Zmodyfikuj</th>'; }      
    echo '</tr>';
    echo'</thead>';
    

    echo "<tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["idp"] . "</td>";
            echo "<td>" . $row["namep"] . "</td>";
            echo "<td>" . $row["categoryp"] . "</td>";
            echo "<td>" . $row["serialp"] . "</td>";
            echo "<td>" . $row["registrationp"] . "</td>";
            echo "<td>" . $row["pricep"] . ' zł'."</td>";
            if($_SESSION['permission'] == 1) { echo '<td><a href="#" id="myBtn" class="edit-product" data-id="' . $row["idp"] . '">Edytuj</a></td>'; } 
            if($_SESSION['permission'] == 1) { echo '<td><a href="#" id="myBtn1" class="delete-product" data-id="' . $row["idp"] . '">Usuń</a></td>'; } 
            echo "</tr>";
        }

        $totalRows = $conn->query("SELECT COUNT(*) as total FROM produkty")->fetch_assoc()['total'];
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

    $conn->close();
}
?>

<button id="myBtn2">Dodaj nowy produkt</button>

  <!-- MODAL EDYCJI PRODUKTU -->
  <div id="myModal" class="modalP">
    <div class="modal-contentP">
      <span class="closeP">&times;</span>
      <p></p>
    </div>
  </div>

  <!-- MODAL USUWANIA PRODUKTU -->
  <div id="myModal1" class="modalD">
    <div class="modal-contentD">
      <span class="closeD">&times;</span>
      <p></p>
      <input type="button" class="closeD1" value="Nie"/>
    </div>
  </div>

  <!-- MODAL DODAWANIA PRODUKTU -->
  <div id="myModal2" class="modalA">
    <div class="modal-contentA">
      <span class="closeA">&times;</span>
        <form id="addForm" action="addproduct.php" method="post">
          <label for="namep">Nazwa produktu:</label>
          <input type="text" id="namep" name="namep"><br><br>

          <label for="categoryp">Kategoria:</label>
          <select id="categoryp" name="categoryp">
            <option value="Komputer PC">Komputer PC</option>
            <option value="Laptop">Laptop</option>
            <option value="Monitor LCD">Monitor LCD</option>
            <option value="Telefon GSM">Telefon GSM</option>
            <option value="TV Smart">TV Smart</option>
          </select><br><br>

          <label for="serialp">Nr seryjny:</label>
          <input type="text" id="serialp" name="serialp"><br><br>

          <label for="registrationp">Nr ewidencyjny:</label>
          <input type="text" id="registrationp" name="registrationp"><br><br>

          <label for="pricep">Cena ewidencyjna:</label>
          <input type="text" id="pricep" name="pricep"><br><br>

          <input type="submit" value="Wyślij">
      </form>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../../js/products.js"></script>
    
  <!-- AJAX FORMUARZA EDYCJI PRODUKTU -->
  <script src="../../../js/product_edit.js"></script>
    <!-- AJAX FORMUARZA USUWANIA PRODUKTU -->
  <script src="../../../js/product_delete.js"></script>


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

  
</body>
</html>
 





