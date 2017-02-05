<?php

include '../php/config.php';

$db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false ));

//Inizia la transazione
$db->beginTransaction();

try{

    //Query 1
    $sql = "INSERT INTO tentativilogin (user_id, time) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $now = time();
    $stmt->execute(array(222,$now));

    //Query 2
    $sql = "INSERT INTO tentativilogin (user_id, time) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $now = time();
    $stmt->execute(array(222,$now));

    //Se non ci sono eccezioni commit
    $db->commit();

}
//Se sollevate eccezioni
catch(Exception $e){
    echo $e->getMessage();
    //Rollback la transazione
    $db->rollBack();
}

$db = NULL;