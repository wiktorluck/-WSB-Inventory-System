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


        <p>Raport brakujących pozycji:<br>
            </br></br>
            <hr>
            <?php
            require_once "../../../../includes/connect.php";

            $conn = @new mysqli($host, $db_user, $db_password, $db_name);
            if ($conn->connect_errno != 0) {
                echo "Error: " . $conn->connect_errno;
            } else {
                $sql = "SELECT * FROM inventorypositions WHERE checked = 'Niesprawdzone';";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    echo '<table border="1">';
                    echo '
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nazwa</th>
                            <th>Kategoria</th>
                            <th>Nr seryjny</th>
                            <th>Nr ewidencyjny</th>
                            <th>Cena ewidencyjna</th>
                        </tr>
                    </thead>';
                    echo '<tbody>';

                    $deficit = 0;
                    $shortcomings = 0;

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['idip'] . '</td>';
                        echo '<td>' . $row['namep'] . '</td>';
                        echo '<td>' . $row['categoryp'] . '</td>';
                        echo '<td>' . $row['serialp'] . '</td>';
                        echo '<td>' . $row['registrationp'] . '</td>';
                        echo '<td>' . $row['pricep'] . ' zł</td>';
                        echo '</tr>';
                    }

                    echo '</tbody></table>';
                } else {
                    echo "Brak wyników spełniających kryteria.";
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