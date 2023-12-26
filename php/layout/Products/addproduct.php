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
    $pricep = $_POST['pricep'];

    if (!is_numeric($registrationp) || !is_numeric($pricep)) {
        $_SESSION['notification'] = 12; 
        header('Location: products.php');
        exit();
    }

    if (empty($namep) || empty($categoryp) || empty($serialp) || empty($registrationp) || empty($pricep)) {
        $_SESSION['notification'] = 11;
        header('Location: products.php');
        exit();
    }

    $check_query = "SELECT COUNT(*) AS registrationp FROM products WHERE registrationp = '$registrationp'";
    $check_result = $conn->query($check_query);

    if ($check_result) {
        $row = $check_result->fetch_assoc();
        $count_registration = $row['registrationp'];

        if ($count_registration > 0) {
            $_SESSION['notification'] = 11;
            header('Location: products.php');
            exit();
        }
    } else {
        echo "Błąd zapytania: " . $conn->error;
        exit();
    }

    $sql = "INSERT INTO products (namep, categoryp, quantityp, serialp, registrationp, pricep) VALUES ('$namep', '$categoryp', 1, '$serialp', '$registrationp','$pricep')";

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
