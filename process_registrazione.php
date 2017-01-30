<?php
include 'db_connect.php';
include 'functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if(isset($_POST['email'], $_POST['p'], $_POST['username'])) {
   $email = $_POST['email'];
   $password = $_POST['p']; // Recupero la password criptata.
   $username = $_POST['username'];
   
   // Crea una chiave casuale
   $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
   // Crea una password usando la chiave appena creata.
   $password = hash('sha512', $password.$random_salt);
   // Inserisci a questo punto il codice SQL per eseguire la INSERT nel tuo database
   // Assicurati di usare statement SQL 'prepared'.
   if ($insert_stmt = $mysqli->prepare("INSERT INTO utente (username, email, password, salt) VALUES (?, ?, ?, ?)")) {
      $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
      // Esegui la query ottenuta.
      $insert_stmt->execute();
   }

} else {
   // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
   echo 'Invalid Request';
}
