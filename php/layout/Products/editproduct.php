
<html lang="pl">
  <head>
  <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
    <title>EDIT</title>
    <link rel="stylesheet" href="../../../css/body_style.css">
    <link rel="stylesheet" href="../../../css/dashboard_style.css">
  </head>

  <body>
  <div class="nav">
    <img src="../../../images/inventura_logo_full.png"/>
    <a href="../Dashboard/dashboard.php"><button>Strona główna</button></a>
    <a href="../Products/products.php"><button>Produkty</button></a>
    <a href="../Users/users.php"><button>Użytkownicy</button></a>
    <a href=""><button>Raporty</button></a>
    <a href="../../auth/logout.php"><button>Wyloguj się</button></a>
  </div>

  <div class="mainbox">
  <div class="welcometext">
  <?php
$id = $_GET['id'];
echo "Edycja produktu o ID => $id";
?>
    </div>

</div>
</body>
</html>