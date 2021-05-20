<?php 
	$dsn = 'mysql:host=localhost;dbname=wolrd';
	$username = 'root';

	try {

	} catch(PDOException $e) {
		$error_message = 'DataBase error ';
		$error_message .= $e->getMessage();
		echo $error_message;
		exit();
	}
?>