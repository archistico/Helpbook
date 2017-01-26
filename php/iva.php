<?php

function trovaIVA($tipologia, $data) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $result = $db->query("SELECT aliquota FROM iva WHERE cancellato = 0 AND fktipologia = ".$tipologia." AND datainizio <= '".$data."' ORDER BY datainizio DESC LIMIT 1");
        foreach ($result as $row) {
            $row = get_object_vars($row);
            $aliquota = $row['aliquota'];
        }
        // chiude il database
        $db = NULL;

        return $aliquota;

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function listaIVA($data) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        // da fare per ogni tipologia - CARTA
        $result = $db->query("SELECT aliquota FROM iva WHERE cancellato = 0 AND fktipologia = 1 AND datainizio <= '".$data."' ORDER BY datainizio DESC LIMIT 1");
        foreach ($result as $row) {
            $row = get_object_vars($row);
            $aliquotaCarta = $row['aliquota'];
        }

        // da fare per ogni tipologia - EBOOK
        $result = $db->query("SELECT aliquota FROM iva WHERE cancellato = 0 AND fktipologia = 2 AND datainizio <= '".$data."' ORDER BY datainizio DESC LIMIT 1");
        foreach ($result as $row) {
            $row = get_object_vars($row);
            $aliquotaEbook = $row['aliquota'];
        }

        // da fare per ogni tipologia - AUDIOLIBRO
        $result = $db->query("SELECT aliquota FROM iva WHERE cancellato = 0 AND fktipologia = 3 AND datainizio <= '".$data."' ORDER BY datainizio DESC LIMIT 1");
        foreach ($result as $row) {
            $row = get_object_vars($row);
            $aliquotaAltro = $row['aliquota'];
        }

        // chiude il database
        $db = NULL;

        return array($aliquotaCarta,$aliquotaEbook,$aliquotaAltro);

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}
