<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> HelpBook | MOVIMENTO</title>
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
                        MOVIMENTO
                        <small>CHIUDI</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Movimento</a></li>
                        <li class="active">Chiudi</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">





                    <!-- **********************************CONTENUTO****************************** -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">CHIUSURA</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">





                                    <?php

                                    // RECUPERO DATI E AGGIUNGO
                                    define('CHARSET', 'UTF-8');
                                    define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

                                    $errors = array();

                                    if (empty($_GET['idmovimento'])) {
                                        $errors['idmovimento'] = 'idmovimento non passato';
                                    } else {
                                        $idmovimento = $_GET['idmovimento'];
                                    }

                                    if (empty($errors)) {
                                        try {
                                            include 'php/config.php';

                                            $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
                                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                                            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                                            $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

                                            // CONTROLLO LO STATO ATTUALE
                                            $result = $db->query("SELECT movimenti.chiuso FROM movimenti WHERE movimenti.idmovimento=".$idmovimento);
                                            $row = $result->fetch(PDO::FETCH_ASSOC);
                                            $chiuso = $row['chiuso'];

                                            if($chiuso==0) {
                                              $sql = "UPDATE movimenti SET movimenti.chiuso=1 WHERE movimenti.idmovimento=".$idmovimento;
                                              $db->exec($sql);
                                              $chiuso = 1;
                                            } else {
                                              $sql = "UPDATE movimenti SET movimenti.chiuso=0 WHERE movimenti.idmovimento=".$idmovimento;
                                              $db->exec($sql);
                                              $chiuso = 0;
                                            }

                                            // chiude il database
                                            $db = NULL;
                                        } catch (PDOException $e) {
                                            $errors['database'] = "Errore modifica nel database";
                                        }
                                    }

                                    if (!empty($errors)) {
                                        echo "<div class='alert alert-danger alert-dismissible'><h4><i class='icon fa fa-ban'></i> ATTENZIONE!</h4>Ci sono degli errori</div>";
                                    } else {
                                        if($chiuso==1) {
                                          echo "<div class='alert alert-success alert-dismissible'><h4><i class='icon fa fa-check'></i> OK!</h4>Chiusura riuscita</div>";
                                        } else {
                                          echo "<div class='alert alert-success alert-dismissible'><h4><i class='icon fa fa-check'></i> OK!</h4>Riattivazione riuscita</div>";
                                        }

                                    }

                                    ?>


















                                </div>
                                <!-- /.col -->

                                <div class="col-md-6">

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->








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
