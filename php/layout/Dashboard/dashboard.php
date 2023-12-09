<?php
require_once("../../../includes/authorized.php");
?>


<!doctype html>
<html lang="pl">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../../../images/inventura_logo_small.png">
    <title>INVENTURA</title>
    <link rel="stylesheet" href="../../../css/body_style.css">
    <link rel="stylesheet" href="../../../css/dashboard_style.css">
    <link rel="stylesheet" href="../../../css/products_style.css">
  </head>

  <body>
   <div class="nav">
    <img src="../../../images/inventura_logo_full.png"/>
    <a href="../Dashboard/dashboard.php"><button>Strona główna</button></a>
    <a href="../Products/products.php"><button>Produkty</button></a>
    <?php 
    if($_SESSION['permission'] == 1){
      echo '<a href="../Users/users.php">   <button>Użytkownicy</button></a>';
      echo '<a href="../Reports/reports.php">   <button>Raporty</button></a>';
    }
    ?>
    <a href="../../auth/logout.php"><button>Wyloguj się</button></a>
  </div>

<div class="mainbox">
  <div class="welcometext"> <?php echo "Witaj z powrotem, ".$_SESSION['login'].'!'; ?>  </div>

  <div class="summaryboxes">
    <div class="box1"> Wszystkich przedmiotów 
            <p class="count">321</p>
    </div>
    <div class="box2"> Wszystkich kategorii 
            <p class="count">21</p>
    </div>
    <div class="box3"> Wszystkich komputerów 
            <p class="count">63</p>
    </div>
  </div>


  <div class="tabletext"> Ostatnio dodane przedmioty </div>

  <div id="myModal" class="modalAlert">
    <div class="modal-content">
        <p>To jest modal!</p>
    </div>
</div>

<?php

if(isset($_SESSION['error1']) && $_SESSION['error1'] == 1) {
  echo '
  <script>
      document.addEventListener("DOMContentLoaded", function() {
          var modal = document.getElementById("myModal");
          modal.style.display = "block";
      });
  </script>
  ';
}

unset($_SESSION['error1']);
?>

  <?php
require_once "../../../includes/connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_errno;
} else {
    $limit = 12; // Display only the last 20 elements

    $sql = "SELECT * FROM produkty ORDER BY idp DESC LIMIT $limit";
    $result = $polaczenie->query($sql);

    echo '<table class="table_products">';
    echo <<<END
      <thead>
        <tr>
          <th>ID</th>
          <th>Nazwa</th>
          <th>Kategoria</th>
          <th>Nr seryjny</th>
          <th>Nr ewidencyjny</th>
        </tr>
      </thead>
      END;

    echo "<tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["idp"] . "</td>";
            echo "<td>" . $row["namep"] . "</td>";
            echo "<td>" . $row["categoryp"] . "</td>";
            echo "<td>" . $row["serialp"] . "</td>";
            echo "<td>" . $row["registrationp"] . "</td>";

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Brak rekordów w tabeli.</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";

    $polaczenie->close();
}
?>


</div>
  <script>
    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 3000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>

     

  </body>

</html>
