<?php
require_once("../../includes/authorized.php");
?>


<!doctype html>
<html lang="pl">
  <head>
    <title>Dashboard</title>
  </head>
  <body>
    
      <?php
        echo "Witaj ".$_SESSION['login'].'!';
      ?>
   <div class="nav">
    <img src="../../../images/inventura_logo_full.png"/>
    <a href="../Dashboard/dashboard.php"><button>Strona główna</button></a>
    <a href="../Products/products.php"><button>Produkty</button></a>
    <a href="../Users/users.php"><button>Użytkownicy</button></a>
    <a href=""><button>Raporty</button></a>
    <a href="../../auth/logout.php"><button>Wyloguj się</button></a>
  </div>
  </body>

</html>
