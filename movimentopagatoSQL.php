<?php

include 'controllo.php';
include 'php/config.php';
include 'php/utilita.php';

// RECUPERO DATI E AGGIUNGO
define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

$errors = array();


if (empty($_GET['idmovimento'])) {
    $errors['idmovimento'] = 'idmovimento non passato';
} else {
    $idmovimento = $_GET['idmovimento'];
}

if (!isset($_GET['pagato'])) {
    $errors['pagato'] = 'pagato non passato';
} else {
    $pagato = $_GET['pagato'];
}

if (empty($_GET['dataPagamento'])) {
    if ($pagato == 1) {
        $errors['dataPagamento'] = 'dataPagamento non passata';
    }
} else {
    $dataPagamento = DateTime::createFromFormat('d/m/Y', $_GET['dataPagamento']);
}


// ***************  Caricamento dati FINE
if (empty($errors)) {
    // METODO CON ROLLBACK
    $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false));

    //Inizia la transazione
    $db->beginTransaction();

    try {

        // In base a se c'è o meno la data di pagamento
        if ($pagato) {
            //Query
            $sql = "UPDATE movimenti SET pagata = ?, datapagamento = ? WHERE movimenti.idmovimento = ?;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $pagato);
            $stmt->bindParam(2, $dataPagamento->format('Y-m-d'));
            $stmt->bindParam(3, $idmovimento);
            $stmt->execute();
        } else {
            //Query
            $sql = "UPDATE movimenti SET pagata = ?, datapagamento = NULL WHERE movimenti.idmovimento = ?;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $pagato);
            $stmt->bindParam(2, $idmovimento);
            $stmt->execute();
        }

        //Se non ci sono eccezioni commit
        $db->commit();
    } //Se sollevate eccezioni
    catch (Exception $e) {
        echo $e->getMessage();
        //Rollback la transazione
        $db->rollBack();
        $errors['DB'] = 'Errore nel database';
    }

    $db = NULL;
}
// Mando il messaggio del risultato e redirigo

session_start();
if (!empty($errors)) {
    $_SESSION['sqlerrori'] = implode(", ", $errors);
} else {
    $_SESSION['sqlok'] = "Modifica OK";
}

header('Location: ./movimentilista.php');




