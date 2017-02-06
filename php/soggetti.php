<?php

function soggettiSelect() {
  try {
    include 'config.php';
    $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

    $result = $db->query('SELECT denominazione, idsoggetto, provincia FROM soggetti WHERE cancellato=0 ORDER BY denominazione ASC');
    foreach ($result as $row) {
      $row = get_object_vars($row);
      if(empty($row['provincia'])) {
        print "<option value='" . $row['idsoggetto'] . "'>" . $row['denominazione'] . "</option>\n";
      }
      else {
        print "<option value='" . $row['idsoggetto'] . "'>" . $row['denominazione'] . " (".$row['provincia'].")</option>\n";
      }
    }
    // chiude il database
    $db = NULL;
  } catch (PDOException $e) {
    throw new PDOException("Error  : " . $e->getMessage());
  }
}

function soggettiSelectID($id) {
  try {
    include 'config.php';
    $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

    $result = $db->query('SELECT denominazione, idsoggetto, provincia FROM soggetti WHERE cancellato=0 ORDER BY denominazione ASC');
    foreach ($result as $row) {
      $row = get_object_vars($row);
      if(empty($row['provincia'])) {
        print "<option value='" . $row['idsoggetto'] . "' ".($row['idsoggetto']==$id?'selected':'').">" . $row['denominazione'] . "</option>\n";
      }
      else {
        print "<option value='" . $row['idsoggetto'] . "' ".($row['idsoggetto']==$id?'selected':'').">" . $row['denominazione'] . " (".$row['provincia'].")</option>\n";
      }
    }
    // chiude il database
    $db = NULL;
  } catch (PDOException $e) {
    throw new PDOException("Error  : " . $e->getMessage());
  }
}

function soggettoDettagli($fksoggetto) {
  try {
    include 'config.php';
    $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

    $result = $db->query('SELECT soggetti.denominazione, soggetti.indirizzo, soggetti.cap, soggetti.comune, soggetti.provincia, soggetti.telefono, soggetti.cellulare, soggetti.email, soggetti.piva, soggetti.codicefiscale, soggetti.note, '
    . 'soggettitipologia.soggettotipologia '
    . 'FROM soggetti '
    . 'INNER JOIN soggettitipologia ON soggetti.fktipologia=soggettitipologia.idsoggettotipologia '
    . 'WHERE soggetti.cancellato=0 AND soggetti.idsoggetto='.$fksoggetto);
    foreach ($result as $row) {
      $row = get_object_vars($row);

      $denominazione = $row['denominazione'];
      $indirizzo = $row['indirizzo'];
      $cap = $row['cap'];
      $comune = $row['comune'];
      $provincia = $row['provincia'];
      $telefono = $row['telefono'];
      $cellulare = $row['cellulare'];
      $email = $row['email'];
      $piva = $row['piva'];
      $cf = $row['codicefiscale'];
      $note = $row['note'];
      $tipologia = $row['soggettotipologia'];
    }
    // chiude il database
    $db = NULL;

    return array($denominazione, $tipologia,
    $indirizzo, $cap, $comune, $provincia,
    $telefono, $cellulare, $email,
    $piva, $cf,
    $note);

  } catch (PDOException $e) {
    throw new PDOException("Error  : " . $e->getMessage());
  }
}


function soggettocaricamodifica($fksoggetto) {
  try {
    include 'config.php';
    $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

    $result = $db->query('SELECT * FROM soggetti WHERE soggetti.idsoggetto='.$fksoggetto);
    foreach ($result as $row) {
      $row = get_object_vars($row);

      $denominazione = $row['denominazione'];
      $indirizzo = $row['indirizzo'];
      $cap = $row['cap'];
      $comune = $row['comune'];
      $provincia = $row['provincia'];
      $telefono = $row['telefono'];
      $cellulare = $row['cellulare'];
      $email = $row['email'];
      $piva = $row['piva'];
      $cf = $row['codicefiscale'];
      $note = $row['note'];
      $fktipologia = $row['fktipologia'];
    }
    // chiude il database
    $db = NULL;

    return array($denominazione, $fktipologia,
    $indirizzo, $cap, $comune, $provincia,
    $telefono, $cellulare, $email,
    $piva, $cf,
    $note);

  } catch (PDOException $e) {
    throw new PDOException("Error  : " . $e->getMessage());
  }
}

function soggettiListaTabella() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = 'SELECT soggetti.* FROM soggetti '
              .'WHERE soggetti.cancellato=0 ORDER BY soggetti.denominazione ASC';

        // TODO: sistemare i prezzi sul database

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            print "<tr>\n";
            print "<td>";
            print "<a class='btn btn-xs btn-warning' href='soggettomodifica.php?fksoggetto=".$row['idsoggetto']."' role='button' style='width: 30px; margin-right: 3px; margin-bottom: 3px'><i class = 'fa fa-pencil'></i></a>";
            print "</td>";
            print "<td>".$row['denominazione']."</td>\n";
            print "<td>".$row['telefono']."</td>\n";
            print "<td>".$row['cellulare']."</td>\n";
            print "<td>".$row['email']."</td>\n";
            print "<td>";
            print "<a class='btn btn-xs btn-danger' href='soggettocancella.php?fksoggetto=".$row['idsoggetto']."' role='button' style='width: 30px;margin-bottom: 3px'><i class = 'fa fa-remove'></i></a>";
            print "</td>";
            print "</tr>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function soggettoDenominazioneID($id) {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $sql = 'SELECT soggetti.denominazione FROM soggetti '
              .'WHERE soggetti.cancellato=0 AND soggetti.idsoggetto='.$id.' '
              .'ORDER BY soggetti.denominazione ASC';

        $result = $db->query($sql);
        foreach ($result as $row) {
            $row = get_object_vars($row);
            $denominazione = $row['denominazione'];
        }
        // chiude il database
        $db = NULL;
        return $denominazione;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}
