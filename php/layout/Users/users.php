<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/modal_info.php");
require_once("../../../includes/authorized_perm.php");
?>


<!doctype html>
<html lang="pl">
  <head>
  <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
    <title>USERS</title>
    <link rel="stylesheet" href="../../../css/body_style.css">
    <link rel="stylesheet" href="../../../css/dashboard_style.css">
    <link rel="stylesheet" href="../../../css/products_style.css">
    <link rel="stylesheet" href="../../../css/notification_modals.css">
  </head>

  <body>
  <div class="nav">
    <img src="../../../images/inventura_logo_full.png"/>
    <a href="../Dashboard/dashboard.php"><button>Strona główna</button></a>
    <a href="../Products/products.php"><button>Produkty</button></a>
    <?php if($_SESSION['permission'] == 1) { echo '<a href="../Users/users.php">   <button>Użytkownicy</button></a>'; echo '<a href="../Reports/reports.php">   <button>Raporty</button></a>'; } ?>
    <a href="../../auth/logout.php"><button>Wyloguj się</button></a>
  </div>



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
  <h2>Użytkownicy</h2>
<div class="tableOfProducts">




<?php
require_once "../../../includes/connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
} else {
    $sql = "SELECT id, login FROM uzytkownicy";
    $result = $conn->query($sql);

    echo '<table class="table_productsAll">';
    echo <<<END
      <thead>
        <tr>
          <th>#ID</th>
          <th>Nazwa</th>
          <th colspan="2">Modyfikacja użytkownika</th>
        </tr>
      </thead>
      END;

    echo "<tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["login"] . "</td>";
            echo '<td><a href=""myBtn"?id=' . $row["id"] . '">Edytuj</a></td>';
            echo '<td>Usuń</td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Brak rekordów w tabeli.</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";

    $conn->close();
}
?>

<button id="myBtn">Dodaj nowego użytkownika</button>

<!-- MODAL ADD USER -->
<div id="myModal" class="modalP">
    <div class="modal-contentP">
      <span class="closeP">&times;</span>
      <form id="addUserForm" action="adduser.php" method="post">
          <label for="loginU">Nazwa użytkownika:</label>
          <input type="text" id="login" name="login"><br><br>

          <label for="passwordU">Hasło:</label>
          <input type="password" id="password" name="password"><br><br>

          <label for="permission">Uprawnienia:</label>
          <select id="permission" name="permission">
            <option value="0">Pracownik</option>
            <option value="1">Administrator</option>
          </select><br><br>

          <input type="submit" value="Wyślij">
      </form>
    </div>
  </div>


  <script>
  var modal = document.getElementById("myModal");
  var btn = document.getElementById("myBtn");
  var span = document.getElementsByClassName("closeP")[0];


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


</html>