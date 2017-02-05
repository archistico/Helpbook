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

        <?php
        // TODO: Controllare le stringhe per eventuale apostrofi e convertirli

        // RECUPERO DATI E AGGIUNGO
        define('CHARSET', 'UTF-8');
        define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

        $errors = array();

        // http://192.168.1.177/hb/operamodificaSQL.php?fkcasaeditrice=1&fkcollana=2&idlibro=14&titolo=Sogni+inquinati&sottotitolo=&isbn=978-88-97192-09-1&prezzo=7&pagine=104&fktipologia=1

        if (empty($_GET['idlibro'])) {
            $errors['idlibro'] = 'idlibro non passato';
        } else {
            $idlibro = $_GET['idlibro'];
        }

        if (empty($_GET['fktipologia'])) {
            $errors['fktipologia'] = 'fktipologia non passato';
        } else {
            $fktipologia = $_GET['fktipologia'];
        }

        if (empty($_GET['fkcasaeditrice'])) {
            $errors['fkcasaeditrice'] = 'fkcasaeditrice non passato';
        } else {
            $fkcasaeditrice = $_GET['fkcasaeditrice'];
        }

        if (empty($_GET['titolo'])) {
            $errors['titolo'] = 'titolo non passato';
        } else {
            $titolo = str_replace("'", "''",$_GET['titolo']);
        }

        if (empty($_GET['fkcollana'])) {
            $errors['fkcollana'] = 'fkcollana non passato';
        } else {
            $fkcollana = $_GET['fkcollana'];
        }

        if (empty($_GET['isbn'])) {
            $errors['isbn'] = 'isbn non passato';
        } else {
            $isbn = $_GET['isbn'];
        }

        if (empty($_GET['prezzo'])) {
            $errors['prezzo'] = 'prezzo non passato';
        } else {
            $prezzo = $_GET['prezzo'];
        }

        // Dato opzionale
        if (!isset($_GET['sottotitolo'])) {
            $sottotitolo = "";
        } else {
            $sottotitolo = str_replace("'", "''",$_GET['sottotitolo']);
        }

        if (!isset($_GET['pagine'])) {
            $pagine=0;
        } else {
            $pagine = $_GET['pagine'];
        }


        if (empty($errors)) {
            try {
                include 'php/config.php';

                $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');

                $sql = "UPDATE libri "
                      ."SET fkcasaeditrice='".$fkcasaeditrice."', "
                      ."titolo='".$titolo."', "
                      ."sottotitolo='".$sottotitolo."', "
                      ."isbn='".$isbn."', "
                      ."pagine='".$pagine."', "
                      ."prezzo='".$prezzo."', "
                      ."fkcollana='".$fkcollana."', "
                      ."fktipologia='".$fktipologia."' "
                      ."WHERE libri.idlibro=".$idlibro;

                $db->exec($sql);


                // chiude il database
                $db = NULL;
            } catch (PDOException $e) {
                $errors['database'] = "Errore modifica nel database";
            }
        }

        if (!empty($errors)) {
            echo "<div class='alert alert-danger alert-dismissible'><h4><i class='icon fa fa-ban'></i> ATTENZIONE!</h4>Ci sono degli errori</div>";
        } else {
            echo "<div class='alert alert-success alert-dismissible'><h4><i class='icon fa fa-check'></i> OK!</h4>Modifica riuscita</div>";
        }

        ?>









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
