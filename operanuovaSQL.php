<?php include 'controllo.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> HelpBook | OPERA - AGGIUNGI AL DATABASE</title>
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
                $menu = "Opere";
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
                        OPERA
                        <small>NUOVA</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Opera</a></li>
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

                                    if (empty($_GET['fkcasaeditrice'])) {
                                        $errors['fkcasaeditrice'] = 'Casa editrice non passata';
                                    } else {
                                        $fkcasaeditrice = $_GET['fkcasaeditrice'];
                                    }

                                    if (empty($_GET['titolo'])) {
                                        $errors['titolo'] = 'Titolo non passato';
                                    } else {
                                        $titolo = $_GET['titolo'];
                                    }

                                    // Dato opzionale
                                    if (!isset($_GET['sottotitolo'])) {
                                        $sottotitolo = "";
                                    } else {
                                        $sottotitolo = $_GET['sottotitolo'];
                                    }

                                    if (empty($_GET['isbn'])) {
                                        $errors['isbn'] = 'isbn non passato';
                                    } else {
                                        $isbn = $_GET['isbn'];
                                    }

                                    // Dato opzionale
                                    if (!isset($_GET['pagine'])) {
                                        $pagine = 0;
                                    } else {
                                        $pagine = $_GET['pagine'];
                                    }

                                    if (empty($_GET['prezzo'])) {
                                        $errors['prezzo'] = 'prezzo non passato';
                                    } else {
                                        $prezzo = $_GET['prezzo'];
                                    }

                                    if (empty($_GET['fkcollana'])) {
                                        $errors['fkcollana'] = 'Collana non passata';
                                    } else {
                                        $fkcollana = $_GET['fkcollana'];
                                    }

                                    if (empty($_GET['fktipologia'])) {
                                        $errors['fktipologia'] = 'tipologia non passata';
                                    } else {
                                        $fktipologia = $_GET['fktipologia'];
                                    }

                                    if (empty($errors)) {
                                        try {
                                            include 'php/config.php';

                                            $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
                                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                                            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                                            $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');


                                            $db->exec("INSERT INTO libri (idlibro, fkcasaeditrice, titolo, sottotitolo, isbn, pagine, prezzo, fkcollana, fktipologia) VALUES (NULL, '" . $fkcasaeditrice . "', '" . $titolo . "', '" . $sottotitolo . "', '" . $isbn . "', '" . $pagine . "', '" . $prezzo . "', '" . $fkcollana . "', '" . $fktipologia ."');");


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
