<?php

//
function movimentiListaNonPagatiTabella() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql= "SELECT movimenti.idmovimento, movimenti.numero, movimenti.anno, movimenti.movimentodata, movimenti.pagata, movimenti.chiuso, "
            ."soggetti.denominazione, soggetti.comune, movimentitipologia.codice, movimentitipologia.movimentotipologia, movimenticausale.movimentocausale, "
            ."pagamentitipologia.pagamentotipologia "
            ."FROM movimenti "
            ."INNER JOIN movimentitipologia ON movimenti.fktipologia=movimentitipologia.idmovimentotipologia "
            ."INNER JOIN movimentiaspetto ON movimenti.fkaspetto=movimentiaspetto.idmovimentoaspetto "
            ."INNER JOIN movimentitrasporto ON movimenti.fktrasporto=movimentitrasporto.idmovimentotrasporto "
            ."INNER JOIN soggetti ON movimenti.fksoggetto=soggetti.idsoggetto "
            ."INNER JOIN pagamentitipologia ON movimenti.fkpagamentotipologia=pagamentitipologia.idpagamentotipologia "
            ."INNER JOIN movimenticausale ON movimenti.fkcausale=movimenticausale.idmovimentocausale "
            ."WHERE movimenti.cancellato=0 AND movimenti.pagata=0 "
            ."ORDER BY movimenti.anno DESC, movimenti.fktipologia DESC, movimenti.numero DESC";

        $result = $db->query($sql);

        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<tr>\n";
            $num_padded = sprintf("%03d", $row['numero']);

            print "<td>";

            switch ($row['codice']) {
                case 'DT':
                    print "<span class='badge bg-orange'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FA':
                    print "<span class='badge bg-teal'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FD':
                    print "<span class='badge bg-blue'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FI':
                    print "<span class='badge bg-navy'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'RI':
                    print "<span class='badge bg-green'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                default:
                    print "<span class='badge bg-red'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
            }

            print "</td>";

            $movimentodata = DateTime::createFromFormat('Y-m-d', $row['movimentodata']);
            if($row['chiuso']==1){
                print "<td><s>" . $movimentodata->format('d/m/Y') . "</s></td>\n";
            } else {
                print "<td>" . $movimentodata->format('d/m/Y') . "</td>\n";
            }


            //print "<td>" . $row['movimentotipologia'] . "</td>\n";

            if($row['chiuso']==1){
                print "<td><s>" . $row['movimentocausale'] . "</s></td>\n";
            } else {
                print "<td>" . $row['movimentocausale'] . "</td>\n";
            }



            if($row['comune']) {
                if($row['chiuso']==1){
                    print "<td><s>" . $row['denominazione'] . " (". $row['comune'] .")</s></td>\n";
                } else {
                    print "<td>" . $row['denominazione'] . " (". $row['comune'] .")</td>\n";
                }

            } else {
                if($row['chiuso']==1){
                    print "<td><s>" . $row['denominazione'] . "</s></td>\n";
                } else {
                    print "<td>" . $row['denominazione'] . "</td>\n";
                }

            }

            if($row['chiuso']==1){
                print "<td><s>&euro; " . movimentoDettaglioImportoTotale($row['idmovimento']) . "</s></td>\n";
            } else {
                print "<td>&euro; " . movimentoDettaglioImportoTotale($row['idmovimento']) . "</td>\n";
            }


            if($row['pagata']) {
                print "<td><i class = 'fa fa-fw fa-circle' style = 'color:green'></i></td>\n";
            } else {
                print "<td><i class = 'fa fa-fw fa-circle' style = 'color:red'></i></td>\n";
            }

            //

            print "<td><a class='btn btn-xs btn-info' href='movimentovisualizza.php?idmovimento=".$row['idmovimento']."' role='button' style='margin-right: 5px'><i class = 'fa fa-eye'></i></a><a class='btn btn-xs btn-warning' href='movimentochiudi.php?idmovimento=".$row['idmovimento']."' role='button' style='margin-right: 5px'><i class = 'fa fa-power-off'></i></a><a class='btn btn-xs btn-danger' href='movimentocancella.php?idmovimento=".$row['idmovimento']."' role='button'><i class = 'fa fa-remove'></i></a></td>\n";
            print "</tr>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}


