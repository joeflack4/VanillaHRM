<?php


/* Settings */
function output_buffering($setting) {
	//Output Buffering. If needing redirects, try turning this on.
	if ($setting == "On") {
	ob_start();	
	}
}

/* Global Variables */
// Empty

/* Global Classes */
// Empty

/* Global Functions */

//==========================================================================
// Miscellaneous Functions
//==========================================================================
	
//Miscellaneous Misc. Functions
function is_included() {
	echo "'included_functions.php' is included.";
}

//Redirects
/* Not workign at the moment
 * function redirect_to_02($new_location) {
	header("Location: " . $new_location);
	exit;
} */

function redirect_to($new_location, $seconds="0") {
	$url = $new_location;
	header("Refresh: $seconds; url=$url");	
}

/*Unused Code - Will break application if used*/
/* 
$logged_in = $_GET['logged_in'];
if ($logged_in == "1") {
	redirect_to("http://www.google.com/");
} else {
	redirect_to("index.php");
}
*/

//==========================================================================
// Layout/Template Functions
//==========================================================================	

// Header/Footer Functions
// --------------------------------------------------------------------------	
		
function get_current_page_filename() {
	// Gets the filename of page currently being viewed. 	
	$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$exploded_url = explode('/', $url);
	$url_end = end($exploded_url);
	$current_page_filename = $url_end;
	
	//echo $url. "<br/>"; //echo $_SERVER['HTTP_HOST'] . "<br/>"; //echo $_SERVER['PHP_SELF'] . "<br/>"; //print_r($exploded_url) . "<br/>"; //echo $url_end . "<br/>";
	
	return $current_page_filename;
}
	
function filename_match_check($filename_to_check) {
	// Checks match between filename of page currently being viewed and filename (string) passed as argument. Returns boolean.
	$current_page_filename = get_current_page_filename();
	
	if($filename_to_check == $current_page_filename) {
		return true;
	} else {
		return false;
	}
}

function append_html_by_page_filename($page_types) {
	$unknown_page = $page_types[0];	
	$login_page_style = $page_types[1];
	$app_page = $page_types[2]; 
	$page_type_contents = "";
	
	if(filename_match_check("app.php") | filename_match_check("hrm.php")) {
		$page_type_contents = $app_page;
	} elseif(filename_match_check("index.php") | filename_match_check("login.php") | filename_match_check("submission.php")) {
		$page_type_contents = $login_page_style;
	} else {
		$page_type_contents = $unknown_page;
	}
	
	echo $page_type_contents;
}

//==========================================================================
// Form / Login Functions
//==========================================================================

//Form Processing
function form_processing() {
	if(!empty($_POST)) {
		$processed_errors = error_processing();
		error_report($processed_errors);
	}
}

// Error processing also = user validation. Needs heavy editing.
function error_processing() {
	/* --Old User Authentication-- */
	//Users should be a class? Or just SQL?
	//Users 'key' should be name for lookup purproses, perhaps.
	$user1 = array('username' => 'admin', 'password' => 'admin');
	$user2 = array('username' => 'user', 'password' => 'user');
	$users = array($user1, $user2);
	
	//Replace $users with db connection
	
	//Replace $users with db connection
	
	$form_data = $_POST;
	$errors = array();
	$blankness = "";
	$submitted_username = $form_data['username'];
	$submitted_password = $form_data['password'];
	
	function blank_form_detection($blankness_test) {
		foreach ($blankness_test as $key => $value) {
			if(empty($value)) {
				$blankness = true;
				return $blankness;
			}
		}
	}
	
	//Error Processing for No known User
	function username_validation($submitted_username_input, $users_input, $errors_input) {
		$submitted_username = $submitted_username_input;
		$errors = $errors_input;
		
		//Replace $users with db connection
		$users = $users_input;
		//Replace $users with db connection
		
		//Replace this validation
		if ($submitted_username != $users[0]['username'] && $submitted_username != $users[1]['username']) {
		$errors[] = "Username is not a valid username.";
		}
		//Replace this validation
		
		return $errors;
	}	
	
	//Error Processing for User/PW don't match
	function user_validation($submitted_username_input, $submitted_password_input, $users_input, $errors_input) {
		$submitted_username = $submitted_username_input;
		$submitted_password = $submitted_password_input;
		$users = $users_input;
		$errors = $errors_input;
		
		if ($submitted_username == $users[0]['username'] && $submitted_password != $users[0]['password']) {
		$errors[] = "Username and password do not match.";
		}
		if ($submitted_username == $users[1]['username'] && $submitted_password != $users[1]['password']) {
		$errors[] = "Username and password do not match.";
		}
		
		return $errors;
	}
	
	$errors = username_validation($submitted_username, $users, $errors);
	$errors = user_validation($submitted_username, $submitted_password, $users, $errors);
	
	$blankness = blank_form_detection($form_data);
	$processed_errors = array($errors, $blankness);

	return $processed_errors;
}

