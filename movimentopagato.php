<?php
include 'controllo.php';
include 'php/utilita.php';
include 'php/config.php';
include 'php/movimenti.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HelpBook | MOVIMENTO - PAGATO</title>
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
        $menu = "Movimenti";
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
                MOVIMENTO
                <small>PAGATO</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Movimento</a></li>
                <li class="active">Pagato</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class='box box-primary'>

                <div class='box-header with-border'>
                    <h3 class='box-title'>MODIFICA</h3>
                </div>

                <div class='box-body'>
                    <form role='form' name='myForm' action='movimentopagatoSQL.php' method='get'>
                        <div class='row'>
                            <div class='col-md-12'>

                                <?php

                                $errors = array();

                                if (empty($_GET['idmovimento'])) {
                                    $errors['idmovimento'] = 'idmovimento non passato';
                                } else {
                                    $idmovimento = $_GET['idmovimento'];
                                }

                                if (empty($errors)) {
                                    $pagato = movimentoPagatoByID($idmovimento);
                                    echo "<h2>Il movimento <strong>" . pulisciDB(movimentoNomeByID($idmovimento)) . "</strong></h2>";
                                    if($pagato) {
                                        echo "<h3>La data di pagamento verr&agrave; cancellata</h3>";
                                    } else {
                                        echo "<div class='col-md-6'>
                                            <div class='form-group'>
                                            <label>Data di effettivo pagamento</label>
                                            <div class='input-group date'><div class='input-group-addon'>
                                            <i class='fa fa-calendar'></i>
                                            </div>
                                            <input type='text' class='form-control pull-right' id='datepicker3'  name='dataPagamento'>
                                            </div></div></div>";
                                    }
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
                                    <a class='btn btn-block btn-default btn-lg' href='movimentilista.php'>Annulla</a>
                                </div>
                                <div class='col-md-6'>
                                    <button type="submit" class="btn btn-block btn-warning btn-lg">Cambia -> <?php  echo ($pagato)?"Non pagato":"Pagato"; ?></button>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <input type="hidden" name="idmovimento" value="<?php  echo $idmovimento; ?>"/>
                        <input type="hidden" name="pagato" value="<?php  echo ($pagato)?0:1; ?>"/>
                    </form>
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

<script>
    $(function () {
        //Date picker
        $('#datepicker3').datepicker({
            todayHighlight : true,
            autoclose: true
        });
    });
    $(function () {
        //Date picker
        $('#datepicker3').datepicker("update", new Date());
    });
</script>
</html>
