<?php
    require_once("../../../includes/authorized.php");
    require_once("../../../includes/connect.php");
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_errno != 0) {
        echo "Error: " . $conn->connect_errno;
    } else {
        $login = $_POST['loginu'];
        $password = $_POST['passwordu'];
        $permission = $_POST['permissionu'];


        if (empty($login)) {
            $_SESSION['notification'] = 5;
            header('Location: users.php');
            exit();
            $conn->close();
        }

        if (empty($password)) {
            $_SESSION['notification'] = 5;
            header('Location: users.php');
            exit();
            $conn->close();
        }
    
        $query = "SELECT * FROM uzytkownicy WHERE login='" . mysqli_real_escape_string($conn, $login) . "'";
        $rezultat = @$conn->query($query);
    
        if ($rezultat) {
            if ($rezultat->num_rows > 0) {
                $_SESSION['notification'] = 6;
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_query = "INSERT INTO uzytkownicy (login, password, permission) VALUES ('" . mysqli_real_escape_string($conn, $login) . "', '" . $hashed_password . "', '" . $permission . "')";
                
                if ($conn->query($insert_query)) {
                    $_SESSION['notification'] = 4;
                    header('Location: users.php');
                    exit();
            }
        }
        } else {
            $_SESSION['notification'] = 5;
        }
    
        header('Location: users.php');
        exit();
    }
    $conn->close();