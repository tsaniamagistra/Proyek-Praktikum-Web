<?php
	$hostname	= "localhost"; 
	$username	= "root"; 
	$password	= ""; 
	$database	= "rumah_sakit"; 

	$connect	= new mysqli($hostname, $username, $password, $database); 

	if($connect->connect_error) { 
		die("Error : ".$connect->connect_error);
	}
?>