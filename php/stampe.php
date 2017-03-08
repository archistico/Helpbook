<?php

function stampeListaTabella() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = 'SELECT stampe.*, libri.*, casaeditrice.casaeditrice, soggetti.denominazione '
            .'FROM stampe '
            .'INNER JOIN libri ON libri.idlibro=stampe.fklibro '
            .'INNER JOIN casaeditrice ON libri.fkcasaeditrice=casaeditrice.idcasaeditrice '
            .'INNER JOIN soggetti ON soggetti.idsoggetto=stampe.fktipografia '
            .'WHERE stampe.cancellato=0 '
            .'ORDER BY stampe.stampadata DESC, casaeditrice.casaeditrice ASC, libri.titolo ASC';

        // TODO: sistemare i prezzi sul database

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<tr>\n";
            print "<td>".$row['stampaquantita']."</td>\n";
            $libroDenominazione = $row['casaeditrice']." - ".$row['titolo'];
            print "<td>".tronca($libroDenominazione, 50)."</td>\n";

            $stampa_data_dt = DateTime::createFromFormat('Y-m-d', $row['stampadata']);
            $stampa_data_str = $stampa_data_dt->format('d/m/Y');

            print "<td>".$stampa_data_str."</td>\n";
            print "<td>&euro; ".number_format($row['stampacosto'], 2, ',', ' ')."</td>\n";
            print "<td>".tronca($row['denominazione'],16)."</td>\n";

            print "<td>&euro; ".number_format($row['stampaspedizione'], 2, ',', ' ')."</td>\n";
            print "<td class='hidden-xs hidden-sm'>&euro; ".number_format($row['stampaiva'], 2, ',', ' ')."</td>\n";
            $costounitario = ($row['stampacosto']+$row['stampaspedizione'])/$row['stampaquantita'];
            print "<td class='hidden-xs hidden-sm'>&euro; ".number_format($costounitario, 2, ',', ' ')."</td>\n";
            print "<td class='hidden-xs hidden-sm'>".$row['stampadocumento']."</td>\n";
            print "<td>";
            print "<a class='btn btn-xs btn-danger' href='stampacancella.php?idstampa=".$row['idstampa']."' role='button' style='width: 30px;margin-bottom: 3px'><i class = 'fa fa-remove'></i></a>";
            print "</td>";
            print "</tr>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function stampeListaAnnoTabella($anno) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = "SELECT stampe.*, libri.*, casaeditrice.casaeditrice, soggetti.denominazione "
            ."FROM stampe "
            ."INNER JOIN libri ON libri.idlibro=stampe.fklibro "
            ."INNER JOIN casaeditrice ON libri.fkcasaeditrice=casaeditrice.idcasaeditrice "
            ."INNER JOIN soggetti ON soggetti.idsoggetto=stampe.fktipografia "
            ."WHERE stampe.cancellato=0 AND (stampe.stampadata>='".$anno."-01-01' AND stampe.stampadata<='".$anno."-12-31')"
            ."ORDER BY casaeditrice.casaeditrice ASC, libri.titolo ASC";

        //echo $sql ."<br>";

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<tr>\n";
            print "<td>".$row['stampaquantita']."</td>\n";
            $libroDenominazione = $row['casaeditrice']." - ".$row['titolo'];
            print "<td>".tronca($libroDenominazione, 44)."</td>\n";

            $stampa_data_dt = DateTime::createFromFormat('Y-m-d', $row['stampadata']);
            $stampa_data_str = $stampa_data_dt->format('d/m/Y');

            print "<td>".$stampa_data_str."</td>\n";
            print "<td>&euro; ".number_format($row['stampacosto'], 2, ',', ' ')."</td>\n";
            print "<td>".tronca($row['denominazione'],16)."</td>\n";

            print "<td>&euro; ".number_format($row['stampaspedizione'], 2, ',', ' ')."</td>\n";
            print "<td class='hidden-xs hidden-sm'>&euro; ".number_format($row['stampaiva'], 2, ',', ' ')."</td>\n";
            $costounitario = ($row['stampacosto']+$row['stampaspedizione'])/$row['stampaquantita'];
            print "<td class='hidden-xs hidden-sm'>&euro; ".number_format($costounitario, 2, ',', ' ')."</td>\n";
            print "<td class='hidden-xs hidden-sm'>".$row['stampadocumento']."</td>\n";
            print "<td>";
            print "<a class='btn btn-xs btn-danger' href='stampacancella.php?idstampa=".$row['idstampa']."' role='button' style='width: 30px;margin-bottom: 3px'><i class = 'fa fa-remove'></i></a>";
            print "</td>";
            print "</tr>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function stampeDettagliByID($id) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = 'SELECT stampe.*, libri.*, casaeditrice.casaeditrice, soggetti.denominazione '
            .'FROM stampe '
            .'INNER JOIN libri ON libri.idlibro=stampe.fklibro '
            .'INNER JOIN casaeditrice ON libri.fkcasaeditrice=casaeditrice.idcasaeditrice '
            .'INNER JOIN soggetti ON soggetti.idsoggetto=stampe.fktipografia '
            .'WHERE stampe.cancellato=0 AND idstampa = '.$id
            .' ORDER BY stampe.stampadata ASC, casaeditrice.casaeditrice ASC, libri.titolo ASC';

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);

            $stampa_data_dt = DateTime::createFromFormat('Y-m-d', $row['stampadata']);
            $stampa_data_str = $stampa_data_dt->format('d/m/Y');

            $risultato = "QT: ".$row['stampaquantita'].", ".$row['casaeditrice']." - ".$row['titolo'].", ".$row['denominazione']. " del ".$stampa_data_str;
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }

    return $risultato;
}

/*

SELECT SUM(stampaquantita) as totale, SUM(stampacosto) as costo, libri.titolo FROM stampe INNER JOIN libri ON libri.idlibro = stampe.fklibro GROUP BY fklibro ORDER BY libri.titolo

 */

function stampeTabellaTotale() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = "SELECT SUM(stampaquantita) as totale, SUM(stampacosto) as costo, 
                libri.titolo 
                FROM stampe 
                INNER JOIN libri ON libri.idlibro = stampe.fklibro 
                GROUP BY fklibro 
                ORDER BY libri.titolo ASC
                ";

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<tr>";
            print "<td>".$row['totale']."</td>\n";
            print "<td>".tronca($row['titolo'],42)."</td>\n";
            print "<td>&euro; ".number_format($row['costo'], 2, ',', ' ')."</td>\n";
            print "</tr>";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}