function error_report($processed_errors) {
	$errors = $processed_errors[0];
	$blankness = $processed_errors[1];
	$output = "";
	
	$form_data = $_POST;
	$submitted_username = $form_data['username'];
	
	if(!empty($errors) && $blankness == false) {
		$output = "<div class=\"error\">";
		$output .= "Please fix the following errors: ";
		$output .= "<ul>";
		foreach($errors as $key => $error) {
			$output .="<li>$error</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
	} else {
		$output = ($blankness == true ? "One or more form fields submitted was blank.<br/> Please fix and try again.<br/>" : "Welcome back, $submitted_username.<br/><br/><img src='thumbs-up.png'/><br/>");
	}
	
	if ($blankness == true) {
		echo $output;
	} else if($blankness == false && empty($errors)) {
		echo $output;
		$seconds = 3;
		echo "<br/> * Redirecting back. Please wait. *
			 <br/><br/>If not redirected in $seconds seconds, please click the 'back' browser button.
		";
		header("Refresh: $seconds; url=app.php");
		//sleep(5);
		//redirect_to("http://www.google.com/");
	} else {
		echo $output;
	}
}

function session() {
	
}
	
//==========================================================================
// Database CRUD Functions
//==========================================================================

//DB Open
function db_connect() {
	$dbhost = "localhost";
	$dbuser = "admin";
	$dbpass = "admin";
	$dbname = "vanillahrm";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	if(mysqli_connect_errno()) {
		die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")<br/>");
	}	
	return $connection;
}

//DB Close
function db_finish($connection) {
	$connection = $connection;
	/* Don't know how to pass result to this function
	mysqli_free_result($result); */
	mysqli_close($connection);
}

//DB CRUD: Read
function db_read($connection) {
	if(empty($_GET)) {
		echo "<p><b>Welcome to Vanilla HRM.</b></p>
			How to use: 
			<span id='instructions_toggler'>[<u>Click Me</u>]</span><br/>
			<span id='instructions_togglee'>Make a selection above :)</span>
		";
	} else {
		$table = $_GET['display'];
		//Debugging
		//echo "Debugging Info: \$_GET = ";
		//print_r($_GET);
		//Debugging: echo "<br/>Connection Information = " . $connection;
		//Debugging
		
		/*
		 *  TO DO: If statement that separates different table data requests, and handles each query separately. For example, for clients, we could choose not to display certain columns, such as "middle name", "name affix", or "name suffix". We could even allow for various check-boxes which allow people to customize what they want to see. And even potentially save a template of their preferred query options. 
		 * 
		*/
		
		$query =  "SELECT * ";
		$query .= "FROM $table ";
		//Optional Query Parameters
		//$query .= "WHERE agency = \'COA\' ";
		//$query .= "ORDER BY \'last_name\' ASC";
		$result = mysqli_query($connection, $query);
		
		//Display Columns
		$columns_query = "SHOW COLUMNS ";
		$columns_query .= "FROM $table"; 
		$columns = mysqli_query($connection, $columns_query);
		$columns = mysqli_fetch_all($columns);
		
		echo "<h2>" . ucwords($table) . "</h2>" . "<td class='data_output'>" . "<table>";
		
		if (!$columns) {
			die("Error displaying data.");
		}  else {
			echo "<tr>";
			if (1==0) {
				//delete = True?
				
			} else {
				for ($i=0; $i < count($columns); $i++) {
					echo "<td class='data_output_headers'>";
					$formatted_columns = ucwords($columns[$i][0]);
					print_r($formatted_columns);
					echo "</td>";
					//echo "<td class='data_output_cells'>" . print_r($formatted_columns) . "</td>";
					//echo "<td class='data_output_cells'>" . $row[$i] . "</td>";
				}	
			}
			echo "</tr>";
		}
		
		// Display Rows
		if (!$result) {
			die("Error displaying data.");
		} else {
			//Alternate Raw Method
			//var_dump($columns);
			//echo "<hr/>";
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
				echo "<tr>";
				for ($i=0; $i < count($row) ; $i++) { 
					echo "<td class='data_output_cells'>" . $row[$i] . "</td>";
				}
				echo "</tr>";
			}
			
			mysqli_free_result($result);
		}
	}
}

