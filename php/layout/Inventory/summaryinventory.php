<!---------------------- php ---------------------->
<?php
require_once("../../../includes/authorized.php");
require_once("../../../includes/modal_info.php");
?>
<!---------------------- ^ php ^ ---------------------->

<!---------------------- metainfo ---------------------->
    <!DOCTYPE html>
    <html>
    <head>
        <title>INVENTURA</title>
            <link rel="icon" type="image/x-icon" href="images/inventura_logo_small.png">
            <link rel="stylesheet" href="../../../css/reports.css">
            <link rel="stylesheet" href="../../../css/notification_modals.css">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta charset="utf-8">
                <meta name="description" content="System Inwentaryzacji Sprzętu Komputerowego">
                <meta name="author" content="BKolacz, WLuck, MLisiecki">
                <meta name="keywords" content="inwentaryzacja, sprzęt komputerowy"/>
    </head>
<!---------------------- ^ metainfo ^ ---------------------->
<!---------------------------- content ---------------------------->
<body>
<div class="summaryform">
        <div class="infoSummary">
        <div class="inventoryButton1"><button onclick="printPage()">Wydruk</button></div>
        <form action="endinventory.php" method="POST">
            <br>
            <p>Zakończenie Inventaryzacji:<br>
                </br></br>
                Braki:
                <hr>
                <div class="TableInventory">
                <?php
                require_once "../../../includes/connect.php";
                $conn = @new mysqli($host, $db_user, $db_password, $db_name);
                if ($conn->connect_errno != 0) {
                    echo "Error: " . $conn->connect_errno;
                } else {
                    $sql = "SELECT * FROM inventorypositions WHERE checked = 'brak';";
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        echo '<table class="printTable" border="1">';
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
                        echo '</br></br>';
                        echo 'Podsumowanie:';
                        echo '<hr>';
                        echo '<p>Manko: ' . $_SESSION['deficit'] . ' zł</p>';
                        echo '<p>Ilość brakujących towarów: ' . $_SESSION['shortcomings'] . '</p>';
                    } else {
                        echo "Brak wyników spełniających kryteria.";
                    }
                }
                ?>
                </div>


                <div class="TableInventoryPortrait">
                <?php
                require_once "../../../includes/connect.php";
                $conn = @new mysqli($host, $db_user, $db_password, $db_name);
                if ($conn->connect_errno != 0) {
                    echo "Error: " . $conn->connect_errno;
                } else {
                    $sql = "SELECT * FROM inventorypositions WHERE checked = 'brak';";
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        echo '<table class="printTable" border="1">';
                        echo '
                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Nr ewidencyjny</th>
                            <th>Cena ewidencyjna</th>
                        </tr>
                    </thead>';
                        echo '<tbody>';

                        $deficit = 0;
                        $shortcomings = 0;

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['namep'] . '</td>';
                            echo '<td>' . $row['registrationp'] . '</td>';
                            echo '<td>' . $row['pricep'] . ' zł</td>';
                            echo '</tr>';
                        }

                        echo '</tbody></table>';
                        echo '</br></br>';
                        echo 'Podsumowanie:';
                        echo '<hr>';
                        echo '<p>Manko: ' . $_SESSION['deficit'] . ' zł</p>';
                        echo '<p>Ilość brakujących towarów: ' . $_SESSION['shortcomings'] . '</p>';
                    } else {
                        echo "Brak wyników spełniających kryteria.";
                    }
                }
                ?>
                </div>


                <br>

            <div class="inventoryButton1"><button type="submit" name="change">Zakończ Inventaryzację</button></div>
            <br>
            <div class="inventoryButton1"><button type="submit" name="logout">Wstecz</button></div>
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