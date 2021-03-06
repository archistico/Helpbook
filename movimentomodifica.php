<?php
include 'controllo.php';
include 'php/utilita.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HelpBook | MOVIMENTO - MODIFICA</title>
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
                <small>MODIFICA</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Movimento</a></li>
                <li class="active">Modifica</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- CARICA DATI -->
            <?php
            include 'php/movimenti.php';

            if (empty($_GET['idmovimento'])) {
                echo "Errore movimento non caricato";
                die;
            } else {
                $idmovimento = $_GET['idmovimento'];
            }

            list($fktipologia, $fkcausale, $numero, $anno, $riferimento, $fksoggetto, $movimentodata, $pagamentoentro, $pagata,
                $fkpagamentotipologia, $datapagamento, $spedizionecosto, $spedizionesconto, $fkaspetto, $fktrasporto, $fkmagazzino, $note) = movimentocaricamodifica($idmovimento);

            // conversione date
            $movimentodataobj = DateTime::createFromFormat('Y-m-d', $movimentodata);
            if($movimentodataobj != false) {
                $movimentodatastr = $movimentodataobj->format('d/m/Y');
            }

            $pagamentoentroobj = DateTime::createFromFormat('Y-m-d', $pagamentoentro);
            if($pagamentoentroobj != false) {
                $pagamentoentrostr = $pagamentoentroobj->format('d/m/Y');
            }

            $datapagamentoobj = DateTime::createFromFormat('Y-m-d', $datapagamento);
            if($datapagamentoobj != false) {
                $datapagamentostr = $datapagamentoobj->format('d/m/Y');
            }
            /*
             *  value="<?php echo $idlibro; ?>"
             *   value='<?php echo pulisciDB($titolo); ?>'
             *
             * */

            ?>

            <form role="form" name="movimentoForm" action="movimentomodificaSQL.php" method="get">

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
                                    <label>Cliente</label>
                                    <select class="form-control select2" style="width: 100%;" name='cliente' required>
                                        <?php
                                        include 'php/soggetti.php';
                                        soggettiSelectID($fksoggetto);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Data movimento</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker1" name='dataEmissione' required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Numero documento</label>
                                    <input type="text" class="form-control" placeholder="Numero documento" name='numerodocumentonuovo' value='<?php echo $numero; ?>'>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->




                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tipologia</label>
                                    <select class="form-control select2" style="width: 100%;" name='tipologia' required>
                                        <?php
                                        include 'php/movimentitipologia.php';
                                        movimentiTipologiaSelectByID($fktipologia);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Causale</label>
                                    <select class="form-control select2" style="width: 100%;" name='causale' required>
                                        <?php
                                        include 'php/movimenticausale.php';
                                        movimentiCausaleSelectByID($fkcausale);
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
                                    <label>Riferimento <em>(opzionale)</em></label>
                                    <input type="text" class="form-control" placeholder="Riferimento" name='riferimento' value='<?php echo pulisciDB($riferimento); ?>'>
                                </div>
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Magazzino di partenza merce</label>
                                    <select class="form-control select2" style="width: 100%;" name='fkmagazzino' required>
                                        <?php
                                        soggettiSelectID($fkmagazzino);
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->





                <!-- ********************SPEDIZIONE************************* -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">SPEDIZIONE</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Spese di spedizione</label>
                                    <div lang="en-US">
                                        <input type="number" min="0" max="1000" step="0.01" class="form-control" placeholder="Spese spedizione" value='<?php echo $spedizionecosto; ?>' name='spedizione' required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sconto spedizione (%)</label>
                                    <div lang="en-US">
                                        <input type="number" min="0" max="100" step="0.01" class="form-control" placeholder="Sconto spedizione" value='<?php echo $spedizionesconto; ?>' name='spedizionesconto' required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Trasporto</label>
                                    <select class="form-control select2" style="width: 100%;" name='trasporto' required>
                                        <?php
                                        include 'php/movimentitrasporto.php';
                                        movimentiTrasportoSelectByID($fktrasporto);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Aspetto</label>
                                    <select class="form-control select2" style="width: 100%;" name='aspetto' required>
                                        <?php
                                        include 'php/movimentiaspetto.php';
                                        movimentiAspettoSelectByID($fkaspetto);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->


                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->









                <!-- **********************************PAGAMENTO****************************** -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">PAGAMENTO</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Metodo di pagamento</label>
                                    <select class="form-control select2" style="width: 100%;"  name='modalita' required>
                                        <?php
                                        include 'php/pagamentitipologia.php';
                                        pagamentiTipologiaSelectByID($fkpagamentotipologia);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Da pagare entro</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker2" name='dataEntro' required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->




                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pagato</label>
                                    <select class="form-control select2" style="width: 100%;" name='pagato' required>
                                        <option value="1" <?php echo ($pagata==1?'selected':''); ?> >Sì</option>
                                        <option value="0" <?php echo ($pagata==0?'selected':''); ?> >No</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data di effettivo pagamento</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker3"  name='dataPagamento'>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Note <em>(opzionale)</em></label>
                                    <input type="text" class="form-control" placeholder="Note" name='note' value='<?php echo pulisciDB($note); ?>'>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->










                <!-- ********************************** OPERE NEL MOVIMENTO ****************************** -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">DETTAGLIO</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Quantità</label>
                                    <!-- <input type="text" class="form-control" placeholder="Quantità" value="0" name='quantita' id='quantita'> -->
                                    <input type="number" min="0" max="1000" step="1" class="form-control" placeholder="Quantità" value="1" name='quantita' id='quantita'>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Opera</label>
                                    <select class="form-control select2" style="width: 100%;" name='lista' id='lista'>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Sconto %</label>
                                    <!--  <input type="text" class="form-control" placeholder="Tracciabilità" name='tracciabilita' id='tracciabilita'> -->
                                    <input type="number" min="0" max="100" step="0.01" class="form-control" placeholder="Sconto" value="0" name='sconto' id='sconto'>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Aggiungi opera al movimento</label>
                                    <input type="button" class="btn btn-primary btn-block" style="margin-right: 5px;" id="btnaggiungi" value="AGGIUNGI" />
                                </div>
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->

                        <!-- TABELLA PRODOTTI -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box-body">


                                    <table id="tabellaDettagli" class="table table-bordered table-hover order-list">
                                        <thead>
                                        <tr>
                                            <td class="min2">#</td>
                                            <td class="min5">Quantit&agrave;</td>
                                            <td>Opera</td>
                                            <td class="min10">Prezzo</td>
                                            <td class="min10">Sconto</td>
                                            <td class="min10">Subtotale</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                <h4>Importo Totale: <b>&euro; <span id="importoTotale"></span></b></h4>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->

                <input type="hidden" name="opere" value="" id="opere" />
                <input type="hidden" name="importo" value="0" id="importo" />
                <input type="hidden" name="idmovimento" value="<?php echo $idmovimento; ?>" />


                <div class="form-group row m-t-md">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-block btn-primary btn-lg">MODIFICA</button>
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
    $(function () {
        //Date picker
        $('#datepicker1').datepicker("update", <?php echo "'$movimentodatastr'"; ?>);
    });
    $(function () {
        //Date picker
        $('#datepicker2').datepicker("update", <?php echo "'$pagamentoentrostr'"; ?>);
    });
    $(function () {
        //Date picker
        $('#datepicker3').datepicker("update", <?php echo "'$datapagamentostr'"; ?>);
    });

