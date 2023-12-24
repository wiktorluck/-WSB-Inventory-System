<?php
  require_once("../../../includes/authorized.php");
  require_once("../../../includes/connect.php");

$conn = new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql_delete_produkty = "DELETE FROM produkty
            WHERE EXISTS (
                SELECT * FROM inventorypositions
                WHERE inventorypositions.idp = produkty.idp
                AND inventorypositions.checked = 'Brak'
            );";

    $sql_delete_inventory = "DELETE FROM inventorypositions;";

    if ($conn->query($sql_delete_produkty) === TRUE && $conn->query($sql_delete_inventory) === TRUE) {
        $_SESSION['notification'] = 4;
        $_SESSION['activeInventory'] = 0;
    } else {
        $_SESSION['notification'] = 5;
        echo "Błąd: " . $conn->error;
    }

    header('Location: inventory.php');
    exit();
} else {
    echo "Nieprawidłowe żądanie.";
}

