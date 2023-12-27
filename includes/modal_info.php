<?php

//DON'T PERMISSIONS
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 1) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalAlert-content">
        <p>Brak wystarczających uprawnień!</p>
    </div>
  </div>';
}

//WRONG LOGIN OR PASSWORD
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 2) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalAlert-content">
        <p>Nieprawidłowy login lub hasło!</p>
    </div>
  </div>';
}

//LOGIN SUCCESS
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 3) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalSuccess-content">
        <p>Pomyślnie zalogowano do systemu!</p>
    </div>
  </div>';
}


//EDIT SUCCESS
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 4) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalSuccess-content">
        <p>Dane zostały zaktualizowane poprawnie!</p>
    </div>
  </div>';
}

//EDIT FAIL
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 5) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalAlert-content">
        <p>Dane nie zostały zaktualizowane!</p>
    </div>
  </div>';
}

//ADD USER FAIL
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 6) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalAlert-content">
        <p>Dane nie zostały zaktualizowane! Istnieje już użytkownik o podanym loginie!</p>
    </div>
  </div>';
}


//**MODAL Z TYMCZASOWYM HASŁEM
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 7) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalSuccess-content">';
  echo 'Nowe hasło:';
  echo $_SESSION['temporaryPassword'];
  echo '  </div>
  </div>';
}


//WARNING ABOUT REQUIRED CHANGE PASSWORD
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 8) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalWarning-content">
        <p>Wymagana aktualizacja hasła!</p>
    </div>
  </div>';
}

//DIFFRENT PASSWORDS
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 9) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalAlert-content">
        <p>Hasła różnią się od siebie!</p>
    </div>
  </div>';
}

//EMTY PASSWORDS
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 10) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalAlert-content">
        <p>Wymagane wpisanie hasła!</p>
    </div>
  </div>';
}

//REGISTRATION NUMBER IS BUSY
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 11) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalAlert-content">
        <p>Produkt nie został dodany do bazy, ponieważ istnieje już produkt w bazie o podanym numerze ewidencyjnym!</p>
    </div>
  </div>';
}

//ADD PRODUCT VALIDATION
if (isset($_SESSION['notification']) && $_SESSION['notification'] == 12) {
  echo '
  <div id="notificationBar" class="modalNotification">
    <div class="modalAlert-content">
        <p>Produkt nie został dodany do bazy, podano błędne dane!</p>
    </div>
  </div>';
}

unset($_SESSION['notification']);
unset($_SESSION['temporaryPassword']);

