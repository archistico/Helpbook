<ul class="sidebar-menu">
    <li class="header">MENU NAVIGAZIONE</li>
    <li class="active treeview">
        <a href="index.php">
            <i class="fa fa-bank"></i> <span>Home</span>
        </a>
    </li>
    <li class="<?php echo ($menu=='Rubrica')?'active':''; ?> treeview">
        <a href="#">
            <i class="fa fa-user"></i> <span>Rubrica</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="soggettonuovo.php"><i class="fa fa-plus"></i> Nuovo soggetto</a></li>
            <li><a href="soggettomodificaseleziona.php"><i class="fa fa-pencil"></i> Modifica soggetto</a></li>
            <li><a href="soggettilista.php"><i class="fa fa-list-alt"></i> Lista soggetti</a></li>
            <!-- <li><a href="soggettilistaPDF.php"><i class="fa fa-file-pdf-o"></i> PDF soggetti</a></li> -->
        </ul>
    </li>
    <li class="<?php echo ($menu=='Opere')?'active':''; ?> treeview">
        <a href="#">
            <i class="fa fa-book"></i> <span>Opere</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="operanuova.php"><i class="fa fa-plus"></i> Nuova opera</a></li>
            <!-- <li><a href="operamodificaseleziona.php"><i class="fa fa-pencil"></i> Modifica opera</a></li> -->
            <li><a href="operelista.php"><i class="fa fa-list-alt"></i> Lista opere</a></li>
            <!-- <li><a href="operelistaPDF.php"><i class="fa fa-file-pdf-o"></i> PDF opere</a></li> -->
        </ul>
    </li>
    <li class="<?php echo ($menu=='Movimenti')?'active':''; ?> treeview">
        <a href="#">
            <i class="fa fa-exchange"></i> <span>Movimenti</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="movimentonuovo.php"><i class="fa fa-plus"></i> Nuovo movimento</a></li>
            <li><a href="movimentilista.php"><i class="fa fa-list-alt"></i> Lista movimenti</a></li>
            <!-- <li><a href="movimentilistasoggetto.php"><i class="fa fa-list-alt"></i> Lista per soggetto</a></li> -->
            <!-- <li><a href="movimentilistanonpagati.php"><i class="fa fa-money"></i> Lista non pagati</a></li> -->
        </ul>
    </li>
    <li class="<?php echo ($menu=='Stampe')?'active':''; ?> treeview">
        <a href="#">
            <i class="fa fa-print"></i> <span>Stampe</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="stampanuova.php"><i class="fa fa-plus"></i> Nuovo stampa</a></li>
            <li><a href="stampalista.php"><i class="fa fa-list-alt"></i> Lista stampe</a></li>
            <li><a href="stampalistaanno.php"><i class="fa fa-list-alt"></i> Lista stampe per anno</a></li>
            <li><a href="stampatotale.php"><i class="fa fa-list-alt"></i> Lista totale stampe</a></li>
            <!-- <li><a href="stampalistaopera.php"><i class="fa fa-list-alt"></i> Totale stampe per opera</a></li> -->
        </ul>
    </li>
    <li class="<?php echo ($menu=='Magazzini')?'active':''; ?> treeview">
        <a href="#">
            <i class="fa fa-building"></i> <span>Magazzini</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="magazzinolistasv.php"><i class="fa fa-building"></i> Magazzino St-Vincent</a></li>
            <li><a href="magazzinosoggetto.php?fksoggetto=3"><i class="fa fa-building"></i> Magazzino Padova</a></li>
            <li><a href="magazzinosoggettoseleziona.php"><i class="fa fa-building-o"></i> Magazzino per soggetto</a></li>
        </ul>
    </li>
    <!--
    <li class="<?php echo ($menu=='Report')?'active':''; ?> treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Report</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="movimentonuovo.php"><i class="fa fa-line-chart"></i> Venduto per titolo</a></li>
            <li><a href="movimentilista.php"><i class="fa fa-line-chart"></i> Venduto per tipologia</a></li>
            <li><a href="movimentilista.php"><i class="fa fa-line-chart"></i> Venduto per autore</a></li>
            <li><a href="movimentilista.php"><i class="fa fa-line-chart"></i> Calcolo diritti d'autore</a></li>
        </ul>
    </li>
     -->
</ul>
