<?php
require_once("../../../includes/authorized.php");
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

  <h2>Użytkownicy</h2>
<div class="tableOfProducts">


<?php
require_once "../../../includes/connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_errno;
} else {
    $rowsPerPage = 10; // Adjust the number of rows per page as needed
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    $start = ($currentPage - 1) * $rowsPerPage;

    $sql = "SELECT id, login FROM uzytkownicy LIMIT $start, $rowsPerPage";
    $result = $polaczenie->query($sql);

    echo '<table class="table_products">';
    echo <<<END
      <thead>
        <tr>
          <th>#ID</th>
          <th>Nazwa</th>
          <th colspan="2">Czynność</th>
        </tr>
      </thead>
      END;

    echo "<tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["login"] . "</td>";
            echo '<td><a href="edituser.php?id=' . $row["id"] . '">Edytuj</a></td>';
            echo '<td>Usuń</td>';
            echo "</tr>";
        }

        // Add pagination links
        $totalRows = $polaczenie->query("SELECT COUNT(*) as total FROM uzytkownicy")->fetch_assoc()['total'];
        $totalPages = ceil($totalRows / $rowsPerPage);

        echo '<tr>';
        echo '<td colspan="3">';
        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
        echo '</div>';
        echo '</td>';
        echo '</tr>';
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
  </body>

</html>