<?php
    require_once("../../../includes/authorized.php");
    require_once("../../../includes/connect.php");

  $conn = @new mysqli($host, $db_user, $db_password, $db_name);


  if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;}

    if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM uzytkownicy WHERE id = $id";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        echo '<form id="updateUserForm" action="edituser.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '"></br>';
        echo '<input type="text" name="login" value="' . $row['login'] . '"></br>';
        echo '<input type="text" name="password" value="' . $row['password'] . '"></br>';
        echo '<input type="text" name="permission" value="' . $row['permission'] . '"></br>';
        echo '<input type="submit" value="Aktualizuj">';
        echo '</form>';
    } else {
        echo "Brak danych o użytkowniku.";
    }

    $conn->close();
} else {
    echo "Nieprawidłowe żądanie.";
} 