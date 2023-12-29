<!---------------------- php ---------------------->
<?php
  require_once("../../../includes/authorized.php");
  require_once("../../../includes/modal_info.php");
  require_once("../../../includes/side_panel.php");
?>
<!---------------------- ^ php ^ ---------------------->
<!---------------------- metainfo ---------------------->
  <!doctype html>
  <html lang="pl">
  <head>
    <title>USERS</title>
      <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
      <link rel="stylesheet" href="../../../css/users_style.css">
      <link rel="stylesheet" href="../../../css/notification_modals.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <meta name="description" content="System Inwentaryzacji Sprzętu Komputerowego">
        <meta name="author" content="BKolacz, WLuck, MLisiecki">
        <meta name="generator" content="">
</head>
<!---------------------- ^ metainfo ^ ---------------------->

<!---------------------- content ---------------------->
<body>
<!----------- start dropdown portarit mode ----------->
<div class="mainbox">
    <div class="topLogo"> <img src="../../../images/inventura_logo_full.png" />
      <div class="dropdown">
        <span> <img src="../../../images/more.png"> </span>
        <div class="dropdown-content">
          <ul> <a href="../Dashboard/dashboard.php">Strona główna</a> </ul>
          <ul> <a href="../Products/products.php">products</a> </ul>
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

<!----------- welcome text ----------->         
<div class="welcometext">
  <?php echo "Dodajemy kogoś nowego, " . $_SESSION['login'] . '?'; ?>
</div>
<!----------- ^ welcome text ^ -----------> 

<!----------- users table ----------->   
<?php
require_once "../../../includes/connect.php";
$conn = @new mysqli($host, $db_user, $db_password, $db_name);
  if ($conn->connect_errno != 0) { echo "Error: " . $conn->connect_errno; } else {
  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);
  echo '<table class="table_productsAll">';
    echo <<<END
      <thead>
        <tr>
          <th style="width: 25px;">ID</th>
          <th style="width: 150px;">Login</th>
          <th tyle="width: 220px;">Uprawnienia</th>
          <th colspan="2" style="width: 150px;">Zmodyfikuj</th>
        </tr>
      </thead>
    END;
  echo "<tbody>";
if ($result->num_rows > 0) { while ($row = $result->fetch_assoc()) {
  echo "<tr>";
  echo "<td>" . $row["id"] . "</td>";
  echo "<td>" . $row["login"] . "</td>";
  echo "<td>";
    if ($row["permission"] == 1) {
      echo 'Administrator'; } else {
      echo 'Pracownik'; }
  echo "</td>";
  echo '<td><a href="#" id="userEdit" data-id="' . $row["id"] . '">Edytuj</a></td>';
  echo '<td><a href="#" id="userDelete"  data-id="' . $row["id"] . '">Usuń</a></td>';
  echo "</tr>"; }
    } else {
    echo "<tr><td colspan='8'>Brak rekordów w tabeli.</td></tr>"; }
  echo "</tbody>";
  echo "</table>";
$conn->close();
}
?>
<!----------- ^ users table ^ -----------> 

<button id="AddUser">Dodaj użytkownika</button>


<!---------------------- modale ---------------------->
<!----------- edit modal ----------->
  <div id="myModal" class="modalP">
    <div class="modal-contentP">
        <span class="closeP">&times;</span>
      <p></p>
    </div>
  </div>
<!----------- ^ edit modal ^ ----------->

<!----------- delete modal ----------->
  <div id="myModal1" class="modalD">
    <div class="modal-contentD">
      <span class="closeD">&times;</span>
        <p></p>
      <input type="button" class="closeD1" value="Nie" />
    </div>
  </div>
<!----------- ^ delete modal ^ ----------->

<!----------- add modal ----------->
  <div id="myModal2" class="modalA">
    <div class="modal-contentA">
      <span class="closeA">&times;</span>
      <form id="addUserForm" action="adduser.php" method="post">
        <label for="loginu">Login:</label>
          <input type="text" id="loginu" name="loginu"><br><br>
        <label for="passwordu">Hasło:</label>
          <input type="password" id="passwordu" name="passwordu"><br><br>
        <label for="permissionu">Uprawnienia:</label>
          <select id="permissionu" name="permissionu">
            <option value="0">Pracownik</option>
            <option value="1">Administrator</option>
          </select><br><br>
        <input class="SendButton" type="submit" value="Wyślij">
      </form>
    </div>
  </div>
<!----------- ^ add modal ^ ----------->
<!---------------------- modale ---------------------->

<!---------------------- js ---------------------->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!----------- ajax edit form ----------->
<script src="../../../js/user_edit.js"></script>
<!----------- ajax delete form ----------->
<script src="../../../js/user_delete.js"></script>
<script src="../../../js/user_add.js"></script>
<script src="../../../js/modals.js"></script>
<!---------------------- ^ js ^ ---------------------->
  </body>

</html>