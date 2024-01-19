<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/connect.php");

$conn = @new mysqli($host, $db_user, $db_password, $db_name);


if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM inventorypositions WHERE idp = $id";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {

        $row = $result->fetch_assoc();
        echo '<div class="updateInventoryDiv">';
        echo '<form id="updateInventoryForm" action="editinventory.php" method="POST">';
        echo '<input type="hidden" name="idp" value="' . $row['idp'] . '"></br>';
        echo '<input type="text" disabled name="namep" value="' . $row['namep'] . '"></br>';
        echo '<input type="text" disabled name="categoryp" value="' . $row['categoryp'] . '"></br>';
        echo '<input type="text" disabled name="serialp" value="' . $row['serialp'] . '"></br>';
        echo '<input type="text" disabled name="registrationp" value="' . $row['registrationp'] . '"></br>';
        echo '<label for="status">Wybierz status:</label>
            <select id="status" name="status">
                <option value="Brak">Brak</option>
                <option value="Zgodnosc">Zgodność</option>
            </select>
            ';

        echo '<input type="submit" value="Aktualizuj">';
        echo '</form>';
        echo '</div>';
    } else {
        echo "Brak danych o produkcie.";
    }

    $conn->close();
} else {
    echo "Nieprawidłowe żądanie.";
}