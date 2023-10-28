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
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="generator" content="">

  <title>Nazwa Systemu</title>
</head>

</main>



<main>

<form action="php/auth/signin.php" method="POST">
  Login: <input type="text" name="login">
  Hasło: <input type="password" name="password">
  <button type="submit">Zaloguj się</button>

<?php
  if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>
</form>


</main>

</html>