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
    $login = $_POST['login'];
    $permission = $_POST['permission'];

    if(isset($_POST['resetPassword']) && $_POST['resetPassword'] == 'on') {
        $temporaryPassword = generateTemporaryPassword();
        
        $hashedPassword = password_hash($temporaryPassword, PASSWORD_BCRYPT);

        $sql = "UPDATE uzytkownicy SET login='$login', password='$hashedPassword', changePassword=1, permission='$permission' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['notification'] = 7;
            $_SESSION['temporaryPassword'] = $temporaryPassword;
            header('Location: users.php');
            exit();
        } else {
            $_SESSION['notification'] = 5;
            header('Location: users.php');
            exit();
        }
    }
} else {
    echo "Nieprawidłowe żądanie.";
}


function generateTemporaryPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    $charactersLength = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $charactersLength - 1)];
    }
    return $password;
}



$conn->close();