function movimentiListaSoggettoTabella($id) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql= "SELECT movimenti.idmovimento, movimenti.numero, movimenti.anno, movimenti.movimentodata, movimenti.pagata, movimenti.chiuso, "
            ."soggetti.denominazione, soggetti.comune, movimentitipologia.codice, movimentitipologia.movimentotipologia, movimenticausale.movimentocausale, "
            ."pagamentitipologia.pagamentotipologia "
            ."FROM movimenti "
            ."INNER JOIN movimentitipologia ON movimenti.fktipologia=movimentitipologia.idmovimentotipologia "
            ."INNER JOIN movimentiaspetto ON movimenti.fkaspetto=movimentiaspetto.idmovimentoaspetto "
            ."INNER JOIN movimentitrasporto ON movimenti.fktrasporto=movimentitrasporto.idmovimentotrasporto "
            ."INNER JOIN soggetti ON movimenti.fksoggetto=soggetti.idsoggetto "
            ."INNER JOIN pagamentitipologia ON movimenti.fkpagamentotipologia=pagamentitipologia.idpagamentotipologia "
            ."INNER JOIN movimenticausale ON movimenti.fkcausale=movimenticausale.idmovimentocausale "
            ."WHERE movimenti.cancellato=0 AND movimenti.fksoggetto=".$id." "
            ."ORDER BY movimenti.anno DESC, movimenti.fktipologia DESC, movimenti.numero DESC";

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<tr>\n";
            $num_padded = sprintf("%03d", $row['numero']);

            print "<td>";

            switch ($row['codice']) {
                case 'DT':
                    print "<span class='badge bg-orange'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FA':
                    print "<span class='badge bg-teal'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FD':
                    print "<span class='badge bg-blue'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FI':
                    print "<span class='badge bg-navy'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'RI':
                    print "<span class='badge bg-green'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                default:
                    print "<span class='badge bg-red'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
            }

            print "</td>";

            $movimentodata = DateTime::createFromFormat('Y-m-d', $row['movimentodata']);
            if($row['chiuso']==1){
                print "<td><s>" . $movimentodata->format('d/m/Y') . "</s></td>\n";
            } else {
                print "<td>" . $movimentodata->format('d/m/Y') . "</td>\n";
            }


            print "<td>" . $row['movimentotipologia'] . "</td>\n";

            if($row['chiuso']==1){
                print "<td><s>" . $row['movimentocausale'] . "</s></td>\n";
            } else {
                print "<td>" . $row['movimentocausale'] . "</td>\n";
            }


            /*
            if($row['comune']) {
              if($row['chiuso']==1){
                print "<td><s>" . $row['denominazione'] . " (". $row['comune'] .")</s></td>\n";
              } else {
                print "<td>" . $row['denominazione'] . " (". $row['comune'] .")</td>\n";
              }

            } else {
              if($row['chiuso']==1){
                print "<td><s>" . $row['denominazione'] . "</s></td>\n";
              } else {
                print "<td>" . $row['denominazione'] . "</td>\n";
              }

            }
            */

            if($row['chiuso']==1){
                print "<td><s>&euro; " . movimentoDettaglioImportoTotale($row['idmovimento']) . "</s></td>\n";
            } else {
                print "<td>&euro; " . movimentoDettaglioImportoTotale($row['idmovimento']) . "</td>\n";
            }


            if($row['pagata']) {
                print "<td><i class = 'fa fa-fw fa-circle' style = 'color:green'></i></td>\n";
            } else {
                print "<td><i class = 'fa fa-fw fa-circle' style = 'color:red'></i></td>\n";
            }

            //

            print "<td><a class='btn btn-xs btn-info' href='movimentovisualizza.php?idmovimento=".$row['idmovimento']."' role='button' style='margin-right: 5px'><i class = 'fa fa-eye'></i></a><a class='btn btn-xs btn-warning' href='movimentochiudi.php?idmovimento=".$row['idmovimento']."' role='button' style='margin-right: 5px'><i class = 'fa fa-power-off'></i></a><a class='btn btn-xs btn-danger' href='movimentocancella.php?idmovimento=".$row['idmovimento']."' role='button'><i class = 'fa fa-remove'></i></a></td>\n";
            print "</tr>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function movimentiListaTabella() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = "SELECT movimenti.idmovimento, movimenti.numero, movimenti.anno, movimenti.movimentodata, 
                movimenti.pagata, movimenti.chiuso, soggetti.denominazione, soggetti.comune, movimentitipologia.codice, 
                movimentitipologia.movimentotipologia, movimenticausale.movimentocausale, pagamentitipologia.pagamentotipologia,
                movimenti.spedizionecosto, movimenti.spedizionesconto
                FROM movimenti 
                INNER JOIN movimentitipologia ON movimenti.fktipologia=movimentitipologia.idmovimentotipologia 
                INNER JOIN movimentiaspetto ON movimenti.fkaspetto=movimentiaspetto.idmovimentoaspetto 
                INNER JOIN movimentitrasporto ON movimenti.fktrasporto=movimentitrasporto.idmovimentotrasporto 
                INNER JOIN soggetti ON movimenti.fksoggetto=soggetti.idsoggetto 
                INNER JOIN pagamentitipologia ON movimenti.fkpagamentotipologia=pagamentitipologia.idpagamentotipologia 
                INNER JOIN movimenticausale ON movimenti.fkcausale=movimenticausale.idmovimentocausale 
                WHERE movimenti.cancellato=0 
                ORDER BY movimenti.anno DESC, movimenti.movimentodata DESC, movimenti.fktipologia DESC, movimenti.numero DESC";

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<tr>\n";
            $num_padded = sprintf("%03d", $row['numero']);

            print "<td>";
            print "<a class='btn btn-xs btn-success' href='movimentoPDF.php?idmovimento=".$row['idmovimento']."' role='button' style='width: 30px;margin-right: 3px; margin-bottom: 3px' target='_blank'><i class = 'fa fa-file-pdf-o'></i></a>";
            print "</td>";

            print "<td>";

            switch ($row['codice']) {
                case 'DT':
                    print "<span class='badge bg-orange'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FA':
                    print "<span class='badge bg-teal'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FD':
                    print "<span class='badge bg-blue'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FI':
                    print "<span class='badge bg-navy'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'RI':
                    print "<span class='badge bg-green'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                default:
                    print "<span class='badge bg-red'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
            }

            print "</td>";

            $movimentodata = DateTime::createFromFormat('Y-m-d', $row['movimentodata']);
            if($row['chiuso']==1){
                print "<td><s>" . $movimentodata->format('d/m/Y') . "</s></td>\n";
            } else {
                print "<td>" . $movimentodata->format('d/m/Y') . "</td>\n";
            }


            //print "<td>" . $row['movimentotipologia'] . "</td>\n";

            if($row['chiuso']==1){
                print "<td><s>" . $row['movimentocausale'] . "</s></td>\n";
            } else {
                print "<td>" . $row['movimentocausale'] . "</td>\n";
            }



            if($row['comune']) {
                if($row['chiuso']==1){
                    print "<td><s>" . $row['denominazione'] . " (". $row['comune'] .")</s></td>\n";
                } else {
                    print "<td>" . $row['denominazione'] . " (". $row['comune'] .")</td>\n";
                }

            } else {
                if($row['chiuso']==1){
                    print "<td><s>" . $row['denominazione'] . "</s></td>\n";
                } else {
                    print "<td>" . $row['denominazione'] . "</td>\n";
                }

            }

            $importoTotale = number_format(movimentoDettaglioImportoTotale($row['idmovimento']) + $row['spedizionecosto']*((100-$row['spedizionesconto'])/100), 2);

            if($row['chiuso']==1){
                print "<td><s>&euro; " . $importoTotale . "</s></td>\n";
            } else {
                print "<td>&euro; " . $importoTotale . "</td>\n";
            }


            if($row['pagata']) {
                print "<td><i class = 'fa fa-fw fa-circle fa-lg' style = 'color:green'></i></td>\n";
            } else {
                print "<td><i class = 'fa fa-fw fa-circle fa-lg' style = 'color:red'></i></td>\n";
            }

            //

            print "<td><a class='btn btn-xs btn-danger' style='width: 30px;margin-right: 3px; margin-bottom: 3px' href='movimentocancella.php?idmovimento=".$row['idmovimento']."' role='button'><i class = 'fa fa-remove'></i></a></td>\n";
            print "</tr>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function movimentoDettaglioImportoTotaleScontoIva($idmovimento) {
    try {
        include 'config.php';
        include 'iva.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $totale = 0;
        $totalesconto = 0;
        $totaleiva = 0;

        $result = $db->query('SELECT libri.prezzo, movimentidettaglio.quantita, movimentidettaglio.sconto FROM movimentidettaglio INNER JOIN libri ON movimentidettaglio.fklibro = libri.idlibro WHERE libri.cancellato = 0 && movimentidettaglio.fkmovimento='.$idmovimento);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            $quantita = $row['quantita'];
            $prezzo = $row['prezzo'];
            $sconto = $row['sconto'];

            $prezzoscontato = $prezzo *(1 - $sconto/100);
            $subtotale = $prezzoscontato * $quantita;
            $subsconto = ($prezzo-$prezzoscontato)*$quantita;

            //$aliquota = trovaIVA($tipologia, $data);

            $totale += $subtotale;
            $totalesconto += $subsconto;
        }
        // chiude il database
        $db = NULL;
        // ritorna il valore
        return array(number_format($totale, 2), number_format($totalesconto, 2), number_format($totaleiva, 2));

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function movimentoDettaglioImportoTotale($idmovimento) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $totale = 0;

        $result = $db->query('SELECT libri.prezzo, movimentidettaglio.quantita, movimentidettaglio.sconto FROM movimentidettaglio INNER JOIN libri ON movimentidettaglio.fklibro = libri.idlibro WHERE libri.cancellato = 0 && movimentidettaglio.fkmovimento='.$idmovimento);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            $quantita = $row['quantita'];
            $prezzo = $row['prezzo'];
            $sconto = $row['sconto'];

            $prezzoscontato = $prezzo *(1 - $sconto/100);
            $subtotale = $prezzoscontato * $quantita;
            $subsconto = ($prezzo-$prezzoscontato)*$quantita;

            $totale += $subtotale;

        }
        // chiude il database
        $db = NULL;
        // ritorna il valore
        return $totale;

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}


