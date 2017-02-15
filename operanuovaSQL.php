<?php
include 'controllo.php';
include 'php/config.php';
include 'php/utilita.php';


// RECUPERO DATI E AGGIUNGO
define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

$errors = array();

if (empty($_GET['fkcasaeditrice'])) {
    $errors['fkcasaeditrice'] = 'Casa editrice non passata';
} else {
    $fkcasaeditrice = $_GET['fkcasaeditrice'];
}

if (empty($_GET['titolo'])) {
    $errors['titolo'] = 'Titolo non passato';
} else {
    $titolo = pulisciStringa($_GET['titolo']);
}

// Dato opzionale
if (!isset($_GET['sottotitolo'])) {
    $sottotitolo = "";
} else {
    $sottotitolo = pulisciStringa($_GET['sottotitolo']);
}

if (!isset($_GET['isbn'])) {
    $errors['isbn'] = 'isbn non passato';
} else {
    $isbn = pulisciStringa($_GET['isbn']);
}

// Dato opzionale
if (!isset($_GET['pagine'])) {
    $pagine = 0;
} else {
    $pagine = pulisciStringa($_GET['pagine']);
}

if (empty($_GET['prezzo']) && strlen($_GET['prezzo'])==0) {
    $errors['prezzo'] = 'prezzo non passato';
} else {
    $prezzo = $_GET['prezzo'];
}

if (empty($_GET['fkcollana'])) {
    $errors['fkcollana'] = 'Collana non passata';
} else {
    $fkcollana = $_GET['fkcollana'];
}

if (empty($_GET['fktipologia'])) {
    $errors['fktipologia'] = 'tipologia non passata';
} else {
    $fktipologia = $_GET['fktipologia'];
}

if (empty($errors)) {
    try {
        include 'php/config.php';

        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');


        $db->exec("INSERT INTO libri (idlibro, fkcasaeditrice, titolo, sottotitolo, isbn, pagine, prezzo, fkcollana, fktipologia) VALUES (NULL, '" . $fkcasaeditrice . "', '" . $titolo . "', '" . $sottotitolo . "', '" . $isbn . "', '" . $pagine . "', '" . $prezzo . "', '" . $fkcollana . "', '" . $fktipologia ."');");


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

header('Location: ./operelista.php');