</script>

<script>

    // DICHIARAZIONE VARIABILI GENERALI
    var jslista = [];
    var dbLibri = [];
    var counter = 0;

    // function principale
    $(document).ready(function () {

        // Carica opere nel select
        $.ajax({
            dataType: "json",
            url: 'php/librijson.php',
            success: function (data) {
                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        var item = data[key];
                        dbLibri.push({
                            "libroid": parseInt(item.lib_id),
                            "casaeditrice": item.lib_casaeditrice,
                            "titolo": item.lib_titolo,
                            "tipologia": item.lib_tipologia,
                            "prezzo": parseFloat(item.lib_prezzo)
                        });
                    }
                }

                var option = '';
                for (var i=0;i<dbLibri.length;i++){
                    option += '<option value="'+ dbLibri[i].libroid + '">' + dbLibri[i].casaeditrice + " - " + dbLibri[i].titolo + ' (' + dbLibri[i].tipologia + ' &euro; '+(dbLibri[i].prezzo).toFixed(2)+')' + '</option>';
                }
                $('#lista').append(option);
                $(".select2").select2();

                CaricaDati();
            }
        });

        // --------------------------------------------

        $("#btnaggiungi").on("click", function () {

            counter++;
            quantitatesto = $('#quantita').val();
            quantita = parseInt(quantitatesto);

            libroid = $("#lista").val();
            librotesto = $("#lista option:selected").text();

            scontotesto = $('#sconto').val();
            sconto = parseFloat(scontotesto.replace(",","."));

            //cerca il prezzo del prodotto in base all'ID
            prezzo = parseFloat(cercaPrezzo(libroid));

            if(isNaN(prezzo) || isNaN(quantita)) {
                prezzo = 0;
                quantita = 0;
            }

            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><span class="text-grigio">'+ counter + '</span></td>';
            cols += '<td><span type="text" name="quantita' + counter + '">' + quantita.toFixed(0) + '</span></td>';
            cols += '<td><span name="librotesto">' + librotesto + '</span></td>';
            cols += '<td><span type="text" name="prezzo' + counter + '">&euro; ' + prezzo.toFixed(2) + '</span></td>';
            cols += '<td><span type="text" name="sconto' + counter + '">' + sconto + ' &#37;</span></td>';
            cols += '<td><span type="text" name="subtotale' + counter + '"><strong>&euro; ' + ((quantita*prezzo)*(1-(sconto/100))).toFixed(2) + '</strong></span></td>';
            cols += '<td><input type="button" class="ibtnDel btn btn-default btn-block"  value="X"></td>';
            newRow.append(cols);

            $("table.order-list").append(newRow);

            var jslibro = {
                "id": counter,
                "libroid": libroid,
                "quantita": quantita,
                "prezzo": prezzo,
                "sconto": sconto
            };

            jslista.push(jslibro);

            // pulisce valori quantita e tracciabilità
            $('#quantita').val(1);
            //$('#sconto').val(0);

            visualizzaLista();

            // calcola il totale
            calculateGrandTotal();
        });

        // Se premo su una X della tabella
        $("table.order-list").on("click", ".ibtnDel", function (event) {
            // cancella dall'array l'oggetto selezionato da ID
            var tempID = $(this).closest("tr")[0].cells[0].textContent;
            jslista = jslista.filter(function(el) {
                return el.id != tempID;
            });
            visualizzaLista();

            // cancella la riga dalla tabella
            $(this).closest("tr").remove();

            // Ricalcola il totale
            calculateGrandTotal();
        });


    });

    function decode_utf8(s) {
        return decodeURIComponent(s);
    }

    function encode_utf8(s) {
        return encodeURIComponent(s);
    }

    // cerca prezzo
    function cercaPrezzo(id) {
        for (c = 0; c <= dbLibri.length -1; c++) {
            if(dbLibri[c].libroid == id) {
                return dbLibri[c].prezzo;
            }
        }
    }

    // cerca titolo
    function cercaTitolo(id) {
        for (c = 0; c <= dbLibri.length -1; c++) {
            if(dbLibri[c].libroid == id) {
                return dbLibri[c].titolo;
            }
        }
    }

    // Carica i dati dal db
    function CaricaDati() {


        // Carica dettagli
        $.ajax({
            dataType: "json",
            url: 'php/movimentodettagliojson.php?idmovimento=<?php echo $idmovimento; ?>',
            success: function (data) {
                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        var item = data[key];
                        // PER OGNI LIBRO IN MOVIMENTO DETTAGLI
                        counter++;

                        var jslibro = {
                            "id": counter,
                            "libroid": parseInt(item.fklibro),
                            "librotesto": cercaTitolo(item.fklibro),
                            "quantita": parseInt(item.quantita),
                            "prezzo": parseFloat(item.prezzo),
                            "sconto": parseFloat(item.sconto)
                        };

                        jslista.push(jslibro);
                        // FINE CARICA PER OGNI LIBRO
                    }
                }

                // --------------

                for (index = 0; index <= jslista.length -1; index++) {
                    var newRow = $("<tr>");
                    var cols = "";

                    cols += '<td><span class="text-grigio">'+ jslista[index].id + '</span></td>';
                    cols += '<td><span type="text" name="quantita' + jslista[index].id + '">' + (jslista[index].quantita).toFixed(0) + '</span></td>';
                    cols += '<td><span name="librotesto">' + jslista[index].librotesto + '</span></td>';
                    cols += '<td><span type="text" name="prezzo' + jslista[index].id + '">&euro; ' + jslista[index].prezzo.toFixed(2) + '</span></td>';
                    cols += '<td><span type="text" name="sconto' + jslista[index].id + '">' + jslista[index].sconto + ' &#37;</span></td>';
                    cols += '<td><span type="text" name="subtotale' + jslista[index].id + '"><strong>&euro; ' + ((jslista[index].quantita*jslista[index].prezzo)*(1-(jslista[index].sconto/100))).toFixed(2) + '</strong></span></td>';
                    cols += '<td><input type="button" class="ibtnDel btn btn-default btn-block" value="X"></td>';
                    newRow.append(cols);

                    $("table.order-list").append(newRow);
                }

                // --------------
                visualizzaLista();

                // Ricalcola il totale
                calculateGrandTotal();
            }
        });



    }

    // visualizza lista prodotti
    function visualizzaLista() {
        // crea la lista
        var listalibri = "";

        for (index = 0; index <= jslista.length -1; index++) {
            listalibri=listalibri + " " + jslista[index].libroid;
        }

        $("#opere").val(JSON.stringify(jslista));
    }

    // Calcolo totale
    function calculateGrandTotal() {
        // Calcola da array
        var importoTotale = 0;
        for (index = 0; index <= jslista.length -1; index++) {
            importoTotale=importoTotale + jslista[index].quantita * jslista[index].prezzo * (1-jslista[index].sconto/100);
        }
        $("#importoTotale").text(importoTotale.toFixed(2));
        $("#importo").val(importoTotale.toFixed(2));
    }

</script>
</body>
</html>
