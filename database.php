<?php 
	$dsn = 'mysql:host=localhost;dbname=world';
	$username = 'root';

	try {
		$db = new PDO($dsn, $username);
	} catch(PDOException $e) {
		$error_message = 'DataBase error ';
		$error_message .= $e->getMessage();
		echo $error_message;
		exit();
	}
?>