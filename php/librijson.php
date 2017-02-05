<?php

try {
    include 'config.php';
    include 'utilita.php';
    $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

    $result = $db->query('SELECT libri.*, casaeditrice.*, libritipologia.* FROM libri INNER JOIN casaeditrice ON libri.fkcasaeditrice = casaeditrice.idcasaeditrice INNER JOIN libritipologia ON libri.fktipologia = libritipologia.idlibrotipologia WHERE libri.cancellato = 0 ORDER BY casaeditrice.casaeditrice ASC, libri.titolo ASC, libritipologia.librotipologia ASC');
    foreach ($result as $row) {
        $row = get_object_vars($row);
        $titolo = (strlen($row['titolo']) > 38) ? substr($row['titolo'],0,35).'...' : $row['titolo'];
        //$listaLibri[] = array('lib_id' => $row['idlibro'], 'lib_casaeditrice' =>  db2html($row['casaeditrice']), 'lib_titolo' =>  db2html($titolo), 'lib_prezzo' =>  $row['prezzo'], 'lib_tipologia' => db2html($row['librotipologia']));
        $listaLibri[] = array('lib_id' => $row['idlibro'], 'lib_casaeditrice' =>  $row['casaeditrice'], 'lib_titolo' =>  $titolo, 'lib_prezzo' =>  $row['prezzo'], 'lib_tipologia' => $row['librotipologia']);
    }
    // chiude il database
    $db = NULL;

    header('Content-type:application/json;charset=utf-8');
    echo json_encode($listaLibri);

} catch (PDOException $e) {
    throw new PDOException("Error  : " . $e->getMessage());
}

