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

//ADD USER FAIL
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 6) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalAlert-content">
        <p>Dane nie zostały zaktualizowane! Istnieje już użytkownik o podanym loginie!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}


//**MODAL Z TYMCZASOWYM HASŁEM
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 7) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalSuccess-content">';
       echo 'Nowe hasło:';
       echo $_SESSION['temporaryPassword']; 
  echo'  </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}


//WARNING ABOUT REQUIRED CHANGE PASSWORD **NIE ŚWIECI SIĘ NA POMARAŃCZ
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 8) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalWarning-content">
        <p>Wymagana aktualizacja hasła!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}

//DIFFRENT PASSWORDS
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 9) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalAlert-content">
        <p>Hasła różnią się od siebie!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}

//EMTY PASSWORDS
if(isset($_SESSION['notification']) && $_SESSION['notification'] == 10) {
  echo '
  <div id="myModal" class="modalNotification">
    <div class="modalAlert-content">
        <p>Wymagane wpisanie hasła!</p>
    </div>
  </div>

  <script src="../../../js/modals.js"></script>';
}


unset($_SESSION['notification']);
unset($_SESSION['temporaryPassword']); 

