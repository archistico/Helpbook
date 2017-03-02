<?php

if (empty($_GET['idmovimento'])) {
    echo "Errore movimento non caricato";
    die;
} else {
    $idmovimento = $_GET['idmovimento'];
}

try {
    include 'config.php';
    include 'utilita.php';
    $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

    $sql = 'SELECT * 
            FROM movimentidettaglio
            INNER JOIN libri ON libri.idlibro = movimentidettaglio.fklibro              
            WHERE fkmovimento = '.$idmovimento;

    $result = $db->query($sql);
    foreach ($result as $row) {
        $row = get_object_vars($row);

        $listaLibri[] = array('idmovimentodettaglio' => $row['idmovimentodettaglio'], 'fklibro' => $row['fklibro'], 'quantita' => $row['quantita'], 'sconto' => $row['sconto'], 'prezzo' => $row['prezzo']);
    }
    // chiude il database
    $db = NULL;

    header('Content-type:application/json;charset=utf-8');
    echo json_encode($listaLibri);

} catch (PDOException $e) {
    throw new PDOException("Error  : " . $e->getMessage());
}