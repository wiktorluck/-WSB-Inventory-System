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
    <title>INVENTORY</title>
      <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
      <link rel="stylesheet" href="../../../css/notification_modals.css">
      <link rel="stylesheet" href="../../../css/inventory_style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <meta name="description" content="System Inwentaryzacji Sprzętu Komputerowego">
        <meta name="author" content="BKolacz, WLuck, MLisiecki">
        <meta name="keywords" content="inwentaryzacja, sprzęt komputerowy"/>
  </head>
<!---------------------- ^ metainfo ^ ---------------------->
<!---------------------------- content ---------------------------->

<header>
  <?php
      if ($_SESSION['activeInventory'] == 0) { echo 'Obecnie nie rozpoczęto Inwentaryzacji!'; }
      if ($_SESSION['activeInventory'] == 1) { echo 'Inwentaryzacja w toku...'; }
  ?>
</header>

<body>

<!--------------- welcome text -------------->
      <div class="welcometext">Inwentaryzacje</div>
<!--------------- ^ welcome text ^ -------------->
        
<!---------------------- all items in inventory ---------------------->      
<div class="tableOfProducts">
<div class="InventoryAll">  
  <?php
  require_once "../../../includes/connect.php";
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
  if ($conn->connect_errno != 0) { echo "Error: " . $conn->connect_errno; } else {
    $rowsPerPage = 20;
    $currentPage = $_GET['page'] ?? 1;
    $start = ($currentPage - 1) * $rowsPerPage;
    $sql = "SELECT inventorypositions.idp, inventorypositions.namep, inventorypositions.categoryp, inventorypositions.serialp, 
      inventorypositions.registrationp, inventorypositions.checked, inventorypositions.pricep, users.login 
      FROM inventorypositions 
      LEFT JOIN users ON inventorypositions.userid = users.id LIMIT $start, $rowsPerPage";

  $result = $conn->query($sql);
    if ($_SESSION['activeInventory'] == 1) {
    echo '<table class="table_productsAll">';
    echo '
      <thead>
        <tr>
          <th style="width: 35px;">ID</th>
          <th style="width: 250px;">Nazwa</th>
          <th>Kategoria</th>
          <th>Nr seryjny</th>
          <th>Nr ewidencyjny</th>
          <th>Cena ewidencyjna</th>
          <th>Status</th>
          <th>Ostatni sprawdzający</th>
          <th>Akcje</th>
        </tr>
      </thead>
    ';
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
        echo "<td>" . $row["checked"] . "</td>";
        echo "<td>" . $row["login"] . "</td>";
        echo '<td><a href="#" id="myBtn" class="edit-inventory" data-id="' . $row["idp"] . '"> <img src="../../../images/mark.png"  width="25" /> </a></td>';
      echo "</tr>";}
    $totalRows = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
    $totalPages = ceil($totalRows / $rowsPerPage);
    $startPage = max(1, $currentPage - 2); 
    $endPage = min($totalPages, $currentPage + 2); 
      echo '<tr>';
        echo '<td colspan="8">';
          echo '<div class="pagination">';
            if ($currentPage > 1) {
              echo '<a href="?page=' . ($currentPage - 1) . '">&laquo;</a>'; }
            for ($i = $startPage; $i <= $endPage; $i++) {
              echo '<a href="?page=' . $i . '"';
            if ($i == $currentPage) {
              echo ' class="active"'; }
              echo '>' . $i . '</a>'; }
            if ($currentPage < $totalPages) {
            echo '<a href="?page=' . ($currentPage + 1) . '">&raquo;</a>'; }
          echo '</div>';
        echo '</td>';
      echo '</tr>';
  } else {
    echo "<tr><td colspan='8'>Brak rekordów w tabeli.</td></tr>"; }
    echo "</tbody>";
    echo "</table>";
  if ($_SESSION['activeInventory'] == 1) {
    $sum_query = "SELECT SUM(pricep) AS total_price FROM inventorypositions WHERE checked = 'brak'";
    $sum_result = $conn->query($sum_query);
    if ($sum_result) {
      $row = $sum_result->fetch_assoc();
      $total_price = $row['total_price'];
      $_SESSION['deficit'] = $total_price;
      echo '<div id="sumDiv">';
      echo '<p>Obecne Manko: ' . $_SESSION['deficit'] . ' zł</p>';
      echo '</div>';
        } else { echo "Błąd zapytania: " . $conn->error; }}}
    if ($_SESSION['activeInventory'] == 1) {
      $count_shortcomings_query = "SELECT COUNT(*) AS total_shortcomings FROM inventorypositions WHERE checked = 'brak'";
      $count_result = $conn->query($count_shortcomings_query);
    if ($count_result) {
      $row = $count_result->fetch_assoc();
      $total_shortcomings = $row['total_shortcomings'];
      $_SESSION['shortcomings'] = $total_shortcomings;
        echo '<div id="sumDiv">';
        echo '<p>Ilość brakujących towarów: ' . $_SESSION['shortcomings'] . '</p>';
        echo '</div>'; } else { echo "Błąd zapytania: " . $conn->error; } }
    if ($_SESSION['activeInventory'] == 0) {
      echo '
        <h3>Brak aktywnej Inwentaryzacji<h3><br>
        <h4>Możesz rozpocząć proces inwenatryzacji, ...<h4>
      '; }
    $conn->close(); }
  ?>
</div>
<!---------------------- ^ all items in inventory ^ ---------------------->

