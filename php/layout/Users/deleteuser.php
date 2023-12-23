<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/connect.php");

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];


    $sql = "DELETE FROM uzytkownicy WHERE id = $id;";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['notification'] = 4;
        header('Location: users.php');
        exit();
    } else {
        $_SESSION['notification'] = 5;
        header('Location: users.php');
        exit();
    }
} else {
    echo "Nieprawidłowe żądanie.";
}

$conn->close();
