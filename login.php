<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> HelpBook | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include 'link.php'; ?>
  <script type="text/javascript" src="sha512.js"></script>
  <script type="text/javascript" src="forms.js"></script>
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Help</b>Book</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Programma di gestione</p>

    <form action="process_login.php" method="post" name="login_form">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="p" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
            <input type="button" class="btn btn-primary btn-block btn-flat" value="Entra" onclick="formhash(this.form, this.form.password);" />
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br>
    <div class="bg-red-active">
        <?php
        if(isset($_GET['error'])) {
            $errore=$_GET['error'];
            switch($errore) {
              case 1: echo '<p>Errore di indentificazione!</p>'; break;
              case 2: echo '<p>Password errata!</p>'; break;
              case 3: echo '<p>Identificarsi!</p>'; break;
              default: echo '<p>Errore!</p>'; break;
            }
            
        }
        ?>
      
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include 'script.php'; ?>

</body>
</html>
