<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> HelpBook | OPERA - NUOVA</title>
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
          OPERA
          <small>NUOVO</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">OPERA</a></li>
          <li class="active">Nuova</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <form role="form" name="operaForm" action="operanuovaSQL.php" method="get">

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
                      casaeditriceSelect();
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
                      collanaSelect();
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
                    <input type="text" class="form-control" placeholder="Titolo" name='titolo' required>
                  </div>
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Sottotitolo <em>(opzionale)</em></label>
                    <input type="text" class="form-control" placeholder="Sottotitolo" name='sottotitolo'>
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
                    <input type="text" class="form-control" placeholder="Codice ISBN" name='isbn' required>
                  </div>
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Prezzo</label>
                    <input type="number" min="0" max="1000" step="0.001" class="form-control" placeholder="Prezzo di copertina" value="0" name='prezzo' required>
                  </div>
                </div>
                <!-- /.col -->


              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Pagine</label>
                    <input type="number" min="0" max="5000" step="1" class="form-control" placeholder="Pagine" value="0" name='pagine'>
                  </div>
                </div>
                <!-- /.col -->


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tipologia</label>
                    <select class="form-control select2" style="width: 100%;" name='fktipologia' required>
                      <?php
                      include 'php/libritipologia.php';
                      libritipologiaSelect();
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

    </script>
  </body>
  </html>
