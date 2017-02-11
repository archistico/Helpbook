<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function VenditeSuddiviseAnni() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $suddivisione = array();

        $result = $db->query('SELECT libri.prezzo, libritipologia.librotipologia, movimenti.anno, movimentitipologia.codice, movimentidettaglio.quantita, movimentidettaglio.sconto FROM movimentidettaglio INNER JOIN movimenti ON movimentidettaglio.fkmovimento = movimenti.idmovimento INNER JOIN libri ON libri.idlibro = movimentidettaglio.fklibro INNER JOIN libritipologia ON libri.fktipologia = libritipologia.idlibrotipologia INNER JOIN movimentitipologia ON movimenti.fktipologia = movimentitipologia.idmovimentotipologia WHERE movimentidettaglio.cancellato = 0 AND libri.cancellato = 0 AND movimenti.cancellato = 0 ORDER BY movimenti.anno ASC;');
        foreach ($result as $row) {
            $row = get_object_vars($row);

            if (!isset($suddivisione[(string) $row['anno']])) {
                $suddivisione[(string) $row['anno']] = 0;
            }
            if ($row['codice'] == 'FA' || $row['codice'] == 'FD' || $row['codice'] == 'FI' || $row['codice'] == 'RI') {
                $prezzo = $row['prezzo'];
                $quantita = $row['quantita'];
                $sconto = 1 - $row['sconto'] / 100;

                $totale = $prezzo * $quantita * $sconto;
                $totale = round($totale * 100) / 100;

                $suddivisione[(string) $row['anno']] += $totale;
            }
        }

        print "var areaChartData = {" . "\n";
        print "labels: [";

        $numItems = count($suddivisione);
        $cont = 0;

        foreach ($suddivisione as $key => $value) {
            if (++$cont === $numItems) {
                print "'" . $key . "'";
            } else {
                print "'" . $key . "',";
            }
        }
        print "],\n";
        print "datasets: [{ label: 'Vendite', fillColor: 'rgba(210, 214, 222, 1)', strokeColor: 'rgba(210, 214, 222, 1)', pointColor: 'rgba(210, 214, 222, 1)', pointStrokeColor: '#c1c7d1', pointHighlightFill: '#fff', pointHighlightStroke: 'rgba(220,220,220,1)'," . "\n";
        print "data: [";

        $cont = 0;

        foreach ($suddivisione as $key => $value) {
            if (++$cont === $numItems) {
                print "'" . $value . "'";
            } else {
                print "'" . $value . "',";
            }
        }
        print "]\n";
        print "}]};\n";

        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}


function IncassoTotale() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = "SELECT libri.prezzo, libritipologia.librotipologia, movimenti.spedizionecosto, movimenti.spedizionesconto, 
                        movimenti.anno, movimentitipologia.codice, movimentidettaglio.quantita, movimentidettaglio.sconto, movimentidettaglio.fkmovimento   
                        FROM movimentidettaglio 
                        INNER JOIN movimenti ON movimentidettaglio.fkmovimento = movimenti.idmovimento 
                        INNER JOIN libri ON libri.idlibro = movimentidettaglio.fklibro 
                        INNER JOIN libritipologia ON libri.fktipologia = libritipologia.idlibrotipologia 
                        INNER JOIN movimentitipologia ON movimenti.fktipologia = movimentitipologia.idmovimentotipologia 
                        WHERE movimentidettaglio.cancellato = 0 AND libri.cancellato = 0 AND movimenti.cancellato = 0
                        ORDER BY movimentidettaglio.fkmovimento ASC;";

        $incasso = 0;
        $spedizione = 0;
        $fkmovimento = NULL;

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);

            if ($row['codice'] == 'FA' || $row['codice'] == 'FD' || $row['codice'] == 'FI' || $row['codice'] == 'RI') {
                $prezzo = $row['prezzo'];
                $quantita = $row['quantita'];
                $sconto = 1 - $row['sconto'] / 100;

                $totale = $prezzo * $quantita * $sconto;
                $totale = round($totale * 100) / 100;

                $incasso += $totale;
                //echo "id: ".$row['fkmovimento']." Totale: ".$totale;

                // Calcola totale spese spedizione
                // da aggiungere ad ogni cambio di fkmovimento in movimentodettaglio, uno per movimento
                if($fkmovimento != $row['fkmovimento']) {
                    $fkmovimento = $row['fkmovimento'];
                    $spedizione += $row['spedizionecosto']*(1-($row['spedizionesconto']/100));
                    //echo " Spedizione: ".($row['spedizionecosto']*(1-($row['spedizionesconto']/100)));
                }

                //echo "<br>";

            }
        }

        // chiude il database
        $db = NULL;

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }

    return $incasso + $spedizione;
}

