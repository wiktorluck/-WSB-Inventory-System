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


    $sql = "DELETE FROM produkty WHERE idp = $id;";

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

$conn->close();
