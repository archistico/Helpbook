<?php
// Inserisci in questo punto il codice per la connessione al DB e l'utilizzo delle varie funzioni.

include 'db_connect.php';
include 'functions.php';

sec_session_start();

if(login_check($mysqli) == false) {
   header('Location: ./login.php?error=3');
}
