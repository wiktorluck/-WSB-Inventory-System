<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/authorized_perm.php");
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
  <?php
   echo'<div class="nav">';
   echo' <img src="../../../images/inventura_logo_full.png"/>';


   //Panel admina
   if($_SESSION['permission'] == 1){
    
    echo'
    <a href="../Dashboard/dashboard.php"><button>Strona główna</button></a>
    <a href="../Products/products.php"><button>Produkty</button></a>
    <a href="../Users/users.php"><button>Użytkownicy</button></a>
    <a href="../Reports/reports.php">   <button>Raporty</button></a>
    
    <a href="../Inventory/Inventory.php"><button>Inwentaryzacja</button></a>
    ';
   }
   
   //Panel użytkownika gdy nie ma inwentaryzacji
   if($_SESSION['permission'] == 0 && $_SESSION['activeInventory'] == 0){
      echo '<a href="../Dashboard/dashboard.php"><button>Strona główna</button></a>';
      echo '<a href="../Products/products.php"><button>Produkty</button></a>';
   }

   //Panel użytkownika gdy trwa inwentaryzacja
   if($_SESSION['permission'] == 0 && $_SESSION['activeInventory'] == 1){
        echo '<a href="../Inventory/Inventory.php"><button>Inwentaryzacja</button></a>';  
    }

     echo '<a href="../../auth/logout.php"><button>Wyloguj się</button></a>';
     echo'</div>';
?>

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