//DB CRUD: Create
function db_create($connection) {
	$connection = $connection;
	$display = ""; 
	$table = "";
	
	if (empty($_GET)) {
		$table = "";
	} else {
		$table = $_GET['display'];
		$display = $_GET['display'];
	
		function db_create_form_generation($connection, $table) {
				$connection = $connection;
				$table = $table;
				$fields = "";
				
				function form_field_generation($connection, $table) {
					$connection = $connection;
					$table = $table;
					// Need to create a loop here to make a different input for each field.	
					$fields_query = "SHOW COLUMNS ";
					$fields_query .= "FROM $table"; 
					$fields = mysqli_query($connection, $fields_query);
					$fields = mysqli_fetch_all($fields);
			
					//Not necessary?
					//echo "<h2>" . ucwords($table) . "</h2>" . "<td class='data_output'>" . "<table>";
					// Not necessary?
					
					if (!$fields) {
						die("Error displaying data.");
					}  else {
						//echo "Debugging: ";
						//echo "<tr>";
						for ($i=0; $i < count($fields); $i++) {
							//echo "<td class='data_output_headers'>";
							$formatted_fields = ucwords($fields[$i][0]);
							//print_r($formatted_fields);
							//echo "</td>";
						}
						//echo "</tr>";
					}
					return $fields;
				}
				
				function form_display ($connection, $table, $fields) {
					$connection = $connection;
					$table = $table;
					$fields = $fields;
					// Defining display here instead of passing may be repetitive
					$display = $_GET['display'];
					
					//Debugging
					/* if ($table == "clients") {
						echo "<h2>Add " . ucwords($table) . "</h2>";
						echo "<form action='' method='post'>
	    				Last Name: <input type='text' name='last_name' value=''/><br/>
	    				First Name: <input type='text' name='first_name' value=''/><br/>
	    				Middle Name: <input type='text' name='middle_name' value=''/><br/>
	    				Prefix: <input type='text' name='name_affix' value=''/><br/>
	    				Suffix: <input type='text' name='name_suffix' value=''/><br/>
	    				Agency: <input type='text' name='agency' value=''/><br/>
	    				Case Manager: <input type='text' name='case_manager' value=''/><br/>
	    				Point of Contact: <input type='text' name='point_of_contact' value=''/><br/>
	    				<p><input type='submit' name='submit' value='Add'/></p>
	  					</form>";
					} else {
						
					} */
					
					$form  = "<h2>Add " . ucwords($table) . "</h2>";
					$form .= "<form action='' method='post'>";
					for ($i=1; $i < count($fields) ; $i++) {
						$field = $fields[$i][0]; 
						$form .= ucwords($field) . ": <input type='text' name='$field' value=''/><br/>";
					}
    				$form .= "<p><input type='button' id='cancel_button' name='cancel' value='Cancel'/>";
    				$form .= "<input type='submit' name='submit' value='Add ". ucwords($display) . "'/></p>
  					</form>";
  					
  					echo $form;
				}
				
			$fields = form_field_generation($connection, $table);
			form_display($connection, $table, $fields);
		}
		
		function db_create_form_processing($connection, $table) {
			$connection = $connection;
			$table = $table;
			$display = $table;
			$query = "";
			$form_is_empty = "";
			
			function empty_form_test() {
				$filled_form_fields_count = "";
				$form_is_empty = "";
				
				foreach ($_POST as $key => $value) {
					if (!empty($value)) {
						$filled_form_fields_count += 1;
					} 
				}
				
				if ($filled_form_fields_count > 1) {
					$form_is_empty = FALSE;
				} else {
					$form_is_empty = TRUE;
				}
				
				return $form_is_empty;
			}
			
			function construct_query($table) {
				$table = $table;
				$query = "";
				$fields = "";
				$columns = "";
				$values ="";
				// May want to re-factor global declaration.
				global $connection;
				
				if(!empty($_POST)) {
					/* //Debugging
					//echo "POST Debugging: <br/>";
					//print_r($_POST);
					//Debugging */
					
					$fields = $_POST;
					unset($fields['submit']);
					
					// Query Format Validation
					/*
					function format_validation($fields) {
						// Notice: global $connection; being used. May want to re-factor.
						function primary_validation($fields) {
							global $connection;
							//  Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z. 
							foreach ($fields as $key => $value) {
								// String test not working.
								if (is_string($value)) {
									$value = mysqli_real_escape_string($connection, $value);
								}
							}
							return $fields;
						}
						
						//function secondary_validation($fields) {
						//	global $connection;
						//}
						
						$fields = primary_validation($fields);
						//secondary_validation($fields);
						return $fields;
					}						
					
					$fields = format_validation($fields); 
					*/
					
					// Query Creation Prep
					function input_count($fields) {
						$fields = $fields;
						$input_count ="";
						
						foreach ($fields as $key => $value) {
							if(!empty($value)) {
								++$input_count;
							}
						}
					return $input_count;
					}
					
					$input_count = input_count($fields);
					
					// Query Creation
					// mysqli_real_escape_string formats values with special characters so they can be stored in the database and not alter the format of the SQL query statement.
						foreach ($fields as $key => $value) {
							if(!empty($value) && $input_count > 1) {
								$value = mysqli_real_escape_string($connection, $value);
								$columns .= $key . ", ";
								$values .= "'" . $value . "'" . ", ";
								--$input_count;
							} elseif(!empty($value) && $input_count == 1) {
								$value = mysqli_real_escape_string($connection, $value);
								$columns .= $key;
								$values .= "'" . $value . "'";
							}
						}
					
					$query =  "INSERT INTO ";
					$query .= "$table (";
					$query .= "$columns) ";
					$query .= "VALUES (";
					$query .= "$values)";
					
					//Debugging
					//echo "<br/><br/>Query Debugging: <br/>" . $query . "</br>";
					//Debugging
				} else {
					$query = "";
				}
			return $query;
			}
			
			function run_query($connection, $query, $display, $form_is_empty) {
				$connection = $connection;
				$query = $query;
				$display = $display;
				$form_is_empty = $form_is_empty;
				
				function db_interfacing($connection, $query, $form_is_empty) {
					$connection = $connection;
					$query = $query;
					$form_is_empty = $form_is_empty;
											
					function send_query($connection, $query, $empty_form_test) {
						$connection = $connection;
						$form_is_empty = $empty_form_test;
						$query = $query;
						
						if($form_is_empty == FALSE) {
							$result = mysqli_query($connection, $query);
						return $result;
						} 
					}
				
					$result = send_query($connection, $query, $form_is_empty);
					return $result;
				}
				
				function report ($result, $display, $form_is_empty) {
					//$result = $result;
					//$display = $display;
					//$form_is_empty = $form_is_empty;
					
					if ($result) {
						echo "Successfully added $display.";
						redirect_to("submission.php?display=personnel", 0);
					} 
					elseif (!empty($_POST) && $form_is_empty = TRUE) {
						echo "Please enter data and click 'Add'.";
					}
				}
				
				$result = db_interfacing($connection, $query, $form_is_empty);
				report($result, $display, $form_is_empty);
			}
			
			$form_is_empty = empty_form_test();
			$query = construct_query($table);
			run_query($connection, $query, $display, $form_is_empty);
		}
		
		//DB Create Function Calls
		db_create_form_processing($connection, $table);
		if (isset($_GET['add'])) {
			
			db_create_form_generation($connection, $table);
			//echo $_GET['add'];
			//echo "<a href='?display=$display&add=true'>Add $display</a>";
		} else {
			db_page_options_display($display);
		}
		
	}
}

//DB CRUD: Update
function db_update($connection) {
	
}

//DB CRUD: Delete
function db_delete($connection) {
	
}

//DB Page Options
function db_page_options_display($display) {
	//$display = $_GET['display'];
	echo "<a href='?display=$display&add=true#form'>Add " . ucfirst($display) . "</a>";
	echo " / ";
	echo "<a href='?display=$display&delete=true#form'>Delete " . ucfirst($display) . "</a>";
}


?>