<?php
	if ($_SESSION['permission'] == 0){
		header('Location: ../dashboard/dashboard.php');
		$_SESSION['notification'] = 1;
		exit();
	}