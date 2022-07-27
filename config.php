<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "banksysphp";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if(!$conn){
		die("Could not connect to the database due to the following error --> ".mysqli_connect_error());
	}
	// php code for logging error into a given file
  
	// error message to be logged
	//$error_message = "This is an error message!";
	
	// path of the log file where errors need to be logged
	$log_file = "./my-errors.log";
	ini_set("log_errors", TRUE); 
	// logging error message to given log file
	// error_log($error_message, 3, $log_file);
?>