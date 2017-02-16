<?php
include 'controllo.php';
include 'php/utilita.php';
include 'php/config.php';

// RECUPERO DATI E AGGIUNGO
define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

$errors = array();

if (isset($_GET['idlibro'])) {
    if ((empty($_GET['idlibro']) && strlen($_GET['idlibro'])>0) || (!empty($_GET['idlibro']))) {
        $idlibro = $_GET['idlibro'];
    } else {
        $errors['idlibro'] = 'Errore idlibro vuoto (empty)';
    }
} else {
    $errors['idlibro'] = 'Errore idlibro non settato';
}

// ***************  Caricamento dati FINE

// METODO CON ROLLBACK
$db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false ));

// Cerca se ci sono movimenti associati
$sqlmovimenti = "SELECT COUNT(fklibro) AS numeromovimenti FROM movimentidettaglio WHERE fklibro = '" . $idlibro ."' GROUP BY fklibro";
$result = $db->query($sqlmovimenti);
$row = $result->fetch(PDO::FETCH_ASSOC);
$numeromovimenti = $row['numeromovimenti'];

// Solo se non ci sono movimenti collegati allora cancella
if($numeromovimenti == 0) {

    //Inizia la transazione
    $db->beginTransaction();

    try {
        //Cancella soggetto
        $sql = "DELETE FROM libri WHERE idlibro = ?;";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($idlibro));

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
    $errors['movimenti'] = 'Presenza di movimenti con l\'opera che si vuole cancellare';
}

// Mando il messaggio del risultato e redirigo
session_start();
if (!empty($errors)) {
    $_SESSION['sqlerrori'] = implode(", ", $errors);
} else {
    $_SESSION['sqlok'] = "CANCELLAZIONE OK";
}

header('Location: ./operelista.php');