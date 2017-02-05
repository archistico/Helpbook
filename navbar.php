<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- TODO: Sistemare accesso utente-->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="dist/img/avatar3.png" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php $username = $_SESSION['username']; $username_ruolo = $_SESSION['username_ruolo']; echo $username; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="dist/img/avatar3.png" class="img-circle" alt="User Image">
                        <p>
                            <?php echo $username; ?>
                            <small><?php echo $username_ruolo; ?></small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-right">
                            <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>