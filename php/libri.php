<?php

function libriSelect() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $result = $db->query('SELECT libri.*, casaeditrice.*, libritipologia.* FROM libri INNER JOIN casaeditrice ON libri.fkcasaeditrice = casaeditrice.idcasaeditrice INNER JOIN libritipologia ON libri.fktipologia = libritipologia.idlibrotipologia WHERE libri.cancellato = 0 ORDER BY casaeditrice.casaeditrice ASC, libritipologia.librotipologia ASC, libri.titolo ASC');
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<option value='" . $row['idlibro'] . "'>" . $row['casaeditrice']." - ".$row['titolo'] . " (".$row['librotipologia'].")</option>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}


function libriSelectCarta() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $result = $db->query('SELECT libri.*, casaeditrice.*, libritipologia.* FROM libri INNER JOIN casaeditrice ON libri.fkcasaeditrice = casaeditrice.idcasaeditrice INNER JOIN libritipologia ON libri.fktipologia = libritipologia.idlibrotipologia WHERE libri.cancellato = 0 AND libri.fktipologia=1 ORDER BY casaeditrice.casaeditrice ASC, libritipologia.librotipologia ASC, libri.titolo ASC');
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<option value='" . $row['idlibro'] . "'>" . $row['casaeditrice']." - ".$row['titolo'] . " (".$row['librotipologia'].")</option>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function libriPiuVendutiTabella() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        class OperaConteggio
        {
            public $titolo;
            public $titolotipo;
            public $venduti;
            public $contodeposito;
            public $montantevenduto;
        }

        $conteggio = array();

        $result = $db->query('SELECT libri.titolo, libri.prezzo, libritipologia.librotipologia, movimentitipologia.codice, movimentidettaglio.quantita, movimentidettaglio.sconto FROM movimentidettaglio INNER JOIN movimenti ON movimentidettaglio.fkmovimento = movimenti.idmovimento INNER JOIN libri ON libri.idlibro = movimentidettaglio.fklibro INNER JOIN libritipologia ON libri.fktipologia = libritipologia.idlibrotipologia INNER JOIN movimentitipologia ON movimenti.fktipologia = movimentitipologia.idmovimentotipologia WHERE movimentidettaglio.cancellato = 0 AND libri.cancellato = 0 AND movimenti.cancellato = 0 ORDER BY libri.titolo ASC, libritipologia.librotipologia ASC;');
        foreach ($result as $row) {
            $row = get_object_vars($row);

            if(!isset($conteggio[$row['titolo'].$row['librotipologia']]))
            {
                $conteggio[$row['titolo'].$row['librotipologia']] = new OperaConteggio();
                $conteggio[$row['titolo'].$row['librotipologia']]->titolo = $row['titolo'];
                $conteggio[$row['titolo'].$row['librotipologia']]->venduti += 0;
                $conteggio[$row['titolo'].$row['librotipologia']]->contodeposito += 0;
                $conteggio[$row['titolo'].$row['librotipologia']]->montantevenduto += 0;
                $conteggio[$row['titolo'].$row['librotipologia']]->titolotipo = $row['librotipologia'];
            }
            if($row['codice']=='FA' || $row['codice']=='FD' || $row['codice']=='FI' || $row['codice']=='RI'){
                $conteggio[$row['titolo'].$row['librotipologia']]->venduti += $row['quantita'];

                $prezzo = $row['prezzo'];
                $quantita = $row['quantita'];
                $sconto = 1 - $row['sconto'] / 100;

                $totale = $prezzo * $quantita * $sconto;
                $totale = round($totale * 100) / 100;

                $conteggio[$row['titolo'].$row['librotipologia']]->montantevenduto += $totale;
            }
            if ($row['codice'] == 'DT') {
                $conteggio[$row['titolo'].$row['librotipologia']]->contodeposito += $row['quantita'];
            }
        }

        foreach ($conteggio as $row) {
                print "<tr>";
                print "<td>" . $row->titolo . " (".$row->titolotipo.")</td>";
                print "<td>" . $row->venduti . "</td>";
                if($row->contodeposito == 0) {
                    print "<td>-</td>";
                } else {
                    print "<td>" . $row->contodeposito . "</td>";
                }
                print "<td>&euro; " . number_format($row->montantevenduto, 2, ',', ' ') . "</td>";
                print "</tr>";
            }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function libriListaTabella() {

    echo "<thead><tr>";
    echo "<th>#</th>";
    echo "<th>Casa editrice</th>";
    echo "<th>Titolo</th>";
    echo "<th>Prezzo</th>";
    echo "<th class='hidden-xs'>ISBN</th>";
    echo "<th>Tipo</th>";
    echo "<th>X</th>";

    echo "</tr></thead>";
    echo "<tbody>";

    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = 'SELECT libri.*, libritipologia.librotipologia, casaeditrice.casaeditrice FROM libri '
              .'INNER JOIN libritipologia ON libri.fktipologia=libritipologia.idlibrotipologia '
              .'INNER JOIN casaeditrice ON libri.fkcasaeditrice=casaeditrice.idcasaeditrice '
              .'WHERE libri.cancellato=0 ORDER BY casaeditrice.casaeditrice ASC, libri.titolo ASC, libri.fktipologia ASC';

        // TODO: sistemare i prezzi sul database

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<tr>\n";
            print "<td>";
            print "<a class='btn btn-xs btn-warning' href='operamodifica.php?idlibro=".$row['idlibro']."' role='button' style='width: 30px; margin-right: 3px; margin-bottom: 3px'><i class = 'fa fa-pencil'></i></a>";
            print "</td>";
            print "<td>".$row['casaeditrice']."</td>\n";
            print "<td>".$row['titolo']."</td>\n";
            print "<td>&euro; ".number_format($row['prezzo'], 2, ',', ' ')."</td>\n";
            print "<td class='hidden-xs'>".$row['isbn']."</td>\n";
            print "<td>".$row['librotipologia']."</td>\n";
            print "<td>";
            print "<a class='btn btn-xs btn-danger' href='operacancella.php?idlibro=".$row['idlibro']."' role='button' style='width: 30px;margin-bottom: 3px'><i class = 'fa fa-remove'></i></a>";
            print "</td>";
            //print "<td><a class='btn btn-xs btn-info' href='movimentovisualizza.php?idmovimento=".$row['idmovimento']."' role='button' style='margin-right: 5px'><i class = 'fa fa-eye'></i></a></td>\n";
            print "</tr>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }

    echo "</tbody>";
}

