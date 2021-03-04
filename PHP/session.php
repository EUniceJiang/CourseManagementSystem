<?php
	//starting session
	session_start();

	//if the session for username has not been set, initialise it
	if(!isset($_SESSION['session_user'])){
		$_SESSION['session_user']="";
	}
	//save username in the session 
	$session_user=$_SESSION['session_user'];
?>