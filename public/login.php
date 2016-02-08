<?php require_once("../includes/main_functions.php"); //is_included(); ?>


<?php include("../includes/layouts/header.php"); ?>

<?php //include("../includes/layouts/navigation.php"); ?>

<!-- Page Start -->
<div class="login_container">
	<h1>Vanilla HRM</h1>
	
	<form action="" method="post">
    	Username: <input type="text" name="username" value=""/><br/>
    	Password: <input type="password" name="password" value=""/><br/>
    	<p><input type="submit" name="login" value="Login"/></p>
	</form>
	
  	<?php form_processing(); ?>
</div>
<!-- Page End -->

<?php include("../includes/layouts/footer.php"); ?>