<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> HelpBook | STAMPA - AGGIUNGI AL DATABASE</title>
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
                        STAMPA
                        <small>NUOVA</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Stampa</a></li>
                        <li class="active">Nuova</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">





                    <!-- **********************************CONTENUTO****************************** -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">INSERIMENTO DATABASE</h3>
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

                                    if (empty($_GET['fklibro'])) {
                                        $errors['fklibro'] = 'fklibro non passato';
                                    } else {
                                        $fklibro = $_GET['fklibro'];
                                    }

                                    if (empty($_GET['fktipografia'])) {
                                        $errors['fktipografia'] = 'fktipografia non passato';
                                    } else {
                                        $fktipografia = $_GET['fktipografia'];
                                    }

                                    if (empty($_GET['stampadata'])) {
                                        $errors['stampadata'] = 'stampadata non passato';
                                    } else {
                                        $stampadata = DateTime::createFromFormat('d/m/Y', $_GET['stampadata']);
                                    }

                                    if (empty($_GET['stampaquantita'])) {
                                        $errors['stampaquantita'] = 'stampaquantita non passato';
                                    } else {
                                        $stampaquantita = $_GET['stampaquantita'];
                                    }

                                    if (empty($_GET['stampacosto'])) {
                                        $errors['stampacosto'] = 'stampacosto non passato';
                                    } else {
                                        $stampacosto = $_GET['stampacosto'];
                                    }

                                    if (empty($_GET['stampaspedizione'])) {
                                        $errors['stampaspedizione'] = 'stampaspedizione non passato';
                                    } else {
                                        $stampaspedizione = $_GET['stampaspedizione'];
                                    }

                                    if (empty($_GET['stampaiva'])) {
                                        $errors['stampaiva'] = 'stampaiva non passato';
                                    } else {
                                        $stampaiva = $_GET['stampaiva'];
                                    }


                                    // Dato opzionale
                                    if (!isset($_GET['stampadocumento'])) {
                                        $stampadocumento = "";
                                    } else {
                                        $stampadocumento = str_replace("'", "''",$_GET['stampadocumento']);
                                    }



                                    if (empty($errors)) {
                                        try {
                                            include 'php/config.php';

                                            $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
                                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                                            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                                            $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

                                            // INSERT INTO `stampe` (`idstampa`, `fklibro`, `stampadata`, `stampaquantita`, `stampacosto`, `stampaspedizione`, `stampaiva`, `fktipografia`, `stampadocumento`, `cancellato`) VALUES (NULL, '1', '2016-09-16', '99', '1000', '25', '220', '33', 'fe2015', '0');
                                            // $dataEmissione->format('Y-m-d')

                                            $sql = "INSERT INTO stampe "
                                                  ."VALUES (NULL, '".$fklibro."', '".$stampadata->format('Y-m-d')."', '".$stampaquantita."', '".$stampacosto."', '".$stampaspedizione."', '".$stampaiva."', '".$fktipografia."', '".$stampadocumento."', '0');";

                                            $db->exec($sql);

                                            // chiude il database
                                            $db = NULL;
                                        } catch (PDOException $e) {
                                            $errors['database'] = "Errore inserimento nel database";
                                        }
                                    }

                                    if (!empty($errors)) {
                                        echo "<div class='alert alert-danger alert-dismissible'><h4><i class='icon fa fa-ban'></i> ATTENZIONE!</h4>Ci sono degli errori</div>";
                                    } else {
                                        echo "<div class='alert alert-success alert-dismissible'><h4><i class='icon fa fa-check'></i> OK!</h4>Inserimento riuscito</div>";
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
