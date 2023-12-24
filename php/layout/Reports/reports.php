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
  <div class="welcometext"> <?php echo "Witaj z powrotem, ".$_SESSION['login'].'!'; ?>  </div>

  <div class="summaryboxes">
    <div class="box1"> Raport Braków 
            <p> click </p>
    </div>
    <div class="box2"> Raport Niesprawdzonych Pozycji
            <p> click </p>
    </div>
    <div class="box3"> Raport Sprawdzonych Pozycji 
            <p> click </p>
    </div>
</div>
<div class="summaryboxes2">
    <div class="box4"> Raport Komputerów
            <p> click </p>
    </div>
    <div class="box5"> Raport Laptopów 
            <p> click </p>
    </div>
    <div class="box6"> Raport Innych Sprzętów 
            <p> click </p>
    </div>
  </div>
</div>
</body>
</html>
