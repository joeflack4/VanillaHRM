
<!-- Footer Start -->
		<?php 
		// Additional html to be appended based on page type, which is recognized by filenames written in the 'append' function below.
			$unknown_page = "";
		
			$login_page = "";
		
			$app_page = "
		</div>
		</div>
		
		
		<div id='footer_wrapper'>
			<div id='footer_container'>
				<div id='footer_container02'>
					Copyright 2015, Joseph E. Flack IV
					<!-- Copyright 2015, Careware Enterprises -->
				</div>
			</div>
		</div>
	
		<script src='scripts/main.js'></script>
		<!-- Jquery (Off/Commented): 
			script language='javascript' type='text/javascript' src='jquery-1.8.3.js'></script>
		-->
	  					";
			
			$page_types = array($unknown_page, $login_page, $app_page);
			
			append_html_by_page_filename($page_types);
		?>
		
	</body>
</html>
<!-- Footer End -->