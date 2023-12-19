<?php

//Don't permissions
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 1) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalAlert-content">
        <p>Brak wystarczających uprawnień!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}

//Wrong Login or Password
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 2) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalAlert-content">
        <p>Nieprawidłowy login lub hasło!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}

//Login Success
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 3) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalSuccess-content">
        <p>Pomyślnie zalogowano do systemu!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}




unset($_SESSION['notification']);

