<script type="text/javascript" src="sha512.js"></script>
<script type="text/javascript" src="forms.js"></script>
<?php
if(isset($_GET['error'])) {
   echo 'Error Logging In!';
}
?>
<form action="process_registrazione.php" method="post" name="login_form">

   Username: <input type="text" name="username" /><br />
   Email: <input type="text" name="email" /><br />
   Password: <input type="password" name="p" id="password"/><br />
   <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
</form>
