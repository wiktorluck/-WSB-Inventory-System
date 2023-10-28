<?php
require_once("../../includes/authorized.php");
?>


<!doctype html>
<html lang="pl">
  <head>
    <title>Dashboard</title>
  </head>
  <body>
       <a href="dashboard.php"><button>Dashboard</button></a>
      <a href="products.php"><button>Products</button></a>
      <a href="users.php"><button>Users</button></a>

      <a href="../auth/logout.php"><button>Wyloguj się</button></a>


      
  <h2>Użytkownicy</h2>
      <div class="table-responsive small">
<?php
      require_once "../../includes/connect.php";

     $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

      if ($polaczenie->connect_errno!=0)
        {
          echo "Error: ".$polaczenie->connect_errno;
        }
          else
        {

          $sql = "SELECT id, login FROM uzytkownicy";
          $result = $polaczenie->query($sql);

          echo'<table class="table table-striped table-sm">';
          echo<<<END
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nazwa</th>
            </tr>
          </thead>
          END;

          echo"  <tbody>";
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["login"] . "</td>";
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