<?php
	if ($_SESSION['permission'] == 0){
		header('Location: ../dashboard/dashboard.php');
		$_SESSION['error1'] = 1;
		exit();
	}