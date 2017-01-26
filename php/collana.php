<?php

function collanaSelect() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $result = $db->query('SELECT idcollana, collana FROM collane WHERE cancellato=0 ORDER BY collana ASC');
        foreach ($result as $row) {
            $row = get_object_vars($row);
                print "<option value='" . $row['idcollana'] . "'>" . convertiStringaToHTML($row['collana']) . "</option>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function collanaSelectID($fkcollana) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $result = $db->query('SELECT idcollana, collana FROM collane WHERE cancellato=0 ORDER BY collana ASC');
        foreach ($result as $row) {
            $row = get_object_vars($row);
                print "<option value='" . $row['idcollana'] . "'".($row['idcollana']==$fkcollana?" selected='selected'":"").">" . convertiStringaToHTML($row['collana']) . "</option>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}
