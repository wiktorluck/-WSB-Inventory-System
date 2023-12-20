<?php
    require_once("../../../includes/authorized.php");
    require_once("../../../includes/connect.php");
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_errno != 0) {
        echo "Error: " . $conn->connect_errno;
    } else {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $permission = $_POST['permission'];


        if (empty($login)) {
            $_SESSION['notification'] = 5;
            header('Location: users.php');
            $conn->close();
        }

        if (empty($password)) {
            $_SESSION['notification'] = 5;
            header('Location: users.php');
            $conn->close();
        }
    
        $query = "SELECT * FROM uzytkownicy WHERE login='" . mysqli_real_escape_string($conn, $login) . "'";
        $rezultat = @$conn->query($query);
    
        if ($rezultat) {
            if ($rezultat->num_rows > 0) {
                $_SESSION['notification'] = '<span style="color:red">Login zajęty!</span>';
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_query = "INSERT INTO uzytkownicy (login, password, permission) VALUES ('" . mysqli_real_escape_string($conn, $login) . "', '" . $hashed_password . "', '" . $permission . "')";
                
                if ($conn->query($insert_query)) {
                    $_SESSION['notification'] = 4;
                    header('Location: users.php');
            }
        }
        } else {
            $_SESSION['notification'] = 5;
        }
    
        header('Location: users.php');
    }
    $conn->close();
    
        