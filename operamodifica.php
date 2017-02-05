<?php include 'controllo.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> HelpBook | OPERA - MODIFICA</title>
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




      <?php
      include 'php/utilita.php';
      ?>



      <section class="content-header">
        <h1>
          OPERA
          <small>MODIFICA</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Opera</a></li>
          <li class="active">Modifica</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <form role="form" name="operaForm" action="operamodificaSQL.php" method="get">

          <!-- CARICA DATI -->
          <?php
          include 'php/libri.php';

          if (empty($_GET['idlibro'])) {
            echo "Errore libro non caricato";
            die;
          } else {
            $idlibro = $_GET['idlibro'];
          }

          list($fkcasaeditrice, $titolo, $sottotitolo, $isbn, $pagine, $prezzo, $fkcollana, $fktipologia) = librocaricamodifica($idlibro);

          ?>

          <!-- **********************************DATI GENERALI****************************** -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">DATI GENERALI</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Casa editrice</label>
                    <select class="form-control select2" style="width: 100%;" name='fkcasaeditrice' required>
                      <?php
                      include 'php/casaeditrice.php';
                      casaeditriceSelectID($fkcasaeditrice);
                      ?>
                    </select>
                  </div>
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Collana</label>
                    <select class="form-control select2" style="width: 100%;" name='fkcollana' required>
                      <?php
                      include 'php/collana.php';
                      collanaSelectID($fkcollana);
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
                    <label>Titolo</label>
                    <input type="hidden" name="idlibro" value="<?php echo $idlibro; ?>">
                    <input type="text" class="form-control" placeholder="Titolo" name='titolo' value='<?php echo convertiApostrofi($titolo); ?>' required>
                  </div>
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Sottotitolo <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Sottotitolo" name='sottotitolo' value='<?php echo convertiApostrofi($sottotitolo); ?>'>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->





          <!-- ********************VENDITA************************* -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">DATI VENDITA</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" class="form-control" placeholder="Codice ISBN" name='isbn' value='<?php echo $isbn; ?>' required>
                  </div>
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Prezzo</label>
                    <input type="number" min="0" max="1000" step="0.001" class="form-control" placeholder="Prezzo di copertina" name='prezzo' value='<?php echo $prezzo; ?>' required>
                  </div>
                </div>
                <!-- /.col -->


              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Pagine</label>
                    <input type="number" min="0" max="5000" step="1" class="form-control" placeholder="Pagine" name='pagine' value='<?php echo $pagine; ?>'>
                  </div>
                </div>
                <!-- /.col -->


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tipologia</label>
                    <select class="form-control select2" style="width: 100%;" name='fktipologia' required>
                      <?php
                      include 'php/libritipologia.php';
                      libritipologiaSelectID($fktipologia);
                      ?>
                    </select>
                  </div>
                </div>
                <!-- /.col -->


              </div>
              <!-- /.row -->

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
