<?php
include 'controllo.php';
include 'php/utilita.php';

// RECUPERO DATI E AGGIUNGO
define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

$errors = array();

if (empty($_GET['idlibro'])) {
    $errors['idlibro'] = 'idlibro non passato';
} else {
    $idlibro = $_GET['idlibro'];
}

if (empty($_GET['fktipologia'])) {
    $errors['fktipologia'] = 'fktipologia non passato';
} else {
    $fktipologia = $_GET['fktipologia'];
}

if (empty($_GET['fkcasaeditrice'])) {
    $errors['fkcasaeditrice'] = 'fkcasaeditrice non passato';
} else {
    $fkcasaeditrice = $_GET['fkcasaeditrice'];
}

if (empty($_GET['titolo'])) {
    $errors['titolo'] = 'titolo non passato';
} else {
    $titolo = str_replace("'", "''",$_GET['titolo']);
}

if (empty($_GET['fkcollana'])) {
    $errors['fkcollana'] = 'fkcollana non passato';
} else {
    $fkcollana = $_GET['fkcollana'];
}

if (empty($_GET['isbn'])) {
    $errors['isbn'] = 'isbn non passato';
} else {
    $isbn = $_GET['isbn'];
}

if (!isset($_GET['prezzo'])) {
    $errors['prezzo'] = 'prezzo non passato';
} else {
    $prezzo = $_GET['prezzo'];
}

// Dato opzionale
if (!isset($_GET['sottotitolo'])) {
    $sottotitolo = "";
} else {
    $sottotitolo = str_replace("'", "''",$_GET['sottotitolo']);
}

if (!isset($_GET['pagine'])) {
    $pagine=0;
} else {
    $pagine = $_GET['pagine'];
}


if (empty($errors)) {
    try {
        include 'php/config.php';

        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = "UPDATE libri "
            ."SET fkcasaeditrice='".$fkcasaeditrice."', "
            ."titolo='".$titolo."', "
            ."sottotitolo='".$sottotitolo."', "
            ."isbn='".$isbn."', "
            ."pagine='".$pagine."', "
            ."prezzo='".$prezzo."', "
            ."fkcollana='".$fkcollana."', "
            ."fktipologia='".$fktipologia."' "
            ."WHERE libri.idlibro=".$idlibro;

        $db->exec($sql);


        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        $errors['database'] = "Errore modifica nel database";
    }
}