function IncassoPagatoTotale() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = "SELECT libri.prezzo, libritipologia.librotipologia, movimenti.pagata, movimenti.spedizionecosto, movimenti.spedizionesconto, 
                        movimenti.anno, movimentitipologia.codice, movimentidettaglio.quantita, movimentidettaglio.sconto, movimentidettaglio.fkmovimento 
                        FROM movimentidettaglio 
                        INNER JOIN movimenti ON movimentidettaglio.fkmovimento = movimenti.idmovimento 
                        INNER JOIN libri ON libri.idlibro = movimentidettaglio.fklibro 
                        INNER JOIN libritipologia ON libri.fktipologia = libritipologia.idlibrotipologia 
                        INNER JOIN movimentitipologia ON movimenti.fktipologia = movimentitipologia.idmovimentotipologia 
                        WHERE movimentidettaglio.cancellato = 0 AND libri.cancellato = 0 AND movimenti.cancellato = 0;";

        $incasso = 0;
        $spedizione = 0;
        $fkmovimento = NULL;

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);

            if ($row['codice'] == 'FA' || $row['codice'] == 'FD' || $row['codice'] == 'FI' || $row['codice'] == 'RI') {
                if ($row['pagata'] == 1) {

                    $prezzo = $row['prezzo'];
                    $quantita = $row['quantita'];
                    $sconto = 1 - $row['sconto'] / 100;

                    $totale = $prezzo * $quantita * $sconto;
                    $totale = round($totale * 100) / 100;

                    $incasso += $totale;
                    //echo "id: ".$row['fkmovimento']." Totale: ".$totale;

                    // Calcola totale spese spedizione
                    // da aggiungere ad ogni cambio di fkmovimento in movimentodettaglio, uno per movimento
                    if($fkmovimento != $row['fkmovimento']) {
                        $fkmovimento = $row['fkmovimento'];
                        $spedizione += $row['spedizionecosto']*(1-($row['spedizionesconto']/100));
                        //echo " Spedizione: ".($row['spedizionecosto']*(1-($row['spedizionesconto']/100)));
                    }

                    //echo "<br>";
                }
            }
        }

        // chiude il database
        $db = NULL;

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }

    return $incasso + $spedizione;
}


function TotaleLibriVenduti() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = "SELECT movimentitipologia.codice, movimentidettaglio.quantita 
                        FROM movimentidettaglio 
                        INNER JOIN movimenti ON movimentidettaglio.fkmovimento = movimenti.idmovimento 
                        INNER JOIN movimentitipologia ON movimenti.fktipologia = movimentitipologia.idmovimentotipologia 
                        WHERE movimentidettaglio.cancellato = 0 AND movimenti.cancellato = 0;";

        $risultato = 0;

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);

            if($row['codice']=='FA' || $row['codice']=='FD' || $row['codice']=='FI' || $row['codice']=='RI'){
                $risultato += $row['quantita'];
            }
        }

        // chiude il database
        $db = NULL;

        // invia il risultato
        return $risultato;

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function TitoloLibroPiuVenduto() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        class LibroConteggio
        {
            public $titolo;
            public $titolotipo;
            public $venduti;
        }

        $conteggio = array();
        $sql = 'SELECT libri.titolo, libri.prezzo, libritipologia.librotipologia, 
                movimentitipologia.codice, movimentidettaglio.quantita, movimentidettaglio.sconto 
                FROM movimentidettaglio 
                INNER JOIN movimenti ON movimentidettaglio.fkmovimento = movimenti.idmovimento 
                INNER JOIN libri ON libri.idlibro = movimentidettaglio.fklibro 
                INNER JOIN libritipologia ON libri.fktipologia = libritipologia.idlibrotipologia 
                INNER JOIN movimentitipologia ON movimenti.fktipologia = movimentitipologia.idmovimentotipologia 
                WHERE movimentidettaglio.cancellato = 0 AND libri.cancellato = 0 AND movimenti.cancellato = 0 
                ORDER BY libri.titolo ASC, libritipologia.librotipologia ASC;';

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);

            if(!isset($conteggio[$row['titolo'].$row['librotipologia']]))
            {
                $conteggio[$row['titolo'].$row['librotipologia']] = new LibroConteggio();
                $conteggio[$row['titolo'].$row['librotipologia']]->titolo = $row['titolo'];
                $conteggio[$row['titolo'].$row['librotipologia']]->venduti += 0;
                $conteggio[$row['titolo'].$row['librotipologia']]->titolotipo = $row['librotipologia'];
            }
            if($row['codice']=='FA' || $row['codice']=='FD' || $row['codice']=='FI' || $row['codice']=='RI'){
                $conteggio[$row['titolo'].$row['librotipologia']]->venduti += $row['quantita'];
            }
        }

        // chiude il database
        $db = NULL;

        usort($conteggio, function($a, $b)
        {
            if ($a->venduti == $b->venduti) {
                return 0;
            }
            return ($a->venduti > $b->venduti) ? -1 : 1;
        });

        return tronca($conteggio[0]->titolo ." (".$conteggio[0]->titolotipo.")",20);

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function ClienteAffezionato() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        class ClienteConteggio
        {
            public $denominazione;
            public $venduti;
        }

        $conteggio = array();
        $sql = 'SELECT soggetti.denominazione,  
                movimentitipologia.codice, movimentidettaglio.quantita
                FROM movimentidettaglio 
                INNER JOIN movimenti ON movimentidettaglio.fkmovimento = movimenti.idmovimento 
                INNER JOIN soggetti ON movimenti.fksoggetto = soggetti.idsoggetto  
                INNER JOIN movimentitipologia ON movimenti.fktipologia = movimentitipologia.idmovimentotipologia 
                WHERE movimentidettaglio.cancellato = 0 AND movimenti.cancellato = 0;';

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);

            if(!isset($conteggio[$row['denominazione']]))
            {
                $conteggio[$row['denominazione']] = new ClienteConteggio();
                $conteggio[$row['denominazione']]->denominazione = $row['denominazione'];
                $conteggio[$row['denominazione']]->venduti += 0;
            }
            if($row['codice']=='FA' || $row['codice']=='FD' || $row['codice']=='FI' || $row['codice']=='RI'){
                $conteggio[$row['denominazione']]->venduti += $row['quantita'];
            }
        }

        // chiude il database
        $db = NULL;

        usort($conteggio, function($a, $b)
        {
            if ($a->venduti == $b->venduti) {
                return 0;
            }
            return ($a->venduti > $b->venduti) ? -1 : 1;
        });

        //var_dump($conteggio);
        //die;

        return tronca($conteggio[0]->denominazione,20);

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}