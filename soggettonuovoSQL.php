<?php include 'controllo.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> HelpBook | SOGGETTO - AGGIUNGI AL DATABASE</title>
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
                $menu = "Rubrica";
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
                        SOGGETTO
                        <small>NUOVO</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Soggetto</a></li>
                        <li class="active">Nuovo</li>
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
                                    // TODO: Controllare le stringhe per eventuale apostrofi e convertirli

                                    // RECUPERO DATI E AGGIUNGO
                                    define('CHARSET', 'UTF-8');
                                    define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

                                    $errors = array();

                                    if (empty($_GET['fktipologia'])) {
                                        $errors['fktipologia'] = 'tipologia non passata';
                                    } else {
                                        $fktipologia = $_GET['fktipologia'];
                                    }

                                    if (empty($_GET['cognome'])) {
                                        $errors['cognome'] = 'cognome non passato';
                                    } else {
                                        $cognome = str_replace("'", "''",$_GET['cognome']);
                                    }

                                    // Dato opzionale
                                    if (!isset($_GET['nome'])) {
                                        $nome = "";
                                    } else {
                                        $nome = str_replace("'", "''",$_GET['nome']);
                                    }

                                    if (!isset($_GET['telefono'])) {
                                        $telefono = "";
                                    } else {
                                        $telefono = str_replace("'", "''",$_GET['telefono']);
                                    }

                                    if (!isset($_GET['cellulare'])) {
                                        $cellulare = "";
                                    } else {
                                        $cellulare = str_replace("'", "''",$_GET['cellulare']);
                                    }

                                    if (!isset($_GET['piva'])) {
                                        $piva = "";
                                    } else {
                                        $piva = str_replace("'", "''",$_GET['piva']);
                                    }

                                    if (!isset($_GET['codicefiscale'])) {
                                        $codicefiscale = "";
                                    } else {
                                        $codicefiscale = str_replace("'", "''",$_GET['codicefiscale']);
                                    }

                                    if (!isset($_GET['email'])) {
                                        $email = "";
                                    } else {
                                        $email = str_replace("'", "''",$_GET['email']);
                                    }

                                    if (!isset($_GET['indirizzo'])) {
                                        $indirizzo = "";
                                    } else {
                                        $indirizzo = str_replace("'", "''",$_GET['indirizzo']);
                                    }

                                    if (!isset($_GET['cap'])) {
                                        $cap = "";
                                    } else {
                                        $cap = str_replace("'", "''",$_GET['cap']);
                                    }

                                    if (!isset($_GET['comune'])) {
                                        $comune = "";
                                    } else {
                                        $comune = str_replace("'", "''",$_GET['comune']);
                                    }

                                    if (!isset($_GET['provincia'])) {
                                        $provincia = "";
                                    } else {
                                        $provincia = str_replace("'", "''",$_GET['provincia']);
                                    }

                                    if (!isset($_GET['note'])) {
                                        $note = "";
                                    } else {
                                        $note = str_replace("'", "''",$_GET['note']);
                                    }



                                    if (empty($errors)) {
                                        try {
                                            include 'php/config.php';

                                            $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
                                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                                            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                                            $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

                                            $denominazione = trim($cognome . " " . $nome);

                                            $db->exec("INSERT INTO soggetti (idsoggetto, fktipologia, denominazione, telefono, cellulare, piva, codicefiscale, email, indirizzo, cap, comune, provincia, note) VALUES (NULL, '" . $fktipologia . "', '" . $denominazione . "', '" . $telefono . "', '" . $cellulare . "', '" . $piva . "', '" . $codicefiscale . "', '" . $email . "', '" . $indirizzo ."', '" . $cap . "', '" . $comune . "', '" . $provincia . "', '" . $note . "');");


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
