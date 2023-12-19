<?php
  require_once("../../../includes/authorized.php");
  require_once("../../../includes/connect.php");

  $conn = @new mysqli($host, $db_user, $db_password, $db_name);


  if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;}

    if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM produkty WHERE idp = $id";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        echo '<h2>' . $row['idp'] . '</h2>';
        echo '<h2>' . $row['namep'] . '</h2>';
        echo '<h2>' . $row['categoryp'] . '</h2>';
        echo '<h2>' . $row['serialp'] . '</h2>';
        echo '<h2>' . $row['registrationp'] . '</h2>';
    } else {
        echo "Brak danych o produkcie.";
    }

    $conn->close();
} else {
    echo "Nieprawidłowe żądanie.";
} 