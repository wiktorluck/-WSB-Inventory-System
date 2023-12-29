<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/authorized_perm.php");
require_once("../../../includes/side_panel.php");
?>


<!doctype html>
<html lang="pl">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
  <title>INVENTURA</title>
  <link rel="stylesheet" href="../../../css/body_style.css">
  <link rel="stylesheet" href="../../../css/dashboard_style.css">
  <link rel="stylesheet" href="../../../css/notification_modals.css">
</head>

<body>
  <div class="mainbox">
    <div class="welcometext">
      <?php echo "Co chcesz sprawdzić, " . $_SESSION['login'] . '?'; ?>
    </div>

    <?php
    if ($_SESSION['activeInventory'] == 1) {
      echo '
        
        <div class="summaryboxes">
        <h2>Raporty Inwentaryzacji</h2></br>
        <hr>
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
      <div class="summaryboxes">

        <h2>Raporty aktualnych stanów</h2></br>
      <hr>
     
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
  <script src="../../../js/modals.js"></script>
</body>

</html>