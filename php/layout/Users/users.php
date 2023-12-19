<?php
require_once("../../../includes/authorized.php");
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

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_errno;
} else {
    $sql = "SELECT id, login FROM uzytkownicy";
    $result = $polaczenie->query($sql);

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

    $polaczenie->close();
}
?>

            </tr>
          </tbody>
        </table>

</html>