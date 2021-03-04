<?php
	// Declare database connection parameters
	define('DB_HOST', 'localhost');
	define('DB_USER','yanranj');
	define('DB_PASSWORD','505884');
	define('DB_NAME','yanranj');


	//connect to mysql
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>