function movimentoDettagli($idmovimento) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $result = $db->query('SELECT soggetti.denominazione, soggetti.indirizzo, soggetti.cap, soggetti.comune, soggetti.provincia, soggetti.telefono, soggetti.email, soggetti.piva, soggetti.codicefiscale, '
            . 'movimentitipologia.movimentotipologia, movimentitipologia.codice, '
            . 'movimenti.anno, movimenti.numero, movimenti.movimentodata, movimenti.pagamentoentro, movimenti.pagata, movimenti.datapagamento, movimenti.spedizionecosto, movimenti.spedizionesconto, movimenti.riferimento, movimenti.chiuso, movimenti.note, '
            . 'movimenticausale.movimentocausale, '
            . 'movimentiaspetto.movimentoaspetto, '
            . 'movimentitrasporto.movimentotrasporto, '
            . 'pagamentitipologia.pagamentotipologia '
            . 'FROM movimenti '
            . 'INNER JOIN movimentitipologia ON movimenti.fktipologia=movimentitipologia.idmovimentotipologia '
            . 'INNER JOIN movimentiaspetto ON movimenti.fkaspetto=movimentiaspetto.idmovimentoaspetto '
            . 'INNER JOIN movimentitrasporto ON movimenti.fktrasporto=movimentitrasporto.idmovimentotrasporto '
            . 'INNER JOIN soggetti ON movimenti.fksoggetto=soggetti.idsoggetto '
            . 'INNER JOIN pagamentitipologia ON movimenti.fkpagamentotipologia=pagamentitipologia.idpagamentotipologia '
            . 'INNER JOIN movimenticausale ON movimenti.fkcausale=movimenticausale.idmovimentocausale '
            . 'WHERE movimenti.cancellato=0 AND movimenti.idmovimento='.$idmovimento);
        foreach ($result as $row) {
            $row = get_object_vars($row);

            //$movimentodata = DateTime::createFromFormat('Y-m-d', $row['movimentodata']);
            //print "<td>" . $movimentodata->format('d/m/Y') . "</td>";
            //print "<td>" . $row['movimentotipologia'] . "</td>";

            $mov_denominazione = $row['denominazione'];
            $mov_indirizzo = $row['indirizzo'];
            $mov_cap = $row['cap'];
            $mov_comune = $row['comune'];
            $mov_provincia = $row['provincia'];
            $mov_telefono = $row['telefono'];
            $mov_email = $row['email'];
            $mov_piva = $row['piva'];
            $mov_cf = $row['codicefiscale'];
            $mov_codice = $row['codice'];
            $mov_anno = $row['anno'];
            $mov_numero = $row['numero'];
            $mov_tipologia = $row['movimentotipologia'];
            $mov_causale = $row['movimentocausale'];
            $mov_dataemissione = $row['movimentodata'];
            $mov_riferimento = $row['riferimento'];
            $mov_note = $row['note'];
            $mov_aspetto = $row['movimentoaspetto'];
            $mov_trasporto = $row['movimentotrasporto'];
            $mov_spedizione = $row['spedizionecosto'];
            $mov_spedizionesconto = $row['spedizionesconto'];
            $mov_pagato = $row['pagata'];
            $mov_pagamentotipologia = $row['pagamentotipologia'];
            $mov_datapagamento = $row['datapagamento'];
            $mov_dataentro = $row['pagamentoentro'];
            $mov_chiuso = $row['chiuso'];
        }
        // chiude il database
        $db = NULL;

        return array($mov_denominazione, $mov_indirizzo, $mov_cap, $mov_comune, $mov_provincia, $mov_telefono, $mov_email, $mov_piva, $mov_cf,
            $mov_codice, $mov_anno, $mov_numero,
            $mov_tipologia, $mov_causale, $mov_dataemissione, $mov_riferimento, $mov_note,
            $mov_aspetto, $mov_trasporto,
            $mov_spedizione, $mov_spedizionesconto,
            $mov_pagato, $mov_pagamentotipologia, $mov_datapagamento, $mov_dataentro, $mov_chiuso);

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function movimentoNomeByID($idmovimento) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $result = $db->query('SELECT soggetti.denominazione, soggetti.indirizzo, soggetti.cap, soggetti.comune, soggetti.provincia, soggetti.telefono, soggetti.email, soggetti.piva, soggetti.codicefiscale, '
            . 'movimentitipologia.movimentotipologia, movimentitipologia.codice, '
            . 'movimenti.anno, movimenti.numero, movimenti.movimentodata, movimenti.pagamentoentro, movimenti.pagata, movimenti.datapagamento, movimenti.spedizionecosto, movimenti.spedizionesconto, movimenti.riferimento, movimenti.chiuso, '
            . 'movimenticausale.movimentocausale, '
            . 'movimentiaspetto.movimentoaspetto, '
            . 'movimentitrasporto.movimentotrasporto, '
            . 'pagamentitipologia.pagamentotipologia '
            . 'FROM movimenti '
            . 'INNER JOIN movimentitipologia ON movimenti.fktipologia=movimentitipologia.idmovimentotipologia '
            . 'INNER JOIN movimentiaspetto ON movimenti.fkaspetto=movimentiaspetto.idmovimentoaspetto '
            . 'INNER JOIN movimentitrasporto ON movimenti.fktrasporto=movimentitrasporto.idmovimentotrasporto '
            . 'INNER JOIN soggetti ON movimenti.fksoggetto=soggetti.idsoggetto '
            . 'INNER JOIN pagamentitipologia ON movimenti.fkpagamentotipologia=pagamentitipologia.idpagamentotipologia '
            . 'INNER JOIN movimenticausale ON movimenti.fkcausale=movimenticausale.idmovimentocausale '
            . 'WHERE movimenti.cancellato=0 AND movimenti.idmovimento='.$idmovimento);

        foreach ($result as $row) {
            $row = get_object_vars($row);

            $mov_denominazione = $row['denominazione'];
            $mov_codice = $row['codice'];
            $mov_anno = $row['anno'];
            $mov_numero = $row['numero'];

        }
        // chiude il database
        $db = NULL;
        $num_padded = sprintf("%03d", $mov_numero);

        return $mov_anno."-".$mov_codice."-".$num_padded." ".$mov_denominazione;

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

