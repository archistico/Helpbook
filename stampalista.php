<?php
include 'controllo.php';
include 'php/utilita.php';
?>
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

            <?php
            session_start();
            if(isset($_SESSION['sqlerrori'])) {
                echo "<div class='alert alert-danger alert-dismissible'><h4><i class='icon fa fa-ban'></i> ATTENZIONE!</h4>Ci sono degli errori</div>";
                echo "<div class='alert alert-danger alert-dismissible'>".$_SESSION['sqlerrori']."</div>";
                unset($_SESSION['sqlerrori']);
            }

            if(isset($_SESSION['sqlok'])) {
                echo "<div class='alert alert-success alert-dismissible'><h4><i class='icon fa fa-check'></i> OK!</h4>Operazione riuscita</div>";
                unset($_SESSION['sqlok']);
            }

            ?>

            <!-- Main row -->
            <div class="row">

                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Lista stampe</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id='stampetabella' class="table table-striped">
                                <thead>
                                <tr>
                                    <th>QT</th>
                                    <th>Opera</th>
                                    <th>Data</th>
                                    <th>Costo</th>
                                    <th>Tipografia</th>
                                    <th>Spedizione</th>
                                    <th class="hidden-xs hidden-sm">IVA</th>
                                    <th class="hidden-xs hidden-sm">CU</th>
                                    <th class="hidden-xs hidden-sm">Doc.</th>
                                    <th>X</th>
                                    <!-- <th style="width: 80px"></th> -->
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'php/stampe.php';
                                stampeListaTabella();
                                ?>
                                </tbody>
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

<script>
    $(function () {
        $('#stampetabella').DataTable({
            "iDisplayLength": 50,
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tutti"]],
            "searching": true,
            "ordering": false,
            "order": [[ 2, 'asc' ]],
            "info": true,
            "autoWidth": true,
            "language": {
                "lengthMenu": "Mostra _MENU_ clienti per pagina",
                "zeroRecords": "Nessun cliente",
                "info": "Pagina _PAGE_ di _PAGES_",
                "sSearch": "Cerca: ",
                "infoEmpty": "Nessun cliente",
                "infoFiltered": "(filtrati _MAX_ prodotti)"
            },
            "oPaginate": {
                "sFirst": "Inizio",
                "sPrevious": "Precedente",
                "sNext": "Prossimo",
                "sLast": "Fine"
            },
            "sLoadingRecords": "In caricamento...",
            "sProcessing": "In caricamento..."
        });

    });
</script>

</html>
