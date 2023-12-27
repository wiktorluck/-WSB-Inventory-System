<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/authorized_perm.php");
require_once("../../../includes/side_panel.php");
?>


<!doctype html>
<html lang="pl">

<head>
  <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
  <title>INVENTURA</title>
  <link rel="stylesheet" href="../../../css/body_style.css">
  <link rel="stylesheet" href="../../../css/dashboard_style.css">
  <link rel="stylesheet" href="../../../css/notification_modals.css">
</head>

<body>
  <div class="mainbox">
    <div class="welcometext">
      <?php echo "Witaj z powrotem, " . $_SESSION['login'] . '!'; ?>
    </div>

    <?php
    if ($_SESSION['activeInventory'] == 1) {
      echo '
        
        <div class="summaryboxes">
        <h2>Raporty Inwentaryzacji</h2></br>
        <hr>
                <a href="ResultReports/reportDeficiencies.php">
                 <div class="box1"> Raport Braków 
                  <p> click </p>
                 </div>
                </a>


                <a href="ResultReports/reportUncheckedPositions.php">
                 <div class="box2"> Raport Niesprawdzonych Pozycji
                  <p> click </p>
                 </div>
                </a>

                <a href="ResultReports/reportCheckedPositions.php">
                 <div class="box3"> Raport Sprawdzonych Pozycji 
                  <p> click </p>
                 </div>
                </a>
        </div>
        ';
    }

    ?>
    <div class="summaryboxes">
      <h2>Raporty aktualnych stanów</h2></br>
      <hr>

      <a href="ResultReports/reportComputers.php">
        <div class="box4">
          <h3>Raport Komputerów</h3>
          <p> click </p>
        </div>
      </a>

      <a href="ResultReports/reportLaptops.php">
        <div class="box5"> Raport Laptopów
          <p> click </p>
        </div>
      </a>

      <a href="ResultReports/reportOther.php">
        <div class="box6"> Raport Innych Sprzętów
          <p> click </p>
        </div>
      </a>


    </div>
  </div>
  <script src="../../../js/modals.js"></script>
</body>

</html>