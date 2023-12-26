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
			sprintf("SELECT * FROM users WHERE login='%s'", mysqli_real_escape_string($conn, $login))
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

					$rezultat->free_result();
					

					$sql_check_empty = "SELECT COUNT(*) AS total FROM inventorypositions";
					$result = $conn->query($sql_check_empty);
					
					if ($result) {
						$row = $result->fetch_assoc();
						$is_empty = $row['total'] == 0;
					
						$_SESSION['activeInventory'] = $is_empty ? 0 : 1;
					} else {
						$_SESSION['activeInventory'] = 0; 
					}

					if($_SESSION['activeInventory'] == 1){

						if($wiersz['changePassword'] == 1){
							$_SESSION['notification'] = 8;
							header('Location: ../../newPassword.php');
							exit();
						}else{
							$_SESSION['notification'] = 3;
							header('Location: ../layout/Inventory/inventory.php');
							exit();
							}
					}else{
						if($wiersz['changePassword'] == 1){
							$_SESSION['notification'] = 8;
							header('Location: ../../newPassword.php');
							exit();
						}else{
							$_SESSION['notification'] = 3;
							header('Location: ../layout/Dashboard/dashboard.php');
							exit();
							}
					}
					
				} else {
					$_SESSION['notification'] = 2;
					header('Location:../../index.php');
					exit();
				}
			} else {
				$_SESSION['notification'] = 2;
				header('Location:../../index.php');
				exit();
			}
		}	
		$conn->close();
	}


