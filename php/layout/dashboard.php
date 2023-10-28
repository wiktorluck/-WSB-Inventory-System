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
  
      <a href="dashboard.php"><button>Dashboard</button></a>
      <a href="products.php"><button>Products</button></a>
      <a href="users.php"><button>Users</button></a>

      <a href="../auth/logout.php"><button>Wyloguj się</button></a>
  </body>

</html>
