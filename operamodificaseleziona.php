<?php include 'controllo.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> HelpBook | OPERE</title>
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
                        OPERE
                        <small>MODIFICA</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Opere</a></li>
                        <li class="active">Modifica</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <form role="form" name="operamodificaForm" action="operamodifica.php" method="get">

                    <!-- **********************************DATI GENERALI****************************** -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">SELEZIONA</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Opere</label>
                                        <select class="form-control select2" style="width: 100%;" name='idlibro' required>
                                            <?php
                                            include 'php/libri.php';
                                            libriSelect();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label></label>
                                        <button type="submit" class="btn btn-block btn-primary btn-lg">MODIFICA</button>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->


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
