<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/modal_info.php");
?>

<!doctype html>
<html lang="pl">
  <head>
    
    <title>PRODUCTS</title>
    
    <link rel="stylesheet" href="../../../css/body_style.css">
    <link rel="stylesheet" href="../../../css/dashboard_style.css">
    <link rel="stylesheet" href="../../../css/notification_modals.css">
    <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">

    
  </head>

  <body>
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
            echo '<td><a href="#" class="edit-product" data-id="' . $row["idp"] . '">Edytuj</a></td>';
            echo "<td>Usuń</td>";

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


            </tr>
          </tbody>
        </table>
  </div>

  <div id="myModal" class="modalNotification" >
    <div class="modalSuccess-content">
      <div class="modalInfo"></div>
    </div>
  </div>

  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../../js/products.js"></script>


<script>
  $(document).ready(function() {
      $('.edit-product').click(function(e) {
          e.preventDefault();
          var id = $(this).data('id');

          $.ajax({
              url: 'editproduct.php',
              method: 'POST',
              data: { id: id },
              success: function(response) {
                $('#myModal .modalInfo').html(response);
                  $('#myModal').html(response).show();
              },
              error: function(xhr, status, error) {
                  console.error(status + ": " + error);
              }
          });
      });
  });
</script>
  </body>
  

</html>
 





