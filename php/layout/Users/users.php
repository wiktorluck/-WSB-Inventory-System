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
  </head>

  <body>

 <div class="nav">
    <img src="../../../images/inventura_logo_full.png"/>
    <a href="../Dashboard/dashboard.php"><button>Strona główna</button></a>
    <a href="../Products/products.php"><button>Produkty</button></a>
    <a href="../Users/users.php"><button>Użytkownicy</button></a>
    <a href=""><button>Raporty</button></a>
    <a href="../../auth/logout.php"><button>Wyloguj się</button></a>
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

    echo '<table class="table_products">';
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

        <button id="myBtn">Open Modal</button>

<!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h4>edycja użytkownika siabalabamba</h4>
  </div>

</div>

</div>
  </body>
  <script>
  // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</html>