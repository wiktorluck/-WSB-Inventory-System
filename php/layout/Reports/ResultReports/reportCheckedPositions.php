<?php
require_once("../../../../includes/authorized.php");
require_once("../../../../includes/modal_info.php");
?>

<!DOCTYPE html>

<html>

<head>
    <link rel="icon" type="image/x-icon" href="images/inventura_logo_small.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="System Inwentaryzacji Sprzętu Komputerowego">
    <meta name="author" content="">
    <meta name="generator" content="">
    <link rel="stylesheet" href="../../../../css/loginform.css">
    <link rel="stylesheet" href="../../../../css/body_style.css">
    <link rel="stylesheet" href="../../../../css/notification_modals.css">
    <title>INVENTURA</title>
</head>

<body>
    <div class="summaryform">


        <p>Raport sprawdzonych pozycji:<br>
            </br></br>
            <hr>
            <?php
require_once "../../../../includes/connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);
if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_errno;
} else {
    $rowsPerPage = 10; // Set the number of rows per page
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1; // Get the current page from URL
    $start = ($currentPage - 1) * $rowsPerPage;

    // First, get the total number of rows
    $totalRowsResult = $conn->query("SELECT COUNT(*) as total FROM inventorypositions WHERE checked = 'Zgodnosc' OR checked= 'Brak'");
    $totalRows = $totalRowsResult->fetch_assoc()['total'];
    $totalPages = ceil($totalRows / $rowsPerPage);

    // Now, modify your SQL query to get only the rows for the current page
    $sql = "SELECT * FROM inventorypositions WHERE checked = 'Zgodnosc' OR checked= 'Brak' LIMIT $start, $rowsPerPage";
    $result = $conn->query($sql);

    // Rest of your code to display the table...
    // ...

    // Display page links
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '">' . $i . '</a> ';
    }
}
?>

            <br><br><br>

            <br>
        <div class="loginbutton"><button onclick="printPage()">Wydruk</button></div>
        <a href="../reports.php">
            <div class="loginbutton"><button type="submit" name="logout">Wstecz</button></div>
        </a>
        </form>

        <div class="footer">INVENTURA @ 2023</div>
    </div>
</body>


<script>
    function printPage() {
        window.print();
    }
</script>

</html>