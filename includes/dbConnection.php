<?php

	$hostname =  'localhost';
	$username = 'root';
	$pass = '';
	$dbname = 'test';

	try{

		$conn = new PDO('mysql:host='.$hostname.';dbname='.$dbname,$username,$pass);

	}catch(Exception $e){
		echo $e->getMessage();
	}

?>