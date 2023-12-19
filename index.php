<?php
  
  session_start();
	
	if ((isset($_SESSION['authorized'])) && ($_SESSION['authorized']==true))
	{
		header('Location: index.php');
		exit();
	}
?>


<!DOCTYPE html>

<html>

<head>
  <link rel="icon" type="image/x-icon" href="images/inventura_logo_small.png">
  <meta charset="utf-8">
  <meta name="description" content="System Inwentaryzacji Sprzętu Komputerowego">
  <meta name="author" content="">
  <meta name="generator" content="">
  <link rel="stylesheet" href="css/loginform.css">
  <link rel="stylesheet" href="css/body_style.css">
  <title>INVENTURA</title>
</head>


<div class="logform">
  <div class="corplogo"> <img src="images/inventura_logo_full.png" width="300vw"/>   </div>
  <form action="php/auth/signin.php" method="POST">
    <br>
      Login<br>
      <input type="text" name="login" placeholder="wprowadź swój login">
      <br><br>
      Hasło<br>
      <input type="password" name="password" placeholder="wprowadź swoje hasło">
      <br><br>
        <div class="loginbutton"><button type="submit" >Zaloguj się</button> </div>
        <br>
        
          <div class="login_error">
            <?php
            if(isset($_SESSION['error']))	echo $_SESSION['error'];
          ?>
          </div>
          
  </form>
  <div class="footer">INVENTURA @ 2023</div>
  </div>
</html>