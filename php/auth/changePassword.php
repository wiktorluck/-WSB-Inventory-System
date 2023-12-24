<?php
require_once("../../includes/authorized.php");
require_once("../../includes/connect.php");

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['change'])) {
        $newPassword = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if ($newPassword === $confirmPassword) {
            $userId = $_SESSION['id'];
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE uzytkownicy SET password='$hashedPassword', changePassword=0 WHERE id=$userId";

            $result = $conn->query($sql);

            if ($result) {
                if ($_SESSION['activeInventory'] == 1) {
                    $_SESSION['notification'] = 3;
                    header('Location: ../layout/Inventory/inventory.php');
                    exit();
                } else {
                    $_SESSION['notification'] = 3;
                    header('Location: ../layout/Dashboard/dashboard.php');
                    exit();
                }
            } else {
                echo "Error: " . $conn->error;
                exit();
            }
        } else {
            header('Location: ../../newPassword.php');
            exit();
        }
    } elseif (isset($_POST['logout'])) {
        session_start();
        session_unset();
        header('Location: ../../index.php');
        exit();
    }
}

$conn->close();

