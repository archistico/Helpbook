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
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="dist/img/avatar3.png" class="user-image" alt="User Image">
                <span class="hidden-xs">Emilie Rollandin</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="dist/img/avatar3.png" class="img-circle" alt="User Image">
                  <p>
                    Emilie Rollandin
                    <small>Amministratore</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat">Logout</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
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
          <small>CERCA PER SOGGETTO</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Magazzino</a></li>
          <li class="active">Soggetto</li>
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

          if (empty($_GET['fksoggetto'])) {
            echo "Errore soggetto non caricato";
            die;
          } else {
            $fksoggetto = $_GET['fksoggetto'];
          }

          ?>

          <div class="col-md-12">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Lista movimento magazzino: <?php echo soggettoDenominazioneID($fksoggetto); ?></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tr>
                    <th style="width: 60px">Entrate</th>
                    <th style="width: 60px">Uscite</th>
                    <th>Titolo</th>
                    <th style="width: 110px">Documento</th>
                    <th style="width: 150px">Tipologia</th>
                    <th style="width: 150px">Causale</th>
                    <th style="width: 100px">Data</th>
                    <th style="width: 150px">Provenienza</th>
                  </tr>




                  <?php
                  try {
                    include 'php/config.php';
                    $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                    $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

                    $totali = array();

                    $sql= 'SELECT movimentidettaglio.quantita, casaeditrice.casaeditrice, libri.titolo, movimenti.anno, movimentitipologia.codice, movimenti.numero, movimenti.movimentodata, movimentitipologia.movimentotipologia, movimenticausale.movimentocausale, movimenti.fksoggetto, movimenti.fkmagazzino '
                    .'FROM movimentidettaglio '
                    .'INNER JOIN libri ON movimentidettaglio.fklibro = libri.idlibro '
                    .'INNER JOIN libritipologia ON libri.fktipologia = libritipologia.idlibrotipologia '
                    .'INNER JOIN movimenti ON movimenti.idmovimento = movimentidettaglio.fkmovimento '
                    .'INNER JOIN movimentitipologia ON movimentitipologia.idmovimentotipologia = movimenti.fktipologia '
                    .'INNER JOIN movimenticausale ON movimenti.fkcausale = movimenticausale.idmovimentocausale '
                    .'INNER JOIN casaeditrice ON libri.fkcasaeditrice = casaeditrice.idcasaeditrice '
                    .'WHERE movimenti.fksoggetto = '.$fksoggetto.' AND libritipologia.librotipologia = "Carta" AND movimenti.chiuso = 0 AND movimenti.cancellato = 0 '
                    .'ORDER BY movimenti.movimentodata ASC, movimenti.idmovimento ASC, casaeditrice.casaeditrice ASC, libri.titolo ASC';

                    $result = $db->query($sql);

                    foreach ($result as $row) {
                      $row = get_object_vars($row);
                      print "<tr>\n";

                      $libro = $row['casaeditrice'] . " - ". $row['titolo'];

                      // SE DDT
                      if($row['codice']=="DT") {
                        switch ($row['movimentocausale']) {
                          case 'Conto deposito':
                          case 'Conto vendita':
                          print "<td style = 'text-align: center;'>" . $row['quantita'] . "</td>\n";
                          print "<td></td>\n";
                          $totali[$libro]+=$row['quantita'];
                          break;
                          case 'Reso':
                          print "<td></td>\n";
                          print "<td style = 'text-align: center;'>".$row['quantita']."</td>\n";
                          $totali[$libro]-=$row['quantita'];
                          break;
                          default:
                          print "<td style = 'text-align: center;'>ATTENZIONE</td>\n";
                          print "<td style = 'text-align: center;'>ATTENZIONE</td>\n";
                          break;
                        }
                      }

                      // SE FATTURA O RICEVUTA
                      if($row['codice']=="FI" || $row['codice']=="FD" || $row['codice']=="FA" || $row['codice']=="RI") {
                        switch ($row['movimentocausale']) {
                          case 'Vendita':
                          // SE LA VENDITA PRENDE I LIBRI DAL PROPRIO MAGAZZINO ALLORA LI TOGLO ALTRIMENTI NO
                          if($row['fksoggetto']==$row['fkmagazzino']) {
                            print "<td></td>\n";
                            print "<td style = 'text-align: center;'>".$row['quantita']."</td>\n";
                            $totali[$libro]-=$row['quantita'];
                          } else {
                            print "<td style = 'text-align: center;'>-</td>\n";
                            print "<td style = 'text-align: center;'>-</td>\n";
                          }
                          break;
                          default:
                          print "<td style = 'text-align: center;'>-</td>\n";
                          print "<td style = 'text-align: center;'>-</td>\n";
                          break;
                        }
                      }

                      print "<td>" . $libro. "</td>\n";

                      $num_padded = sprintf("%03d", $row['numero']);

                      switch ($row['codice']) {
                        case 'DT':
                        print "<td><span class='badge bg-orange'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</td></span>\n";
                        break;
                        case 'FA':
                        print "<td><span class='badge bg-teal'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</td></span>\n";
                        break;
                        case 'FD':
                        print "<td><span class='badge bg-blue'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</td></span>\n";
                        break;
                        case 'FI':
                        print "<td><span class='badge bg-navy'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</td></span>\n";
                        break;
                        case 'RI':
                        print "<td><span class='badge bg-green'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</td></span>\n";
                        break;
                        default:
                        print "<td><span class='badge bg-red'>" . $row['anno'] . "-" . $row['codice'] . "-" . $num_padded . "</td></span>\n";
                        break;
                      }

                      print "<td>" . $row['movimentotipologia'] . "</td>\n";
                      print "<td>" . $row['movimentocausale'] . "</td>\n";
                      $movimentodata = DateTime::createFromFormat('Y-m-d', $row['movimentodata']);
                      print "<td>" . $movimentodata->format('d/m/Y') . "</td>\n";
                      print "<td>" . substr( soggettoDenominazioneID($row['fkmagazzino']), 0, 20 ) . "</td>\n";

                      print "</tr>\n";
                    }
                    // chiude il database
                    $db = NULL;

                  } catch (PDOException $e) {
                    throw new PDOException("Error  : " . $e->getMessage());
                  }
                  ?>

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
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tr>
                    <th style="width: 60px">Quantità</th>
                    <th>Titolo</th>
                  </tr>
                  <?php
                  foreach ($totali as $key => $value) {
                    if($value!=0){
                        echo "<tr><td style = 'text-align: center;'>{$value}</td><td>{$key}</td>";
                    }
                  }
                  ?>
                </table>
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
