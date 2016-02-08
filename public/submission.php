<?php require_once("../includes/main_functions.php"); //is_included(); ?>
<?php output_buffering("On"); ?>


<?php include("../includes/layouts/header.php"); ?>

<?php //include("../includes/layouts/navigation.php"); ?>	

<!-- Page Start -->
<div class="login_container">
 	<h1>Vanilla HRM</h1>
	<?php
    	$display = $_GET['display'];
		$seconds = 3;
  		echo "Successfully added $display.<br/><br/>";
		echo "~ Redirecting back. Please wait. ~
			 <br/><br/>If not redirected in $seconds seconds, please click the 'back' browser button.
		";
		$url = "app.php?display=$display";
  		redirect_to($url, $seconds);
  	?> 	
</div>
<!-- Page End -->	
	
<?php include("../includes/layouts/footer.php"); ?>