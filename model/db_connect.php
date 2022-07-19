<?php
	const DB_HOST = 'localhost';
	const DB_NAME = 'giver';
	const DB_USER = 'root';
	const DB_PASS = '';

	function dbConnect() {
		try {
			return new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
		} catch (PDOExcpetion $erro) {
			return $erro->getMessage();
		}
	}