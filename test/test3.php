<?php

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

echo "$fksoggetto<br>";

echo implode(", ", $errors);