/* -------------------------------------- LISTA TABELLA HOME -------------------------------------*/

function movimentiListaTabellaHome() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = "SELECT movimenti.idmovimento, movimenti.numero, movimenti.anno, movimenti.movimentodata, 
                movimenti.pagata, movimenti.chiuso, soggetti.denominazione, soggetti.comune, movimentitipologia.codice, 
                movimentitipologia.movimentotipologia, movimenticausale.movimentocausale, pagamentitipologia.pagamentotipologia,
                movimenti.spedizionecosto, movimenti.spedizionesconto
                FROM movimenti 
                INNER JOIN movimentitipologia ON movimenti.fktipologia=movimentitipologia.idmovimentotipologia 
                INNER JOIN movimentiaspetto ON movimenti.fkaspetto=movimentiaspetto.idmovimentoaspetto 
                INNER JOIN movimentitrasporto ON movimenti.fktrasporto=movimentitrasporto.idmovimentotrasporto 
                INNER JOIN soggetti ON movimenti.fksoggetto=soggetti.idsoggetto 
                INNER JOIN pagamentitipologia ON movimenti.fkpagamentotipologia=pagamentitipologia.idpagamentotipologia 
                INNER JOIN movimenticausale ON movimenti.fkcausale=movimenticausale.idmovimentocausale 
                WHERE movimenti.cancellato=0 
                ORDER BY movimenti.anno DESC, movimenti.movimentodata DESC, movimenti.fktipologia DESC, movimenti.numero DESC
                LIMIT 10";

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<tr>\n";
            $num_padded = sprintf("%03d", $row['numero']);

            print "<td>";
            print "<a class='btn btn-xs btn-success min2' href='movimentoPDF.php?idmovimento=".$row['idmovimento']."' role='button' style='width: 30px;margin-right: 3px; margin-bottom: 3px' target='_blank'><i class = 'fa fa-file-pdf-o'></i></a>";
            print "</td>";

            print "<td>";

            switch ($row['codice']) {
                case 'DT':
                    print "<span class='badge bg-orange'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FA':
                    print "<span class='badge bg-teal'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FD':
                    print "<span class='badge bg-blue'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'FI':
                    print "<span class='badge bg-navy'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                case 'RI':
                    print "<span class='badge bg-green'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
                default:
                    print "<span class='badge bg-red'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</span>\n";
                    break;
            }

            print "</td>";

            $movimentodata = DateTime::createFromFormat('Y-m-d', $row['movimentodata']);
            if($row['chiuso']==1){
                print "<td class='hidden-xs'><s>" . $movimentodata->format('d/m/Y') . "</s></td>\n";
            } else {
                print "<td class='hidden-xs'>" . $movimentodata->format('d/m/Y') . "</td>\n";
            }


            //print "<td>" . $row['movimentotipologia'] . "</td>\n";

            if($row['chiuso']==1){
                print "<td class='hidden-xs'><s>" . $row['movimentocausale'] . "</s></td>\n";
            } else {
                print "<td class='hidden-xs'>" . $row['movimentocausale'] . "</td>\n";
            }



            if($row['comune']) {
                if($row['chiuso']==1){
                    print "<td><s>" . $row['denominazione'] . " (". $row['comune'] .")</s></td>\n";
                } else {
                    print "<td>" . $row['denominazione'] . " (". $row['comune'] .")</td>\n";
                }

            } else {
                if($row['chiuso']==1){
                    print "<td><s>" . $row['denominazione'] . "</s></td>\n";
                } else {
                    print "<td>" . $row['denominazione'] . "</td>\n";
                }

            }

            $importoTotale = number_format(movimentoDettaglioImportoTotale($row['idmovimento']) + $row['spedizionecosto']*((100-$row['spedizionesconto'])/100), 2);

            if($row['chiuso']==1){
                print "<td><s>&euro; " . $importoTotale . "</s></td>\n";
            } else {
                print "<td>&euro; " . $importoTotale . "</td>\n";
            }


            if($row['pagata']) {
                print "<td><i class = 'fa fa-fw fa-circle fa-lg' style = 'color:green'></i></td>\n";
            } else {
                print "<td><i class = 'fa fa-fw fa-circle fa-lg' style = 'color:red'></i></td>\n";
            }


            print "</tr>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

/* -------------------------------------- FINE LISTA TABELLA HOME -------------------------------------*/