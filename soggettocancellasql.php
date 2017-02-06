<?php
include 'controllo.php';
include 'php/utilita.php';
include 'php/config.php';

// RECUPERO DATI E AGGIUNGO
define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

$errors = array();

if (isset($_GET['fksoggetto'])) {
    if ((empty($_GET['fksoggetto']) && strlen($_GET['fksoggetto'])>0) || (!empty($_GET['fksoggetto']))) {
        $fksoggetto = $_GET['fksoggetto'];
    } else {
        $errors['fksoggetto'] = 'Errore vuoto (empty)';
    }
} else {
    $errors['fksoggetto'] = 'Errore non settato';
}

// ***************  Caricamento dati FINE

// METODO CON ROLLBACK
$db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false ));

// Cerca se ci sono movimenti associati
$sqlmovimenti = "SELECT COUNT(fksoggetto) AS numeromovimenti FROM movimenti WHERE fksoggetto = '" . $fksoggetto ."' GROUP BY fksoggetto";
$result = $db->query($sqlmovimenti);
$row = $result->fetch(PDO::FETCH_ASSOC);
$numeromovimenti = $row['numeromovimenti'];

// Solo se non ci sono movimenti collegati allora cancella
if($numeromovimenti == 0) {

    //Inizia la transazione
    $db->beginTransaction();

    try {
        //Cancella soggetto
        $sql = "DELETE FROM soggetti WHERE idsoggetto = ?;";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($fksoggetto));

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

} else {
    $errors['movimenti'] = 'Presenza di movimenti del soggetto che si vuole cancellare';
}

// Mando il messaggio del risultato e redirigo
session_start();
if (!empty($errors)) {
    $_SESSION['sqlerrori'] = implode(", ", $errors);
} else {
    $_SESSION['sqlok'] = "INSERIMENTO OK";
}

header('Location: ./soggettilista.php');