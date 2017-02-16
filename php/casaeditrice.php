<?php

function casaeditriceSelect() {
    try {
        include 'config.php';
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

        $result = $db->query('SELECT idcasaeditrice, casaeditrice FROM casaeditrice ORDER BY casaeditrice ASC');
        foreach ($result as $row) {
            $row = get_object_vars($row);
                print "<option value='" . $row['idcasaeditrice'] . "' ".($row['idcasaeditrice']==1?" selected='selected'":"")." >" . convertiStringaToHTML($row['casaeditrice']) . "</option>\n";
        }
        // chiude il database
        $db = NULL;
    } catch (PDOException $e) {
        throw new PDOException("Error  : " . $e->getMessage());
    }
}

function casaeditriceSelectID($id) {
  try {
      include 'config.php';
      $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

      $result = $db->query('SELECT idcasaeditrice, casaeditrice FROM casaeditrice ORDER BY casaeditrice ASC');
      foreach ($result as $row) {
          $row = get_object_vars($row);
              print "<option value='" . $row['idcasaeditrice'] . "' ".($row['idcasaeditrice']==$id?" selected='selected'":"")." >" . convertiStringaToHTML($row['casaeditrice']) . "</option>\n";
      }
      // chiude il database
      $db = NULL;
  } catch (PDOException $e) {
      throw new PDOException("Error  : " . $e->getMessage());
  }
}
