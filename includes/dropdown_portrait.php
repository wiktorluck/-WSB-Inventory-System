<div class="mainbox">
    <div class="topLogo"> <img alt="logo inventura" src="../../../images/inventura_logo_full.png" />
      <div class="dropdown">
        <span> <img src="../../../images/more.png"> </span>
        <div class="dropdown-content">
          <ul> <a href="../Dashboard/dashboard.php">Strona główna</a> </ul>
          
          
          <?php if($_SESSION['activeInventory'] == 0){
            echo '<ul> <a href="../Products/products.php">Produkty</a> </ul>';
          }?>
          
          
          <ul>
            <?php if ($_SESSION['permission'] == 1) {
              echo '<a href="../Users/users.php">   Użytkownicy</a>';
            } ?>
          </ul>
          
          <ul>
            <?php if ($_SESSION['permission'] == 1) {
              echo '<a href="../Inventory/inventory.php">   Inwentaryzacja</a>';
            } ?>
          </ul>
          <ul> <a href="../Reports/reports.php">Raporty</a> </ul>
          <ul> <a href="../../auth/logout.php">Wyloguj się</a> </ul>
        </div>
      </div>
</div>