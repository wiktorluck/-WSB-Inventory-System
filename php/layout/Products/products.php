<!---------------------- php ---------------------->
<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/modal_info.php");
require_once("../../../includes/side_panel.php");
require_once("../../../includes/dropdown_portrait.php");
?>
<!---------------------- ^ php ^ ---------------------->
<!---------------------- metainfo ---------------------->
<!DOCTYPE html>
<html lang="pl">

<head>
  <title> PRODUCTS </title>
  <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/notification_modals.css">
  <link rel="stylesheet" href="../../../css/products_style.css">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="System Inwentaryzacji Sprzętu Komputerowego">
  <meta name="author" content="BKolacz, WLuck, MLisiecki">
  <meta name="keywords" content="inwentaryzacja, sprzęt komputerowy" />
  <meta charset="utf-8">
</head>
<!---------------------- ^ metainfo ^ ---------------------->

<!---------------------------- content ---------------------------->
<header>
  <?php
  if ($_SESSION['activeInventory'] == 0) {
    echo 'Obecnie nie rozpoczęto Inwentaryzacji!';
  }
  if ($_SESSION['activeInventory'] == 1) {
    echo 'Inwentaryzacja w toku...';
  }
  ?>
</header>

<body>

  <!--------------- welcome text -------------->
  <div class="welcometext"> Produkty </div>
  <!--------------- ^ welcome text ^ -------------->
  <div class="filtersTableDiv">
    <form method="GET" action="">
      <label for="search">Wyszukaj:</label>
      <input type="text" name="search" id="search" placeholder="Nazwę/Nr. Ewidencyjny">
      <div class="filterTableButtons">
        <input type="submit" value="Wyszukaj" class="submitFilters">
        <input type="submit" value="Wyczyść" class="submitFilters" onclick="clearFilters()">
      </div>

    </form>
  </div>

  <!--------------- all items in database -------------->
  <div class="ProductsAll">
    <?php
    require_once "../../../includes/connect.php";
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno != 0) {
      echo "Error: " . $conn->connect_errno;
    } else {
      $rowsPerPage = 15;
      $currentPage = $_GET['page'] ?? 1;
      $start = ($currentPage - 1) * $rowsPerPage;

      function sanitizeInput($input)
      {
        return htmlspecialchars(strip_tags(trim($input)));
      }

      // Check if search form is submitted
      if (isset($_GET['search'])) {
        $_SESSION['searchTerm'] = sanitizeInput($_GET['search']);
      }

      if (isset($_SESSION['searchTerm'])) {
        $searchTerm = $_SESSION['searchTerm'];
        $sql = "SELECT idp, namep, categoryp, serialp, registrationp, pricep
                    FROM products 
                    WHERE namep LIKE '%$searchTerm%' OR registrationp LIKE '%$searchTerm%'
                    LIMIT $start, $rowsPerPage";
      } else {
        $sql = "SELECT idp, namep, categoryp, serialp, registrationp, pricep
                    FROM products 
                    LIMIT $start, $rowsPerPage";
      }

      $result = $conn->query($sql);
      echo '<table class="table_products">';
      echo <<<END
      <thead>
        <tr>
          <th style="width: 3vw;">ID</th>
          <th style="width: 25vw;">Nazwa</th>
          <th style="width:100px;">Kategoria</th>
          <th>Nr seryjny</th>
          <th>Nr ewidencyjny</th>
          <th>Cena ewidencyjna</th>
      END;
      if ($_SESSION['permission'] == 1) {
        echo '<th colspan="2">Zmodyfikuj</th>';
      }
      echo '</tr>';
      echo '</thead>';
      echo "<tbody>";
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["idp"] . "</td>";
          echo "<td>" . $row["namep"] . "</td>";
          echo "<td>" . $row["categoryp"] . "</td>";
          echo "<td>" . $row["serialp"] . "</td>";
          echo "<td>" . $row["registrationp"] . "</td>";
          echo "<td>" . $row["pricep"] . ' zł' . "</td>";
          if ($_SESSION['permission'] == 1) {
            echo '<td><a href="#" id="myBtn" class="edit-product" data-id="' . $row["idp"] . '"> <img src="../../../images/edit.png"  width="20" /> </a></td>';
          }
          if ($_SESSION['permission'] == 1) {
            echo '<td><a href="#" id="myBtn1" class="delete-product" data-id="' . $row["idp"] . '"> <img src="../../../images/delete.png"  width="20" /> </a></td>';
          }
          echo "</tr>";
        }

        $totalRows = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
        $totalPages = ceil($totalRows / $rowsPerPage);

        $startPage = max(1, $currentPage - 2);
        $endPage = min($totalPages, $currentPage + 2);

        echo '<tr>';
        echo '<td colspan="8">';
        echo '<div class="pagination">';
        if ($currentPage > 1) {
          echo '<a href="?page=' . ($currentPage - 1) . '">&laquo;</a>';
        }
        for ($i = $startPage; $i <= $endPage; $i++) {
          echo '<a href="?page=' . $i . '"';
          if ($i == $currentPage) {
            echo ' class="active"';
          }
          echo '>' . $i . '</a>';
        }
        if ($currentPage < $totalPages) {
          echo '<a href="?page=' . ($currentPage + 1) . '">&raquo;</a>';
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
    <!--------------- ^ all items in database ^ -------------->

    <!---------------------- all items in database portrait mode ---------------------->
    <div class="ProductsAllPortrait">
      <?php
      require_once "../../../includes/connect.php";
      $conn = @new mysqli($host, $db_user, $db_password, $db_name);
      if ($conn->connect_errno != 0) {
        echo "Error: " . $conn->connect_errno;
      } else {
        $rowsPerPage = 20;
        $currentPage = $_GET['page'] ?? 1;
        $start = ($currentPage - 1) * $rowsPerPage;

        function sanitizeInput2($input)
        {
          return htmlspecialchars(strip_tags(trim($input)));
        }

        // Check if search form is submitted
        if (isset($_GET['search'])) {
          $_SESSION['searchTerm'] = sanitizeInput2($_GET['search']);
        }

        if (isset($_SESSION['searchTerm'])) {
          $searchTerm = $_SESSION['searchTerm'];
          $sql = "SELECT *
                FROM products 
                WHERE namep LIKE '%$searchTerm%' OR registrationp LIKE '%$searchTerm%' 
                LIMIT $start, $rowsPerPage";
        } else {
          $sql = "SELECT idp, namep
                FROM products 
                LIMIT $start, $rowsPerPage";
        }

        $result = $conn->query($sql);
        echo '<table class="table_productsPortrait">';
        echo <<<END
          <thead>
            <tr>
            <th style="width: 25px;">ID</th>
            <th style="width: 350px;">Nazwa</th>
          END;
        if ($_SESSION['permission'] == 1) {
          echo '<th colspan="2">Zmodyfikuj</th>';
        }
        echo '</tr>';
        echo '</thead>';
        echo "<tbody>";
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["idp"] . "</td>";
            echo "<td>" . $row["namep"] . "</td>";
            if ($_SESSION['permission'] == 1) {
              echo '<td><a href="#" class="edit-product" data-id="' . $row["idp"] . '"> <img src="../../../images/edit.png"  width="16" /> </a></td>';
            }
            if ($_SESSION['permission'] == 1) {
              echo '<td><a href="#" class="delete-product" data-id="' . $row["idp"] . '"> <img src="../../../images/delete.png"  width="16" /> </a></td>';
            }
            echo "</tr>";
          }
          $totalRows = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
          $totalPages = ceil($totalRows / $rowsPerPage);
          echo '<tr>';
          echo '<td colspan="8">';
          echo '<div class="pagination">';
          if ($currentPage > 1) {
            echo '<a href="?page=' . ($currentPage - 1) . '">&laquo;</a>';
          }
          for ($i = $startPage; $i <= $endPage; $i++) {
            echo '<a href="?page=' . $i . '"';
            if ($i == $currentPage) {
              echo ' class="active"';
            }
            echo '>' . $i . '</a>';
          }
          if ($currentPage < $totalPages) {
            echo '<a href="?page=' . ($currentPage + 1) . '">&raquo;</a>';
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
    </DIV>
    <!---------------------- ^ all items in database portrait mode ^ ---------------------->

    <button class="AddProductButton" id="AddProduct"> Dodaj nowy produkt </button>

    <!---------------------- modale ---------------------->
    <!----------- edit modal ----------->
    <div id="myModal" class="modalP">
      <div class="modal-contentP">
        <span class="closeP">&times;</span>
        <p></p>
      </div>
    </div>
    <!----------- ^ edit modal ^ ----------->

    <!----------- delete modal ----------->
    <div id="myModal1" class="modalD">
      <div class="modal-contentD">
        <span class="closeD">&times;</span>
        <p></p>
        <input type="button" class="noDelete" value="Nie" />
      </div>
    </div>
    <!----------- ^ delete modal ^ ----------->

    <!----------- add modal ----------->
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
          <input type="submit" class="SendButton" value="Wyślij">
        </form>
      </div>
    </div>
    <!----------- ^ add modal ^ ----------->
    <!---------------------- ^ modale ^ ---------------------->

    <!---------------------- js ---------------------->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../js/products.js"></script>
    <!----------- ajax edit form ----------->
    <script src="../../../js/product_edit.js"></script>
    <!----------- ajax delete form ----------->
    <script src="../../../js/product_delete.js"></script>
    <script>
      var modal = document.getElementById("myModal2");
      var btn = document.getElementById("AddProduct");
      var span = document.getElementsByClassName("closeA")[0];
      btn.onclick = function () { modal.style.display = "block"; }
      span.onclick = function () { modal.style.display = "none"; }
      window.onclick = function (event) { if (event.target == modal) { modal.style.display = "none"; } }
    </script>

    <!-- CLEAR TABLE FILTRES -->
    <script src="../../../js/clear_filtres.js"></script>

    <script src="../../../js/modals.js"></script>
    <!---------------------- ^ js ^ ---------------------->

</body>

</html>







<!---------------- ^ koniec sekcji ^ ------------------>
<!---------------------- sekcja ---------------------->
<!----------- podsekcja ----------->