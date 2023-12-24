<?php

//DON'T PERMISSIONS
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 1) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalAlert-content">
        <p>Brak wystarczających uprawnień!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}

//WRONG LOGIN OR PASSWORD
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 2) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalAlert-content">
        <p>Nieprawidłowy login lub hasło!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}

//LOGIN SUCCESS
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 3) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalSuccess-content">
        <p>Pomyślnie zalogowano do systemu!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}


//EDIT SUCCESS
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 4) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalSuccess-content">
        <p>Dane zostały zaktualizowane poprawnie!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}

//EDIT FAIL
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 5) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalAlert-content">
        <p>Dane nie zostały zaktualizowane!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}


unset($_SESSION['notification']);

