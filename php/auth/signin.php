<?php
session_start();
	
if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
{
    header('Location: ../../index.php');
    exit();
}

require_once "../../includes/connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno!=0)
	{
		echo "Error: ".$conn->connect_errno;
	}
    else
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$conn->query(
			sprintf("SELECT * FROM uzytkownicy WHERE login='%s'", mysqli_real_escape_string($conn, $login))
		))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				$stored_password = $wiersz['password'];
				
				if (password_verify($password, $stored_password)) {
					$_SESSION['authorized'] = true;
					$_SESSION['id'] = $wiersz['id'];
					$_SESSION['login'] = $wiersz['login'];
					$_SESSION['permission'] = $wiersz['permission'];
					$_SESSION['notification'] = 3;
					$rezultat->free_result();
					header('Location: ../layout/Dashboard/dashboard.php');
				} else {
					$_SESSION['notification'] = 2;
					header('Location:../../index.php');
				}
			} else {
				$_SESSION['notification'] = 2;
				header('Location:../../index.php');
			}
		}	
		$conn->close();
	}