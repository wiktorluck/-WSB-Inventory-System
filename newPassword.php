<!---------------------- php ---------------------->
<?php
require_once("includes/authorized.php");
require_once("includes/modal_info.php");
?>
<!---------------------- ^ php ^ ---------------------->
<!---------------------- metainfo ---------------------->
<!DOCTYPE html>
<html>

<head>
  <title>INVENTURA</title>
  <link rel="icon" type="image/x-icon" href="images/inventura_logo_small.png">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/loginform.css">
  <link rel="stylesheet" href="css/notification_modals.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="description" content="System Inwentaryzacji Sprzętu Komputerowego">
  <meta name="author" content="BKolacz, WLuck, MLisiecki">
  <meta name="generator" content="">
</head>
<!---------------------- ^ metainfo ^ ---------------------->
<!---------------------- content ---------------------->
<div class="container">
  <div class="logform">
    <form action="php/auth/changePassword.php" method="POST">
      <br>
      <?php echo 'Witaj ' . $_SESSION['login'] . '!' ?>
      <p>Twoje hasło zostało zresetowane przez Administratora. Do zalogowania się konieczne jest wprowadzenie nowego
        hasła!</p><br>
      Nowe hasło<br> <input type="password" name="password" placeholder="wprowadź swoje nowe hasło"> <br><br>
      Wprowadź ponownie<br> <input type="password" name="confirm_password"
        placeholder="wprowadź ponownie swoje hasło"><br>
      <div class="loginbutton"><button type="submit" name="change">Zmień hasło</button></div>
      <div class="loginbutton"><button type="submit" name="logout">Wyloguj się</button></div>
    </form>
    <div class="footer">INVENTURA @ 2023</div>
  </div>
</div>
<!---------------------- ^ content ^ ---------------------->

</html>


<!---------------------- sekcja ---------------------->
<!---------------- ^ koniec sekcji ^ ------------------>
<!----------- podsekcja ----------->