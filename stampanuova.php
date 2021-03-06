<?php
include 'controllo.php';
include 'php/utilita.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> HelpBook | STAMPA - NUOVA</title>
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
    $menu = "Stampe";
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
        STAMPA
        <small>NUOVA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">STAMPA</a></li>
        <li class="active">Nuova</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <form role="form" name="stampaForm" action="stampanuovaSQL.php" method="get">

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
                  <label>Opera</label>
                  <select class="form-control select2" style="width: 100%;" name='fklibro' required>
                    <?php
                    include 'php/libri.php';
                    libriSelectCarta();
                    ?>
                  </select>
                </div>
              </div>
              <!-- /.col -->

              <div class="col-md-6">
                <div class="form-group">

                  <label>Quantità</label>
                  <input type="number" min="0" max="100000" step="1" class="form-control" placeholder="Quantità" value="0" name='stampaquantita' required>

                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->



            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Data stampa</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker1" name='stampadata' required>
                  </div>
                </div>
              </div>
              <!-- /.col -->

              <div class="col-md-6">
                <div class="form-group">
                  <label>Tipografia</label>
                  <select class="form-control select2" style="width: 100%;" name='fktipografia' required>
                    <?php
                    include 'php/tipografia.php';
                    tipografiaSelect();
                    ?>
                  </select>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          </div>
          <!-- /.box-body -->

        </div>
        <!-- /.box -->





        <!-- ********************COSTI************************* -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">COSTI</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label>Costo totale</label>
                  <div lang="en-US">
                    <input type="number" min="0" max="999999" step="0.001" class="form-control" placeholder="Costo di stampa" value="0" name='stampacosto' required>
                  </div>
                </div>
              </div>
              <!-- /.col -->

              <div class="col-md-6">
                <div class="form-group">
                  <label>Costo spedizione</label>
                  <div lang="en-US">
                    <input type="number" min="0" max="1000" step="0.001" class="form-control" placeholder="Costo della spedizione" value="0" name='stampaspedizione' required>
                  </div>
                </div>
              </div>
              <!-- /.col -->


            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>IVA (EURO)</label>
                  <div lang="en-US">
                    <input type="number" min="0" max="999999" step="0.001" class="form-control" placeholder="IVA" value="0" name='stampaiva' required>
                  </div>
                </div>
              </div>
              <!-- /.col -->


              <div class="col-md-6">
                <div class="form-group">
                  <label>Numero documento<em> (fattura/ordine)</em></label>
                  <input type="text" class="form-control" placeholder="Documento emesso" name='stampadocumento'>
                </div>
              </div>
              <!-- /.col -->


            </div>
            <!-- /.row -->

          </div>
          <!-- /.box -->

          <div class="form-group row m-t-md">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-block btn-primary btn-lg">INSERISCI</button>
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
  $(function () {

    //Date picker
    $('#datepicker1').datepicker("update", new Date());

  });
</script>
</body>
</html>
