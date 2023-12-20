<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/connect.php");

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namep = $_POST['namep'];
    $categoryp = $_POST['categoryp'];
    $serialp = $_POST['serialp'];
    $registrationp = $_POST['registrationp'];

    $sql = "INSERT INTO produkty (namep, categoryp, quantityp, serialp, registrationp) VALUES ('$namep', '$categoryp', 1, '$serialp', '$registrationp')";

    echo $sql;
    if ($conn->query($sql) === TRUE) {
        $_SESSION['notification'] = 4;
        header('Location: products.php');
        exit();
    } else {
        $_SESSION['notification'] = 5;
        header('Location: products.php');
        exit();
    }
} else {
    echo "Nieprawidłowe żądanie.";
}

