<?php
require_once("../../../includes/authorized.php");
?>


<!doctype html>
<html lang="pl">
  <head>
    <title>Produkty</title>
  </head>
 
 
 
  <body>
      <a href="../Dashboard/dashboard.php"><button>Dashboard</button></a>
      <a href="products.php"><button>Products</button></a>
      <a href="../Users/users.php"><button>Users</button></a>

      <a href="../../auth/logout.php"><button>Wyloguj się</button></a>


  <h2>Produkty</h2>
      <div class="table-responsive small">
<?php
      require_once "../../../includes/connect.php";

     $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

      if ($polaczenie->connect_errno!=0)
        {
          echo "Error: ".$polaczenie->connect_errno;
        }
          else
        {

          $sql = "SELECT * FROM produkty";
          $result = $polaczenie->query($sql);

          echo'<table class="table table-striped table-sm">';
          echo<<<END
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nazwa</th>
              <th scope="col">Ilość</th>
              <th scope="col">Kategoria</th>
              <th scope="col">Nr seryjny</th>
              <th scope="col">Nr ewidencyjny</th>
              <!-- Kategoria -->
              <!-- Nr seryjny -->
              <!-- Nr ewidencyjny -->
            </tr>
          </thead>
          END;

          echo"  <tbody>";
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["idp"] . "</td>";
                echo "<td>" . $row["namep"] . "</td>";
                echo "<td>" . $row["quantityp"] . "</td>";
                echo "<td>" . $row["categoryp"] . "</td>";
                echo "<td>" . $row["serialp"] . "</td>";
                echo "<td>" . $row["registrationp"] . "</td>";

                echo "</tr>";
            }
        } else {
            echo "Brak rekordów w tabeli.";
        }   
          $polaczenie->close();
        }
  ?>
            </tr>
          </tbody>
        </table>
  </body>

</html>