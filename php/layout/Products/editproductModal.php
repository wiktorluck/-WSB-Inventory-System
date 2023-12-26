<?php
  require_once("../../../includes/authorized.php");
  require_once("../../../includes/connect.php");

  $conn = @new mysqli($host, $db_user, $db_password, $db_name);


  if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;}

    if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM products WHERE idp = $id";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        echo '<form id="updateForm" action="editproduct.php" method="POST">';
        echo '<input type="hidden" name="idp" value="' . $row['idp'] . '"></br>';
        echo '<input type="text" name="namep" value="' . $row['namep'] . '"></br>';
        echo '<input type="text" name="categoryp" value="' . $row['categoryp'] . '"></br>';
        echo '<input type="text" name="serialp" value="' . $row['serialp'] . '"></br>';
        echo '<input type="text" name="pricep" value="' . $row['pricep'] . '"></br>';
        echo '<input type="text" name="registrationp" value="' . $row['registrationp'] . '"></br>';
        echo '<input type="submit" value="Aktualizuj">';
        echo '</form>';
    } else {
        echo "Brak danych o produkcie.";
    }

    $conn->close();
} else {
    echo "Nieprawidłowe żądanie.";
} 