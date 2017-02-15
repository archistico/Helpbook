<?php

include 'controllo.php';
include 'php/config.php';
include 'php/utilita.php';


// RECUPERO DATI E AGGIUNGO
define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

$errors = array();

if (empty($_GET['fktipologia'])) {
    $errors['fktipologia'] = 'tipologia non passata';
} else {
    $fktipologia = $_GET['fktipologia'];
}

if (empty($_GET['cognome'])) {
    $errors['cognome'] = 'cognome non passato';
} else {
    $cognome = pulisciStringa($_GET['cognome']);
}

// Dato opzionale
if (!isset($_GET['nome'])) {
    $nome = "";
} else {
    $nome = pulisciStringa($_GET['nome']);
}

if (!isset($_GET['telefono'])) {
    $telefono = "";
} else {
    $telefono = pulisciStringa($_GET['telefono']);
}

if (!isset($_GET['cellulare'])) {
    $cellulare = "";
} else {
    $cellulare = pulisciStringa($_GET['cellulare']);
}

if (!isset($_GET['piva'])) {
    $piva = "";
} else {
    $piva = pulisciStringa($_GET['piva']);
}

if (!isset($_GET['codicefiscale'])) {
    $codicefiscale = "";
} else {
    $codicefiscale = pulisciStringa($_GET['codicefiscale']);
}

if (!isset($_GET['email'])) {
    $email = "";
} else {
    $email = pulisciStringa($_GET['email']);
}

if (!isset($_GET['indirizzo'])) {
    $indirizzo = "";
} else {
    $indirizzo = pulisciStringa($_GET['indirizzo']);
}

if (!isset($_GET['cap'])) {
    $cap = "";
} else {
    $cap = pulisciStringa($_GET['cap']);
}

if (!isset($_GET['comune'])) {
    $comune = "";
} else {
    $comune = pulisciStringa($_GET['comune']);
}

if (!isset($_GET['provincia'])) {
    $provincia = "";
} else {
    $provincia = pulisciStringa($_GET['provincia']);
}

if (!isset($_GET['note'])) {
    $note = "";
} else {
    $note = pulisciStringa($_GET['note']);
}

if (empty($errors)) {
    try {
        include 'php/config.php';

        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $denominazione = trim($cognome . " " . $nome);

        $db->exec("INSERT INTO soggetti (idsoggetto, fktipologia, denominazione, telefono, cellulare, piva, codicefiscale, email, indirizzo, cap, comune, provincia, note) VALUES (NULL, '" . $fktipologia . "', '" . $denominazione . "', '" . $telefono . "', '" . $cellulare . "', '" . $piva . "', '" . $codicefiscale . "', '" . $email . "', '" . $indirizzo ."', '" . $cap . "', '" . $comune . "', '" . $provincia . "', '" . $note . "');");


        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        $errors['database'] = "Errore inserimento nel database";
    }
}

// Mando il messaggio del risultato e redirigo

session_start();
if (!empty($errors)) {
    $_SESSION['sqlerrori'] = implode(", ", $errors);
} else {
    $_SESSION['sqlok'] = "INSERIMENTO OK";
}

header('Location: ./soggettilista.php');
?>