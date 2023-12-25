<?php
  require_once("../../../includes/authorized.php");
  require_once("../../../includes/modal_info.php");
  require_once("../../../includes/side_panel.php");
?>

<!doctype html>
<html lang="pl">
  <head>
    
    <title>USERS</title>
    
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
  <div class="welcometext">Użytkownicy</div>
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

    $sql = "SELECT * FROM uzytkownicy LIMIT $start, $rowsPerPage";
    $result = $conn->query($sql);

    echo '<table class="table_productsAll">';
    echo <<<END
      <thead>
        <tr>
         <th style="width: 3vw;">ID</th>
          <th style="width: 25vw;">Login</th>
          <th>Uprawnienia</th>
          <th colspan="2">Zmodyfikuj</th>
        </tr>
      </thead>
      END;

    echo "<tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["login"] . "</td>";
            echo "<td>" . $row["permission"] . "</td>";

            echo '<td><a href="#" id="myBtn" class="edit-user" data-id="' . $row["id"] . '">Edytuj</a></td>';
            echo '<td><a href="#" id="myBtn1" class="delete-user" data-id="' . $row["id"] . '">Usuń</a></td>';

            echo "</tr>";
        }

        $totalRows = $conn->query("SELECT COUNT(*) as total FROM uzytkownicy")->fetch_assoc()['total'];
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

<button id="myBtn2">Dodaj użytkownika</button>

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
        <form id="addUserForm" action="adduser.php" method="post">
          <label for="loginu">Login:</label>
          <input type="text" id="loginu" name="loginu"><br><br>
          <label for="passwordu">Hasło:</label>
          <input type="password" id="passwordu" name="passwordu"><br><br>
          <label for="permissionu">Uprawnienia:</label>
          <select id="permissionu" name="permissionu">
            <option value="0">Pracownik</option>
            <option value="1">Administrator</option>
          </select><br><br>

          <input type="submit" value="Wyślij">
      </form>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- <script src="../../../js/products.js"></script> -->
    
  <!-- AJAX FORMUARZA EDYCJI PRODUKTU -->
  <script src="../../../js/user_edit.js"></script>
    <!-- AJAX FORMUARZA USUWANIA PRODUKTU -->
  <script src="../../../js/user_delete.js"></script>

  <script src="../../../js/user_add.js"></script>




  
</body>
</html>
 





