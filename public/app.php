<!-- Functions and Settings 
		Eventualy this should exist in the header.php only with selective appends.
	-->
<?php require_once("../includes/main_functions.php"); //is_included(); ?>
<?php $connection = db_connect(); ?>
<?php output_buffering("On"); ?>


<?php include("../includes/layouts/header.php"); ?>

<?php include("../includes/layouts/navigation.php"); ?>

<!-- Page Start -->
<div class='data'>
	<p>
	  <table>
	    <tr>
	    	<?php 
	    		$input = $connection;
	    		db_read($input);
	    	?></table></td>
	    </tr>
	  </table>
	</p>	
</div>

<div class='data_input'>
	<a name='form'></a>
	<?php db_create($connection)?>
</div>
  
<?php db_finish($connection); ?>
<!-- Page End -->	
	
<?php include("../includes/layouts/footer.php"); ?>