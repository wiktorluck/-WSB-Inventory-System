<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/connect.php");

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['idp'];
    $status = $_POST['status'];
    $logged_user_id = $_SESSION['id'];

    $sql = "UPDATE inventorypositions SET checked='$status', userid='$logged_user_id' WHERE idp=$id";


    if ($conn->query($sql) === TRUE) {
        $_SESSION['notification'] = 4;
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

$conn->close();
