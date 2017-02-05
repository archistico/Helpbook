<?php

include 'controllo.php';
include 'php/config.php';
include 'php/utilita.php';

// RECUPERO DATI E AGGIUNGO
define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

$errors = array();

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

// Caricamento dati FINE

if (empty($errors)) {
   try {
       $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
       $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
       $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

       date_default_timezone_set('Europe/Rome');

       $result = $db->query("SELECT MAX(numero) AS ultimo FROM movimenti WHERE anno = '" . $dataEmissione->format('Y') . "' AND fktipologia = " . $tipologia . "");
       $row = $result->fetch(PDO::FETCH_ASSOC);
       $numero = $row['ultimo'] + 1;

       if (!isset($dataPagamento)) {
           $db->exec("INSERT INTO movimenti (idmovimento, fktipologia, fkcausale, fkmagazzino, numero, anno, riferimento, fksoggetto, movimentodata, pagamentoentro, pagata, fkpagamentotipologia, datapagamento, spedizionecosto, spedizionesconto, fkaspetto, fktrasporto, note, cancellato) VALUES (NULL, '" . $tipologia . "', '" . $causale . "', '" . $fkmagazzino . "', '" . $numero . "', '" . $dataEmissione->format('Y') . "', '" . $riferimento . "', '" . $cliente . "', '" . $dataEmissione->format('Y-m-d') . "', '" . $dataEntro->format('Y-m-d') . "', '" . $pagato . "', '" . $modalita . "', NULL, '" . $spedizione . "', '" . $spedizionesconto . "', '" . $aspetto . "', '" . $trasporto . "', '" . $note . "', '0');");
       } else {
           $db->exec("INSERT INTO movimenti (idmovimento, fktipologia, fkcausale, fkmagazzino, numero, anno, riferimento, fksoggetto, movimentodata, pagamentoentro, pagata, fkpagamentotipologia, datapagamento, spedizionecosto, spedizionesconto, fkaspetto, fktrasporto, note, cancellato) VALUES (NULL, '" . $tipologia . "', '" . $causale . "', '" . $fkmagazzino . "', '" . $numero . "', '" . $dataEmissione->format('Y') . "', '" . $riferimento . "', '" . $cliente . "', '" . $dataEmissione->format('Y-m-d') . "', '" . $dataEntro->format('Y-m-d') . "', '" . $pagato . "', '" . $modalita . "', '" . $dataPagamento->format('Y-m-d') . "', '" . $spedizione . "', '" . $spedizionesconto . "', '" . $aspetto . "', '" . $trasporto . "', '" . $note . "', '0');");
       }

       for ($c = 0; $c < count($dettagliolibri); $c++) {

           $ddd = new DDTDettaglio();

           $ddd->ddd_fkddt = $ddt->ddt_ultimoID;
           $ddd->ddd_quantita = $prodotti[$c]->quantita;
           $ddd->ddd_fkprodotto = $prodotti[$c]->fkprodotto;
           $ddd->ddd_tracciabilita = $prodotti[$c]->tracciabilita;

           if ($ddd->AggiungiSQL()) {
               // OK
           } else {
               $errore['creazioneDDD'] = 'Errore Database lista prodotti';
           }
       }

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

header('Location: ./movimentilista.php');
?>



