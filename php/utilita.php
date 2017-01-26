<?php

function convertiStringaToHTML($stringa) {
    return htmlentities($stringa, ENT_COMPAT,'UTF-8', true);
}

function convertiHTMLToStringa($stringa) {
    return htmlspecialchars($stringa, ENT_COMPAT,'UTF-8', true);
}

function convertiApostrofi($stringa) {
    return htmlspecialchars($stringa, ENT_QUOTES,'UTF-8', true);
}

function pulisciStringa($stringa) {
    return str_replace("'", " ", str_replace('"', ' ', trim($stringa))); 
}

?>


