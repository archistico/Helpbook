<?php

function convertiStringaToHTML($stringa) {
    return htmlentities($stringa, ENT_COMPAT,'ISO-8859-1', true);
}
function convertiHTMLToStringa($stringa) {
    return htmlspecialchars($stringa, ENT_COMPAT,'ISO-8859-1', true);
}
function pulisciStringa($stringa) {
    return utf8_decode(addslashes(trim($stringa)));
}
function pulisciDB($stringa) {
    return htmlspecialchars($stringa, ENT_QUOTES, 'UTF-8');
}
function db2html($stringa) {
    return utf8_encode($stringa);
}
function html2db($stringa) {
    return utf8_decode($stringa);
}

function tronca($string,$length=15,$append="&hellip;") {
    $string = trim($string);
    if(strlen($string) > $length) {
        //$string = wordwrap($string, $length, "-", true);
        //$string = explode("\n", $string, 2);
        //$string = $string[0] . $append;
        $string = substr($string, 0, $length) . $append;
    }
    return $string;
}


