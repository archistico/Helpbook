<?php
include 'controllo.php';
include 'php/utilita.php';
include 'php/config.php';
include 'php/libri.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HelpBook | OPERA - CANCELLA</title>
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
                <small>CANCELLA</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Opera</a></li>
                <li class="active">Cancella</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class='box box-primary'>

                <div class='box-header with-border'>
                    <h3 class='box-title'>ATTENZIONE</h3>
                </div>

                <div class='box-body'>

                    <div class='row'>
                        <div class='col-md-12'>


                            <?php

                            $errors = array();

                            if (empty($_GET['idlibro'])) {
                                $errors['idlibro'] = 'idlibro non passato';
                            } else {
                                $idlibro = $_GET['idlibro'];
                            }

                            if (empty($errors)) {
                                echo "<p>L'opera verrà cancellata solo se non ha movimenti associati</p>";
                                echo "<h1>" . pulisciDB(operaByID($idlibro)) . "</h1>";
                            } else {
                                echo "<div class='alert alert-danger alert-dismissible'><h4><i class='icon fa fa-ban'></i> ATTENZIONE!</h4>Ci sono degli errori</div>";
                            }
                            ?>

                        </div>
                    </div>

                    <?php
                    if (empty($errors)) {
                        ?>
                        <div class='row'>
                            <div class='col-md-6'>
                                <a class='btn btn-block btn-default btn-lg' href='operelista.php'>Annulla</a>
                            </div>
                            <div class='col-md-6'>
                                <a class='btn btn-block btn-danger btn-lg'
                                   href='operacancellaSQL.php?idlibro=<?php echo $idlibro; ?>'>Cancella opera</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

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
