<?php
include 'controllo.php';
include 'php/utilita.php';
include 'php/config.php';

// RECUPERO DATI E AGGIUNGO
define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

$errors = array();

if (isset($_GET['idstampa'])) {
    if ((empty($_GET['idstampa']) && strlen($_GET['idstampa'])>0) || (!empty($_GET['idstampa']))) {
        $idstampa = $_GET['idstampa'];
    } else {
        $errors['idstampa'] = 'Errore parametro vuoto (empty)';
    }
} else {
    $errors['idstampa'] = 'Errore parametro non settato';
}

// ***************  Caricamento dati FINE

// METODO CON ROLLBACK
$db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false ));


//Inizia la transazione
$db->beginTransaction();

try {
    //Cancella stampa
    $sql = "DELETE FROM stampe WHERE idstampa = ?;";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($idstampa));

    //Se non ci sono eccezioni commit
    $db->commit();
}
    //Se sollevate eccezioni
catch(Exception $e){
    echo $e->getMessage();
    //Rollback la transazione
    $db->rollBack();
    $errors['DB'] = 'Errore nel database';
}

$db = NULL;



// Mando il messaggio del risultato e redirigo
session_start();
if (!empty($errors)) {
    $_SESSION['sqlerrori'] = implode(", ", $errors);
} else {
    $_SESSION['sqlok'] = "OPERAZIONE RIUSCITA";
}

header('Location: ./stampalista.php');