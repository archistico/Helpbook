<?php include 'controllo.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> HelpBook | STAMPE</title>
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
          STAMPE
          <small>LISTA</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Stampe</li>
          <li class="active">Lista</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Main row -->
        <div class="row">

          <?php
          include 'php/utilita.php';

          // RECUPERO DATI E AGGIUNGO
          define('CHARSET', 'UTF-8');
          define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

          if (empty($_GET['anno'])) {
              $anno = date("Y");
          } else {
              $anno = $_GET['anno'];
          }
          ?>

          <div class="col-md-12">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Lista stampe per l'anno: <?php echo $anno; ?></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tr>
                    <th style="width: 100px">Quantità</th>
                    <th>Opera</th>
                    <th style="width: 100px">Costo totale</th>
                    <th style="width: 100px">Spedizioni</th>
                    <th style="width: 100px">IVA</th>
                    <th style="width: 120px">Costo unitario</th>
                    <!-- <th style="width: 80px"></th> -->
                  </tr>
                  <?php
                  include 'php/stampe.php';
                  stampeListaAnnoTabella($anno);
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
