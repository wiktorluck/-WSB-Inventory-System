<?php
echo '<div class="nav">';
echo ' <img src="../../../images/inventura_logo_full.png"/>';


//PANEL ADMIN
if ($_SESSION['permission'] == 1) {

   echo '
    <a href="../Dashboard/dashboard.php"><button>Strona główna</button></a>
    <a href="../Products/products.php"><button>Produkty</button></a>
    <a href="../Users/users.php"><button>Użytkownicy</button></a>
    <a href="../Inventory/Inventory.php"><button>Inwentaryzacja</button></a>
    <a href="../Reports/reports.php"><button>Raporty</button></a>
    ';
}

//USER PANEL WHEN ISN'T INVENTORY
if ($_SESSION['permission'] == 0 && $_SESSION['activeInventory'] == 0) {
   echo '<a href="../Dashboard/dashboard.php"><button>Strona główna</button></a>';
   echo '<a href="../Products/products.php"><button>Produkty</button></a>';
}

//USER PANEL WHEN IS INVENTORY
if ($_SESSION['permission'] == 0 && $_SESSION['activeInventory'] == 1) {
   echo '<a href="../Inventory/Inventory.php"><button>Inwentaryzacja</button></a>';
}

echo '<a href="../../auth/logout.php"><button>Wyloguj się</button></a>';
echo '</div>';
