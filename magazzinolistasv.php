<?php include 'controllo.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> HelpBook | MAGAZZINO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include 'link.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>HELP</b>BOOK</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <?php
    $menu = "Magazzini";
    include 'navbar.php';
    ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
      include 'sidebarmenu.php';
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->




    <section class="content-header">
      <h1>
        MAGAZZINO
        <small>PER TITOLO</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Magazzino</a></li>
        <li class="active">Titolo</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">

        <?php
        include 'php/utilita.php';
        include 'php/soggetti.php';

        // RECUPERO DATI E AGGIUNGO
        define('CHARSET', 'UTF-8');
        define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

        $fksoggetto = 118;

        ?>

        <div class="col-md-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista per titolo: <?php echo "Due non è il doppio di uno"; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">

                <?php

                class Magazzino {
                  public $data;
                  public $entrata;
                  public $uscita;
                  public $documento;
                  public $tipologia;
                  public $causale;
                  public $sorgente;
                  public $destinazione;

                  function __construct($data, $entrata, $uscita, $documento, $tipologia, $causale, $sorgente, $destinazione) {
                    $this->data = $data;
                    $this->entrata = $entrata;
                    $this->uscita = $uscita;
                    $this->documento = $documento;
                    $this->tipologia = $tipologia;
                    $this->causale = $causale;
                    $this->sorgente = $sorgente;
                    $this->destinazione = $destinazione;
                  }
                }

                try {
                  include 'php/config.php';
                  $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                  $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

                  $totali = array();

                  $sql=  "SELECT stampe.stampadata, stampe.stampaquantita, stampe.stampadocumento, casaeditrice.casaeditrice, libri.titolo, soggetti.denominazione 
                          FROM stampe
                          INNER JOIN libri ON libri.idlibro = stampe.fklibro
                          INNER JOIN casaeditrice ON casaeditrice.idcasaeditrice = libri.fkcasaeditrice
                          INNER JOIN soggetti ON soggetti.idsoggetto = stampe.fktipografia
                          WHERE libri.idlibro = 1;";
                  $result = $db->query($sql);

                  $listaMag = array();

                  foreach ($result as $row) {
                    $row = get_object_vars($row);

                    $data = null;
                    $entrata = 0;
                    $uscita = 0;
                    $documento = '';
                    $tipologia = '';
                    $causale = '';
                    $destinazione = '';
                    $sorgente = '';

                    //$titolo = $row['casaeditrice'] . " - ". $row['titolo'];
                    $data = DateTime::createFromFormat('Y-m-d', $row['stampadata']);
                    $entrata = $row['stampaquantita'];
                    $tipologia = 'Stampa';
                    $sorgente = $row['denominazione'];
                    $documento = $row['stampadocumento'];

                    $listaMag[] = new Magazzino($data, $entrata, $uscita, $documento, $tipologia, $causale, $sorgente, $destinazione);

                  }
                  // chiude il database
                  $db = NULL;

                } catch (PDOException $e) {
                  throw new PDOException("Error  : " . $e->getMessage());
                }

                // -----------------------------------------
                // FINE CARICAMENTO STAMPE


                try {
                  include 'php/config.php';
                  $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                  $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

                  $sql= "SELECT movimenti.movimentodata, movimentidettaglio.quantita, 
                        casaeditrice.casaeditrice, libri.titolo, 
                        movimenti.anno, movimentitipologia.codice, movimenti.numero, 
                        movimenticausale.movimentocausale,
                        movimenti.fksoggetto, movimenti.fkmagazzino, 
                        (SELECT denominazione FROM soggetti WHERE soggetti.idsoggetto = movimenti.fkmagazzino) As sorgente,
                        (SELECT denominazione FROM soggetti WHERE soggetti.idsoggetto = movimenti.fksoggetto) As destinazione
                        FROM movimentidettaglio 
                        INNER JOIN libri ON movimentidettaglio.fklibro = libri.idlibro 
                        INNER JOIN libritipologia ON libri.fktipologia = libritipologia.idlibrotipologia 
                        INNER JOIN movimenti ON movimenti.idmovimento = movimentidettaglio.fkmovimento 
                        INNER JOIN movimenticausale ON movimenti.fkcausale = movimenticausale.idmovimentocausale 
                        INNER JOIN movimentitipologia ON movimenti.fktipologia = movimentitipologia.idmovimentotipologia
                        INNER JOIN casaeditrice ON libri.fkcasaeditrice = casaeditrice.idcasaeditrice 
                        INNER JOIN soggetti ON movimenti.fksoggetto = soggetti.idsoggetto
                        WHERE 
                        libritipologia.librotipologia = 'Carta' AND 
                        movimenti.chiuso = 0 AND 
                        movimenti.cancellato = 0 AND 
                        libri.idlibro = 1 
                        ORDER BY movimenti.movimentodata ASC, movimenti.idmovimento ASC, casaeditrice.casaeditrice ASC, libri.titolo ASC;";
                  // movimenti.fkmagazzino = 118 AND
                  $result = $db->query($sql);

                  foreach ($result as $row) {
                    $row = get_object_vars($row);

                    $data = null;
                    $entrata = 0;
                    $uscita = 0;
                    $documento = '';
                    $tipologia = '';
                    $causale = '';
                    $destinazione = '';
                    $sorgente = '';

                    // SE DDT
                    if($row['codice']=="DT") {
                      switch ($row['movimentocausale']) {
                        case 'Conto deposito':
                        case 'Conto vendita':
                        case 'Distr. reso':
                        case 'Omaggio':
                          $uscita = $row['quantita'];
                          break;
                        case 'Reso':
                        case 'Distr. deposito':
                          $entrata = $row['quantita'];
                          break;
                        default:
                          // Tentata vendita non calcola nulla
                          break;
                      }
                    }

                    // SE FATTURA O RICEVUTA
                    if($row['codice']=="FI" || $row['codice']=="FD" || $row['codice']=="FA" || $row['codice']=="RI") {
                      switch ($row['movimentocausale']) {
                        case 'Vendita':
                          // DEVO COMUNQUE CONTROLLARE DA DOVE PARTONO E DOVE VANNO CON VERIFICA ID
                          // PER SAPERE SE I LIBRI SONO STATI VENDUTI QUELLI CHE AVEVANO GIA IN GIACENZA O MENO

                          if($row['fksoggetto']!=$row['fkmagazzino']) {
                            $uscita = $row['quantita'];
                          }
                          break;
                        default:
                          break;
                      }
                    }

                    //$titolo = $row['casaeditrice'] . " - ". $row['titolo'];
                    $data = DateTime::createFromFormat('Y-m-d', $row['movimentodata']);

                    $tipologia = $row['codice'];
                    $causale = $row['movimentocausale'];
                    $sorgente = $row['sorgente'];
                    $destinazione = $row['destinazione'];

                    $num_padded = sprintf("%03d", $row['numero']);
                    $documento = $row['anno'] . "-" . $row['codice'] . "-" . $num_padded;

                    $listaMag[] = new Magazzino($data, $entrata, $uscita, $documento, $tipologia, $causale, $sorgente, $destinazione);

                    /*

                    $row['movimentotipologia']
                    $row['movimentocausale']
                    $movimentodata = DateTime::createFromFormat('Y-m-d', $row['movimentodata']);
                    $movimentodata->format('d/m/Y')
                    $row['fkmagazzino']
                    */
                  }
                  // chiude il database
                  $db = NULL;

                } catch (PDOException $e) {
                  throw new PDOException("Error  : " . $e->getMessage());
                }

                /*

                echo "<pre>";
                var_dump($listaMag);
                echo "</pre>";
                die();

                */

                ?>
              <table class="table table-striped">
                <thead>
                  <th>Data</th>
                  <th>Entrate</th>
                  <th>Uscite</th>
                  <th>Documento</th>
                  <th>Tipologia</th>
                  <th>Causale</th>
                  <th>Magazzino</th>
                  <th>Destinazione</th>
                </thead>
                <tbody>
                <?php
                $rimanente = 0;

                function sortFunction( $a, $b ) {
                  return $a->data->format('U') - $b->data->format('U');
                }
                usort($listaMag, "sortFunction");
/*
                echo "<pre>";
                var_dump($listaMag);
                echo "</pre>";
                die();
*/
                foreach ($listaMag as $mov) {
                  echo "<tr>";

                  echo "<td>".$mov->data->format('d/m/Y')."</td>";
                  echo "<td>$mov->entrata</td>";
                  echo "<td>$mov->uscita</td>";
                  echo "<td>$mov->documento</td>";
                  echo "<td>$mov->tipologia</td>";
                  echo "<td>$mov->causale</td>";
                  echo "<td>$mov->sorgente</td>";
                  echo "<td>$mov->destinazione</td>";

                  $rimanente += $mov->entrata;
                  $rimanente -= $mov->uscita;

                  echo "</tr>";
                }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>



        <div class="col-md-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">RIMANENZE</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <h1>
                <?php
                echo $rimanente;
                ?>
              </h1>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>


      </div>
      <!-- /.row (main row) -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php include 'script.php'; ?>
</body>
</html>
