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
        echo '<form id="deleteForm" action="deleteproduct.php" method="POST">';
        echo '<p>Czy potwierdzasz usunięcie produktu: (' .$row['namep']. ') z bazy danych?</br>';
        echo '<input type="hidden" name="idp" value="' . $row['idp'] . '"></br>';
        echo '<input type="submit" value="Tak">';
        echo '</form>';
    } else {
        echo "Brak danych o produkcie.";
    }

    $conn->close();
} else {
    echo "Nieprawidłowe żądanie.";
} 