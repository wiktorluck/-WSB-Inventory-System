<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/authorized_perm.php");
require_once("../../../includes/side_panel.php");
?>

<!doctype html>
<html lang="pl">
  <head>
    <title>INVENTURA</title>
      <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
      <link rel="stylesheet" type="text/css" href="../../../css/reports.css">
      <link rel="stylesheet" type="text/css" href="../../../css/notification_modals.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <meta name="description" content="System Inwentaryzacji Sprzętu Komputerowego">
        <meta name="author" content="BKolacz, WLuck, MLisiecki">
        <meta name="generator" content="">
  </head>

<body>
<!----------- start dropdown portarit mode ----------->
<div class="mainbox">
    <div class="topLogo"> <img src="../../../images/inventura_logo_full.png" />
      <div class="dropdown">
        <span> <img src="../../../images/more.png"> </span>
        <div class="dropdown-content">
          <ul> <a href="../Dashboard/dashboard.php">Strona główna</a> </ul>
          <ul> <a href="../Products/products.php">Produkty</a> </ul>
          <ul>
            <?php if ($_SESSION['permission'] == 1) {
              echo '<a href="../Users/users.php">   Użytkownicy</a>';
            } ?>
          </ul>
          <ul>
            <?php if ($_SESSION['permission'] == 1) {
              echo '<a href="../Reports/reports.php">   Raporty</a>';
            } ?>
          </ul>
          </ul>
          <ul> <a href="../../auth/logout.php">Wyloguj się</a> </ul>
        </div>
      </div>
    </div>
<!----------- ^ end dropdown portarit mode ^ ----------->

<!--------------- welcome text -------------->
    <div class="welcometext">
      <?php echo "Co chcesz sprawdzić, " . $_SESSION['login'] . '?'; ?>
    </div>
<!--------------- ^ welcome text ^ -------------->

<!---------------------- report boxes ---------------------->
<div class="BoxReportsPortraitAll">

<br><div class="ReportText"> Raporty Inwentaryzacji </div>
    <?php
    if ($_SESSION['activeInventory'] == 1) {
      echo '
        
        <div class="summaryboxes">
                <a href="ResultReports/reportDeficiencies.php">
                 <div class="box1"> Raport Braków 
                  <p> wydruk </p>
                 </div>
                </a>


                <a href="ResultReports/reportUncheckedPositions.php">
                 <div class="box2"> Raport Niesprawdzonych Pozycji
                  <p> wydruk </p>
                 </div>
                </a>

                <a href="ResultReports/reportCheckedPositions.php">
                 <div class="box3"> Raport Sprawdzonych Pozycji 
                  <p> wydruk </p>
                 </div>
                </a>
        </div>
        ';
    }

    ?>
</div>
<!---------------------- ^ report boxes ^ ---------------------->

<!---------------------- inventura in proccesss ---------------------->
<div class="BoxReportsPortraitInv">

<?php
    require_once "../../../includes/connect.php";
    if ($_SESSION['activeInventory'] == 0) {
      echo 'Obecnie nie rozpoczęto Inwentaryzacji!';
    }
    if ($_SESSION['activeInventory'] == 1) {
      echo 'Inwentaryzacja w toku...';
    }

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_errno != 0) {
      echo "Error: " . $conn->connect_errno;
    } else {
      $sql_count = "SELECT 
  COUNT(CASE WHEN categoryp = 'Komputer PC' THEN 1 END) as totalComputers,
  COUNT(CASE WHEN categoryp = 'Laptop' THEN 1 END) as totalLaptops,
  COUNT(CASE WHEN categoryp != 'Komputer PC' AND categoryp != 'Laptop' THEN 1 END) as totalOthers
  FROM products;";
  

      $result = $conn->query($sql_count);

      if ($result) {
        $row = $result->fetch_assoc();
        $total_computers = $row['totalComputers'];
        $total_laptops = $row['totalLaptops'];
        $total_others = $row['totalOthers'];

        

        echo '
        <br><br><div class="ReportText"> Raporty aktualnych stanów </div>
      <div class="summaryboxes">
     
      <a href="ResultReports/reportLaptops.php">
        <div class="box5"> Raport komputerów
        <p class="count">' . $total_computers . '</p>
        </div>
      </a>

      <a href="ResultReports/reportLaptops.php">
      <div class="box4"> Raport laptopów
      <p class="count">' . $total_laptops . '</p>
      </div>
    </a>
    
    <a href="ResultReports/reportOther.php">
        <div class="box5"> Raport innych sprzętów
        <p class="count">' . $total_others . '</p>
        </div>
      </a>';


        

        $conn->close();
      }
    }
    ?>
</div>
<!---------------------- ^ inventura in proccesss ^ ---------------------->
  </div>
  <script src="../../../js/modals.js"></script>
</body>

</html>