function librocaricamodifica($idlibro) {
  try {
    include 'config.php';
    $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

    $result = $db->query('SELECT * FROM libri WHERE libri.idlibro='.$idlibro);
    foreach ($result as $row) {
      $row = get_object_vars($row);

      $fkcasaeditrice = $row['fkcasaeditrice'];
      $titolo = $row['titolo'];
      $sottotitolo = $row['sottotitolo'];
      $isbn = $row['isbn'];
      $pagine = $row['pagine'];
      $prezzo = $row['prezzo'];
      $fkcollana = $row['fkcollana'];
      $fktipologia = $row['fktipologia'];
    }
    // chiude il database
    $db = NULL;

    return array($fkcasaeditrice, $titolo, $sottotitolo, $isbn, $pagine, $prezzo, $fkcollana, $fktipologia);

  } catch (PDOException $e) {
    throw new PDOException("Error  : " . $e->getMessage());
  }
}

function operaByID($idlibro) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = "SELECT libri.*, casaeditrice.casaeditrice, libritipologia.librotipologia  
                FROM libri 
                INNER JOIN casaeditrice ON casaeditrice.idcasaeditrice = libri.fkcasaeditrice 
                INNER JOIN libritipologia ON libritipologia.idlibrotipologia = libri.fktipologia 
                WHERE libri.idlibro=".$idlibro;

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);

            $casaeditrice = $row['casaeditrice'];
            $titolo = $row['titolo'];
            $tipologia = $row['librotipologia'];
        }
        // chiude il database
        $db = NULL;

        return $casaeditrice." - ".$titolo." (".$tipologia.")";

    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}