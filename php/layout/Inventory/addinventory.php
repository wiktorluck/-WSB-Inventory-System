<?php
  require_once("../../../includes/authorized.php");
  require_once("../../../includes/connect.php");

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO inventoryPositions (idp, namep, quantityp, categoryp, serialp, registrationp, checked, pricep)
            SELECT idp, namep, quantityp, categoryp, serialp, registrationp, 'Niesprawdzone', pricep
            FROM produkty";

    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['notification'] = 4;
        $_SESSION['activeInventory'] = 1;
        header('Location: inventory.php');
        exit();
    } else {
        $_SESSION['notification'] = 5;
        header('Location: inventory.php');
        exit();
    }
} else {
    echo "Nieprawidłowe żądanie.";
}










