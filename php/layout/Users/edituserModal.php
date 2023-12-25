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
        echo '<h3>Edycja użytkownika</h3>';
        echo '<form id="updateUserForm" action="edituser.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '"></br>';
        echo '<input type="hidden" name="password" value="' . $row['password'] . '"></br>';
        echo '<input type="hidden" name="resetPassword" value="0"></br>';
        
        echo '<label for="login">Login:</label>';
        echo '<input type="text" name="login" value="' . $row['login'] . '"></br>';
        echo '<label for="permission">Uprawnienia:</label>';
        echo '<select id="permission" name="permission">';
        if($row['permission'] == 1){
            echo '<option value="1" selected>Administrator</option>
                  <option value="0">Pracownik</option>';         
        }
        if($row['permission'] == 0){
            echo '<option value="0" selected>Pracownik</option>
                  <option value="1">Administrator</option>';
        }
        echo '</select></br>';
        
        echo '<label for="resetPassword">Resetuj hasło</label>';
        echo '<input type="checkbox" id="resetPassword" name="resetPassword"></br></br></br>';
        
        echo '<input type="submit" value="Aktualizuj">';
        echo '</form>';
        
    } else {
        echo "Brak danych o użytkowniku.";
    }

    $conn->close();
} else {
    echo "Nieprawidłowe żądanie.";
} 








