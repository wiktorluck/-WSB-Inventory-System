<?php
require_once("../../../includes/authorized.php");
?>


<!doctype html>
<html lang="pl">
  <head>
  <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
    <title>PRODUCTS</title>
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

  <div class="welcometext">Produkty</div>
  <br>
      <div class="tableOfProducts">
<?php
require_once "../../../includes/connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_errno;
} else {
    $rowsPerPage = 20; // Adjust the number of rows per page as needed
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    $start = ($currentPage - 1) * $rowsPerPage;

    $sql = "SELECT * FROM produkty LIMIT $start, $rowsPerPage";
    $result = $polaczenie->query($sql);

    echo '<table class="table_products">';
    echo <<<END
      <thead>
        <tr>
          <th>ID</th>
          <th>Nazwa</th>
          <th>Kategoria</th>
          <th>Nr seryjny</th>
          <th>Nr ewidencyjny</th>
          <th colspan="2">Zmodyfikuj</th>
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
            echo '<td><a href="editproduct.php?id=' . $row["idp"] . '">Edytuj</a></td>';
            echo "<td>Usuń</td>";

            echo "</tr>";
        }

        // Add pagination links
        $totalRows = $polaczenie->query("SELECT COUNT(*) as total FROM produkty")->fetch_assoc()['total'];
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

    $polaczenie->close();
}
?>
            </tr>
          </tbody>
        </table>



        <script>
    var table = document.getElementById('table_products');
    var rowsPerPage = 2; // Adjust the number of rows per page as needed

    function showPage(page) {
        var startIndex = (page - 1) * rowsPerPage;
        var endIndex = startIndex + rowsPerPage;
        var rows = Array.from(table.getElementsByTagName('tbody')[0].rows);

        rows.forEach(function(row, index) {
            row.style.display = (index >= startIndex && index < endIndex) ? '' : 'none';
        });
    }

    function setupPagination() {
        var totalRows = table.getElementsByTagName('tbody')[0].rows.length;
        var totalPages = Math.ceil(totalRows / rowsPerPage);
        var paginationContainer = document.getElementById('pagination-container');

        // Create pagination links
        for (var i = 1; i <= totalPages; i++) {
            var li = document.createElement('li');
            li.textContent = i;
            li.addEventListener('click', function() {
                showPage(parseInt(this.textContent));
            });
            paginationContainer.appendChild(li);
        }
    }

    // Initialize pagination
    showPage(1);
    setupPagination();
</script>
  </div>
  </body>

</html>