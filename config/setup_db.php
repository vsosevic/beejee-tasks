<?php

try {
	$paramsPath = dirname(__FILE__) . '/db_params.php';
	$params = include($paramsPath);

	$db = new PDO("mysql:host={$params['host']}", $params['user'], $params['password']);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//DB creation
	$sql = "CREATE DATABASE IF NOT EXISTS beejee";
	$db->exec($sql);

	//Table creation
	$sql = "USE beejee;
		CREATE TABLE `Tasks`
			(id_task INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			user_name VARCHAR(250) NOT NULL,
			user_email VARCHAR(250) NOT NULL,
			text LONGTEXT NOT NULL,
			url VARCHAR(250),
			status INT(1) DEFAULT '0'
			) ENGINE=InnoDB;
			";

	$db->exec($sql);
	} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
	}
$db = null;
?>