<!---------------------- all items in inventory portrait mode ---------------------->        
<div class="InventoryAllPortrait">
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
      inventorypositions.registrationp, inventorypositions.checked, inventorypositions.pricep, users.login 
      FROM inventorypositions 
      LEFT JOIN users ON inventorypositions.userid = users.id LIMIT $start, $rowsPerPage";
          $result = $conn->query($sql);
          if ($_SESSION['activeInventory'] == 1) {
            echo '<table class="table_productsAllportraitMode">';
            echo '
          <thead>
            <tr>
             <th style="width: 35px;">ID</th>
              <th>Nr ewidencyjny</th>
              <th>Cena ewidencyjna</th>
              <th>Status</th>
              <th>Akcje</th>
            </tr>
          </thead>
          ';
            echo "<tbody>";

            if ($result->num_rows > 0) {

              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["idp"] . "</td>";
                echo "<td>" . $row["registrationp"] . "</td>";
                echo "<td>" . $row["pricep"] . ' zł' . "</td>";
                echo "<td>" . $row["checked"] . "</td>";
                echo '<td><a href="#" id="myBtn" class="edit-inventory" data-id="' . $row["idp"] . '"> <img src="../../../images/mark.png"  width="25" /> </a></td>';
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
                echo '<a href="?page=' . ($currentPage - 1) . '">&laquo;</a>'; }
              for ($i = $startPage; $i <= $endPage; $i++) {
                echo '<a href="?page=' . $i . '"';
              if ($i == $currentPage) {
                echo ' class="active"'; }
                echo '>' . $i . '</a>'; }
              if ($currentPage < $totalPages) {
                echo '<a href="?page=' . ($currentPage + 1) . '">&raquo;</a>'; }
            echo '</div>';
              echo '</td>';
              echo '</tr>';
            } else {
              echo "<tr><td colspan='8'>Brak rekordów w tabeli.</td></tr>";
            }

            echo "</tbody>";
            echo "</table>";

            if ($_SESSION['activeInventory'] == 1) {
              //TOTAL DEFICIT
              $sum_query = "SELECT SUM(pricep) AS total_price FROM inventorypositions WHERE checked = 'brak'";
              $sum_result = $conn->query($sum_query);

              if ($sum_result) {
                $row = $sum_result->fetch_assoc();
                $total_price = $row['total_price'];
                $_SESSION['deficit'] = $total_price;

                echo '<div id="sumDiv">';
                echo '<p>Obecne Manko: ' . $_SESSION['deficit'] . ' zł</p>';
                echo '</div>';


              } else {
                echo "Błąd zapytania: " . $conn->error;
              }
            }
          }

          if ($_SESSION['activeInventory'] == 1) {
            //TOTAL POSISTION WHERE CHECKED = 'BRAK'
            $count_shortcomings_query = "SELECT COUNT(*) AS total_shortcomings FROM inventorypositions WHERE checked = 'brak'";
            $count_result = $conn->query($count_shortcomings_query);

            if ($count_result) {
              $row = $count_result->fetch_assoc();
              $total_shortcomings = $row['total_shortcomings'];
              $_SESSION['shortcomings'] = $total_shortcomings;

              echo '<div id="sumDiv">';
              echo '<p>Ilość brakujących towarów: ' . $_SESSION['shortcomings'] . '</p>';
              echo '</div>';
            } else {
              echo "Błąd zapytania: " . $conn->error;
            }
          }


          if ($_SESSION['activeInventory'] == 0) {
            echo '
        <h3>Brak aktywnej Inwentaryzacji<h3>
        <h4>Przeprowadzając Inwentaryzację sprawdzisz swoje pozycje oraz poprawisz stany magazynowe w przypadku braków...<h4>
        ';
          }

          $conn->close();
        }
        ?>
</div>
<!---------------------- ^ all items in inventory portrait mode ^ ---------------------->
        <?php
        if ($_SESSION['permission'] == 1) {
            echo '<button id="myBtn2">Rozpocznij nową Inwentaryzację</button>';
          if ($_SESSION['activeInventory'] == 1) {
            echo '<button id="myBtn3">Zakończ Inwentaryzację</button>';
          }
        }

        ?>

        <!-- EDIT INVENTORY MODAL -->
        <div id="myModal" class="modalP">
          <div class="modal-contentP">
            <span class="closeP">&times;</span>
            <p></p>
          </div>
        </div>



        <!-- ADD INVENTORY MODAL -->
        <div id="myModal2" class="modalA">
          <div class="modal-contentA">
            <span class="closeA">&times;</span>
            <h3>Czy na pewno chcesz rozpocząć nową inwentaryzację?</h3>
            <form id="addInventoryForm" action="addinventory.php" method="post">
              <input type="submit" value="Tak">
            </form>
          </div>
        </div>


        <!-- END INVENTORY MODAL -->
        <div id="myModal3" class="modalD">
          <div class="modal-contentD">
            <span class="closeD">&times;</span>
            <h3>Czy na pewno chcesz przejść do podsumowania oraz zakończenia Inwentaryzacji?</h3>
            <i>Zakończenie inwentaryzacji wiążę się z poprawieniem aktualnej listy magazynowej</i>
            <form id="endInventoryForm" action="summaryinventory.php" method="post">

              <input type="submit" value="Sumuj">
            </form>
          </div>
        </div>




        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- EDIT INVENTORY MODAL AJAX SCRIPT -->
        <script src="../../../js/inventory_edit.js"></script>

        <!-- ADD INVENTORY MODAL SCRIPT -->
        <script src="../../../js/inventory_add.js"></script>

        <!-- END INVENTORY MODAL SCRIPT -->
        <script src="../../../js/inventory_end.js"></script>
        <script src="../../../js/modals.js"></script>

  </body>

</html>