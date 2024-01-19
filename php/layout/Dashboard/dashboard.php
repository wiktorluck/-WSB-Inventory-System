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
  <title>INVENTURA</title>
  <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
  <link rel="shortcut icon" href="../../../favicon.ico">
  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/dashboard_style.css">
  <link rel="stylesheet" href="../../../css/notification_modals.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="description" content="System Inwentaryzacji Sprzętu Komputerowego">
  <meta name="author" content="BKolacz, WLuck, MLisiecki">
  <meta name="generator" content="">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<!---------------------- ^ metainfo ^ ---------------------->

<!---------------------- content ---------------------->
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




  <!----------- welcome text ----------->
  <div class="welcometext">
    <?php echo "Witaj z powrotem, " . $_SESSION['login'] . '!'; ?>
  </div>
  <!----------- ^ welcome text ^ ----------->

  <!----------- counter boxes ----------->
  <?php
  require_once "../../../includes/connect.php";
  $conn = @new mysqli($host, $db_user, $db_password, $db_name);

  if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
  } else {
    $sql_count = "SELECT 
      COUNT(*) as totalProducts, 
      COUNT(DISTINCT categoryp) as totalCategories,
      COUNT(CASE WHEN categoryp = 'Komputer PC' THEN 1 END) as totalComputers FROM products;";
    $result = $conn->query($sql_count);
    if ($result) {
      $row = $result->fetch_assoc();
      $total_products = $row['totalProducts'];
      $total_categories = $row['totalCategories'];
      $total_computers = $row['totalComputers'];
      echo '
    <div class="summaryboxes">
      <div class="boxes box1"> Wszystkich przedmiotów 
        <p class="count">' . $total_products . '</p>
    </div>

    <div class="boxes box2"> Wszystkich kategorii 
      <p class="count">' . $total_categories . '</p>
    </div>

    <div class="boxes box3"> Wszystkich komputerów 
        <p class="count">' . $total_computers . '</p>
      </div>
    </div>';
      $conn->close();
    }
  }
  ?>
  <!----------- ^ counter boxes ^ ----------->

  <!----------- latest items in database ----------->
  <div class="tabletext"> Ostatnio dodane przedmioty </div>
  <?php
  require_once "../../../includes/connect.php";
  $conn = @new mysqli($host, $db_user, $db_password, $db_name);

  if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
  } else {
    $limit = 8;
    $sql = "SELECT * FROM products ORDER BY idp DESC LIMIT $limit";
    $result = $conn->query($sql);
    echo '<table class="table_last_products">';
    echo <<<END
        <thead>
          <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Kategoria</th>
            <th>Nr seryjny</th>
            <th>Nr ewidencyjny</th>
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
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='8'>Brak rekordów w tabeli.</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
    $conn->close();
  }
  ?>
  <!--------------- ^ latest items in database ^ -------------->

  <!--------------- latest items in database portrait mode -------------->
  <?php
  require_once "../../../includes/connect.php";
  $conn = @new mysqli($host, $db_user, $db_password, $db_name);
  if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
  } else {
    $limit = 12;
    $sql = "SELECT * FROM products ORDER BY idp DESC LIMIT $limit";
    $result = $conn->query($sql);
    echo '<table class="table_productsPortrait">';
    echo <<<END
      <thead>
        <tr>
          <th>ID</th>
          <th>Nazwa</th>
        </tr>
      </thead>
    END;

    echo "<tbody>";
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["idp"] . "</td>";
        echo "<td>" . $row["namep"] . "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='8'>Brak rekordów w tabeli.</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
    $conn->close();
  }
  ?>
  <!--------------- ^ latest items in database portrait mode ^ -------------->

</body>


<!---------------------- ^ content ^ ---------------------->



<!---------------------- js ---------------------->
<script src="../../../js/counter.js"></script>
<!---------------------- ^ js ^ ---------------------->

</html>




<!---------------- ^ koniec sekcji ^ ------------------>
<!---------------------- sekcja ---------------------->
<!----------- podsekcja ----------->