<?php
require_once("../../../includes/authorized.php");
require_once "../../../includes/connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
   echo "Error: " . $conn->connect_errno;
} else {
   $checkQuery = "SELECT COUNT(*) AS count FROM inventorypositions WHERE checked = 'Niesprawdzone'";
   $result = $conn->query($checkQuery);

   if ($result) {
      $row = $result->fetch_assoc();
      $count = $row['count'];

      echo ($count > 0) ? 'true' : 'false';
   } else {
      echo 'false';
   }

   $conn->close();
}

