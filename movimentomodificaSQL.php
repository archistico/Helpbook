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

if (empty($_GET['numerodocumentonuovo'])) {
    $errors['numerodocumentonuovo'] = 'numero documento non passato';
} else {
    $numerodocumentonuovo = $_GET['numerodocumentonuovo'];
}

if (empty($_GET['cliente'])) {
    $errors['cliente'] = 'ID cliente non passato';
} else {
    $cliente = $_GET['cliente'];
}

if (empty($_GET['dataEmissione'])) {
    $errors['dataEmissione'] = 'dataEmissione non passato';
} else {
    $dataEmissione = DateTime::createFromFormat('d/m/Y', $_GET['dataEmissione']);
}

if (empty($_GET['tipologia'])) {
    $errors['tipologia'] = 'tipologia non passato';
} else {
    $tipologia = $_GET['tipologia'];
}

if (empty($_GET['causale'])) {
    $errors['causale'] = 'causale non passato';
} else {
    $causale = $_GET['causale'];
}

if (empty($_GET['fkmagazzino'])) {
    $errors['fkmagazzino'] = 'Magazzino non passato';
} else {
    $fkmagazzino = $_GET['fkmagazzino'];
}

if (!isset($_GET['riferimento'])) {
    $riferimento = '-';
} else {
    $riferimento = pulisciStringa($_GET['riferimento']);
}

if (!isset($_GET['spedizione'])) {
    $errors['spedizione'] = 'spedizione non passato';
} else {
    $spedizione = $_GET['spedizione'];
}

if (!isset($_GET['spedizionesconto'])) {
    $errors['spedizionesconto'] = 'spedizionesconto non passato';
} else {
    $spedizionesconto = $_GET['spedizionesconto'];
}

if (empty($_GET['trasporto'])) {
    $errors['trasporto'] = 'trasporto non passato';
} else {
    $trasporto = $_GET['trasporto'];
}

if (empty($_GET['aspetto'])) {
    $errors['aspetto'] = 'aspetto non passato';
} else {
    $aspetto = $_GET['aspetto'];
}

if (empty($_GET['modalita'])) {
    $errors['modalita'] = 'modalita non passato';
} else {
    $modalita = $_GET['modalita'];
}

if (empty($_GET['dataEntro'])) {
    $errors['dataEntro'] = 'dataEntro non passato';
} else {
    $dataEntro = DateTime::createFromFormat('d/m/Y', $_GET['dataEntro']);
}

if (!isset($_GET['pagato'])) {
    $errors['pagato'] = 'pagato non passato';
} else {
    $pagato = $_GET['pagato'];
}

if (empty($_GET['dataPagamento'])) {
    //
} else {
    $dataPagamento = DateTime::createFromFormat('d/m/Y', $_GET['dataPagamento']);
}

if (!isset($_GET['note'])) {
    $note = '-';
} else {
    $note = pulisciStringa($_GET['note']);
}

$dettagliolibri = json_decode($_GET['opere']);

// ***************  Caricamento dati FINE

// METODO CON ROLLBACK
$db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false ));

// Trova il numero del movimento
//$sqlultimo = "SELECT numero FROM movimenti WHERE idmovimento = '" . $idmovimento . "';";
//$result = $db->query($sqlultimo);
//$row = $result->fetch(PDO::FETCH_ASSOC);
//$numeroMovimento = $row['numero'];

//Inizia la transazione
$db->beginTransaction();

try {
    // PRIMA CANCELLA MOVIMENTO DETTAGLIO E MOVIMENTO
    $sqlcancellamov = "DELETE FROM movimenti WHERE idmovimento = ?;";
    $stmt = $db->prepare($sqlcancellamov);
    $stmt->execute(array($idmovimento));

    $sqlcancelladet = "DELETE FROM movimentidettaglio WHERE fkmovimento = ?;";
    $stmt = $db->prepare($sqlcancelladet);
    $stmt->execute(array($idmovimento));

    // In base a se c'è o meno la data di pagamento
    if (!isset($dataPagamento)) {
        //Query MOVIMENTO
        $sql = "INSERT INTO movimenti 
               (fktipologia, fkcausale, fkmagazzino, numero, anno, 
                riferimento, fksoggetto, movimentodata, pagamentoentro, pagata, 
                fkpagamentotipologia, datapagamento, spedizionecosto, spedizionesconto, fkaspetto, 
                fktrasporto, note, cancellato)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($tipologia, $causale, $fkmagazzino, $numerodocumentonuovo, $dataEmissione->format('Y'), $riferimento, $cliente, $dataEmissione->format('Y-m-d'), $dataEntro->format('Y-m-d'), $pagato, $modalita, NULL, $spedizione, $spedizionesconto, $aspetto, $trasporto, $note, 0));
    } else {
        //Query MOVIMENTO
        $sql = "INSERT INTO movimenti 
               (fktipologia, fkcausale, fkmagazzino, numero, anno, 
                riferimento, fksoggetto, movimentodata, pagamentoentro, pagata, 
                fkpagamentotipologia, datapagamento, spedizionecosto, spedizionesconto, fkaspetto, 
                fktrasporto, note, cancellato)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($tipologia, $causale, $fkmagazzino, $numerodocumentonuovo, $dataEmissione->format('Y'), $riferimento, $cliente, $dataEmissione->format('Y-m-d'), $dataEntro->format('Y-m-d'), $pagato, $modalita, $dataPagamento->format('Y-m-d'), $spedizione, $spedizionesconto, $aspetto, $trasporto, $note, 0));
    }
    $idmovimento = $db->lastInsertId();

    for ($c = 0; $c < count($dettagliolibri); $c++) {
        $idlibro = $dettagliolibri[$c]->libroid;
        $quantita = $dettagliolibri[$c]->quantita;
        $sconto = $dettagliolibri[$c]->sconto;

        //Query DETTAGLI
        $sql = "INSERT INTO movimentidettaglio 
                (fkmovimento, fklibro, quantita, sconto, cancellato) 
                VALUES (?,?,?,?,?);";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($idmovimento,$idlibro,$quantita,$sconto,0));
    }

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
    $_SESSION['sqlok'] = "MODIFICA OK";
}

header('Location: ./movimentilista.php');
?>



