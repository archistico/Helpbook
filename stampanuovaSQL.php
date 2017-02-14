<?php

include 'controllo.php';
include 'php/config.php';
include 'php/utilita.php';

// RECUPERO DATI E AGGIUNGO
define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

$errors = array();

if (empty($_GET['fklibro'])) {
    $errors['fklibro'] = 'fklibro non passato';
} else {
    $fklibro = $_GET['fklibro'];
}

if (empty($_GET['fktipografia'])) {
    $errors['fktipografia'] = 'fktipografia non passato';
} else {
    $fktipografia = $_GET['fktipografia'];
}

if (empty($_GET['stampadata'])) {
    $errors['stampadata'] = 'stampa data non passato';
} else {
    $stampadata = DateTime::createFromFormat('d/m/Y', $_GET['stampadata']);
}

if (empty($_GET['stampaquantita']) && strlen($_GET['stampaquantita'])==0) {
    $errors['stampaquantita'] = 'stampa quantita non passato';
} else {
    $stampaquantita = $_GET['stampaquantita'];
}

if (empty($_GET['stampacosto']) && strlen($_GET['stampacosto'])==0) {
    $errors['stampacosto'] = 'stampa costo non passato';
} else {
    $stampacosto = $_GET['stampacosto'];
}

if (empty($_GET['stampaspedizione']) && strlen($_GET['stampaspedizione'])==0) {
    $errors['stampaspedizione'] = 'stampa spedizione non passato';
} else {
    $stampaspedizione = $_GET['stampaspedizione'];
}

if (empty($_GET['stampaiva']) && strlen($_GET['stampaiva'])==0) {
    $errors['stampaiva'] = 'stampa iva non passato';
} else {
    $stampaiva = $_GET['stampaiva'];
}

// Dato opzionale
if (!isset($_GET['stampadocumento'])) {
    $stampadocumento = "";
} else {
    $stampadocumento = pulisciStringa($_GET['stampadocumento']);
}

// ***************  Caricamento dati FINE

// METODO CON ROLLBACK
$db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false ));

//Inizia la transazione
$db->beginTransaction();

try {

    $sql = "INSERT INTO stampe 
            VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = $db->prepare($sql);
    $stmt->execute(array($fklibro, $stampadata->format('Y-m-d'), $stampaquantita, $stampacosto, $stampaspedizione, $stampaiva, $fktipografia, $stampadocumento, 0));

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
    $_SESSION['sqlok'] = "INSERIMENTO OK";
}

header('Location: ./stampalista.php');
