<!-- Header Start -->
<!-- Functions and Settings 
		Eventualy this should exist in the header.php only with selective appends.
	-->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<link rel="stylesheet" type="text/css" href="stylesheets/main.css">
		<title>Vanilla HRM</title>
		<style></style>
	</head>
	
	<body>
	
		<?php 
		// Additional html to be appended based on page type, which is recognized by filenames written in the 'append' function below.
			$unknown_page = "";
		
			$login_page = "";
		
			$app_page = "
		<div class='app_wrapper'>
			<div class='app_container'>
	  			<h1>Vanilla HRM</h1>
	  					";
			
			$page_types = array($unknown_page, $login_page, $app_page);
			
			append_html_by_page_filename($page_types);
		?>
<!-- Header End -->
