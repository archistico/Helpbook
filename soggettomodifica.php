<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> HelpBook | SOGGETTO - MODIFICA</title>
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




      <?php
      include 'php/utilita.php';
      ?>



      <section class="content-header">
        <h1>
          SOGGETTO
          <small>MODIFICA</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Soggetto</a></li>
          <li class="active">Modifica</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">




        <!-- CARICA DATI -->
        <?php
        include 'php/soggetti.php';

        if (empty($_GET['fksoggetto'])) {
            echo "Errore soggetto non caricato";
            die;
        } else {
            $fksoggetto = $_GET['fksoggetto'];
        }

        list(   $denominazione, $fktipologia,
        $indirizzo, $cap, $comune, $provincia,
        $telefono, $cellulare, $email,
        $piva, $cf,
        $note
        ) = soggettocaricamodifica($fksoggetto);

        ?>










        <form role="form" name="soggettomodificaForm" action="soggettomodificaSQL.php" method="get">

          <!-- **********************************DATI GENERALI****************************** -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">DATI GENERALI</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Tipologia Cliente</label>
                    <select class="form-control select2" style="width: 100%;" name='fktipologia' required>
                      <?php
                      include 'php/soggettitipologia.php';
                      soggettitipologiaSelectValue($fktipologia);
                      ?>
                    </select>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->



              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Denominazione / Cognome</em></label>
                    <input type="text" class="form-control" placeholder="Denominazione" name='cognome' value='<?php echo $denominazione; ?>' required>
                    <input type="hidden" name="idsoggetto" value="<?php echo $fksoggetto; ?>">
                  </div>
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nome <em>(opzionale se azienda)</em></label>
                    <input type="text" class="form-control" placeholder="Nome" name='nome'>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->





          <!-- ********************RECAPITI************************* -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">RECAPITI</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Indirizzo <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Indirizzo (via, piazza, ...)" value='<?php echo $indirizzo; ?>' name='indirizzo'>
                  </div>
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Città <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Città" value='<?php echo $comune; ?>' name='comune'>
                  </div>
                </div>
                <!-- /.col -->


              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>CAP <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Cap" value='<?php echo $cap; ?>' name='cap'>
                  </div>
                </div>
                <!-- /.col -->


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Provincia <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Provincia" value='<?php echo $provincia; ?>' name='provincia'>
                  </div>
                </div>
                <!-- /.col -->


              </div>
              <!-- /.row -->


              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Telefono <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Telefono" value='<?php echo $telefono; ?>' name='telefono'>
                  </div>
                </div>
                <!-- /.col -->


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Cellulare <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Cellulare" value='<?php echo $cellulare; ?>' name='cellulare'>
                  </div>
                </div>
                <!-- /.col -->


              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Email <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Email" value='<?php echo $email; ?>' name='email'>
                  </div>
                </div>
                <!-- /.col -->

              </div>
              <!-- /.row -->

            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->









          <!-- **********************************DATI FISCALI****************************** -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">DATI FISCALI</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label>PIVA <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Numero di Partita IVA" value='<?php echo $piva; ?>' name='piva'>
                  </div>
                </div>
                <!-- /.col -->


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Codice fiscale <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Codice fiscale" value='<?php echo $cf; ?>' name='codicefiscale'>
                  </div>
                </div>
                <!-- /.col -->


              </div>
              <!-- /.row -->



              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Note <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Note" value='<?php echo $note; ?>' name='note'>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->

          <div class="form-group row m-t-md">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-block btn-primary btn-lg">MODIFICA</button>
            </div>
          </div>

        </form>
        <!-- /.form -->









      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include 'footer.php'; ?>
  </div>
  <!-- ./wrapper -->

  <?php include 'script.php'; ?>

  <script>

  </script>
</body>
</html>
