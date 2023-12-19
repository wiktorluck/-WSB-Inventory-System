<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/modal_info.php");
?>


<!doctype html>

<html lang="pl">

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
    <title>INVENTURA</title>
    <link rel="stylesheet" href="../../../css/body_style.css">
    <link rel="stylesheet" href="../../../css/dashboard_style.css">
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


  <div class="mainbox">
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
  
  
  <div class="welcometext"> <?php echo "Witaj z powrotem, ".$_SESSION['login'].'!'; ?></div>


  <?php
require_once "../../../includes/connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
} else {
  $sql_count = "SELECT 
  COUNT(*) as totalProducts, 
  COUNT(DISTINCT categoryp) as totalCategories,
  COUNT(CASE WHEN categoryp = 'Komputer PC' THEN 1 END) as totalComputers 
  FROM produkty;";

  $result = $conn->query($sql_count);

  if ($result) {
      $row = $result->fetch_assoc();
      $total_products = $row['totalProducts'];
      $total_categories = $row['totalCategories'];
      $total_computers = $row['totalComputers'];
  
      echo'
      <div class="summaryboxes">
        <div class="box1"> Wszystkich przedmiotów 
          <p class="count">' . $total_products . '</p>
        </div>

      <div class="box2"> Wszystkich kategorii 
          <p class="count">'. $total_categories .'</p>
      </div>

    <div class="box3"> Wszystkich komputerów 
            <p class="count">'. $total_computers .'</p>
    </div>
  </div>';

    $conn->close();
  }
}
?>


  


  <div class="tabletext"> Ostatnio dodane przedmioty</div>



<?php
require_once "../../../includes/connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
} else {
    $limit = 12;

    $sql = "SELECT * FROM produkty ORDER BY idp DESC LIMIT $limit";
    $result = $conn->query($sql);

    echo '<table class="table_products">';
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

<?php
require_once "../../../includes/connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
} else {
    $limit = 12;

    $sql = "SELECT * FROM produkty ORDER BY idp DESC LIMIT $limit";
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

</div>
</body>

<script src="../../../js/counter.js"></script>
</html>
