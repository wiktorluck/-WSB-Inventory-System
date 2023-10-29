<?php
    require_once("../../../includes/authorized.php");
    require_once("../../../includes/connect.php");
    
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($polaczenie->connect_errno != 0) {
        echo "Error: " . $polaczenie->connect_errno;
    } else {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $permission = $_POST['permission'];


        if (empty($login)) {
            $_SESSION['error'] = '<span style="color:red">Wpisz nazwę użytkownika!</span>';
            header('Location: users.php');
            $polaczenie->close();
        }

        if (empty($password)) {
            $_SESSION['error'] = '<span style="color:red">Wpisz hasło!</span>';
            header('Location: users.php');
            $polaczenie->close();
        }
    
        $query = "SELECT * FROM uzytkownicy WHERE login='" . mysqli_real_escape_string($polaczenie, $login) . "'";
        $rezultat = @$polaczenie->query($query);
    
        if ($rezultat) {
            if ($rezultat->num_rows > 0) {
                $_SESSION['error'] = '<span style="color:red">Login zajęty!</span>';
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_query = "INSERT INTO uzytkownicy (login, password, permission) VALUES ('" . mysqli_real_escape_string($polaczenie, $login) . "', '" . $hashed_password . "', '" . $permission . "')";
                
                if ($polaczenie->query($insert_query)) {
                    $_SESSION['success'] = '<span style="color:green">Użytkownik został dodany!</span>';
                    header('Location: users.php');
            }
        }
        } else {
            $_SESSION['error'] = '<span style="color:red">Błąd zapytania SQL!</span>';
        }
    
        header('Location: users.php');
    }
    $polaczenie->close();
    
        