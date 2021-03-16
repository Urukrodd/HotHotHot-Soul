<?php

use app\core\Application;

class m0001_initial
{
	public function up(): void
	{
		// Some SQL
		$db = Application::$app->db;

        $SQL = "
        CREATE TABLE User (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            password varchar(255) NOT NULL,
            roles varchar(255) NOT NULL,
            connection_number INT DEFAULT 0,
            last_connection DATETIME
        );";

		$SQL .= "CREATE TABLE IF NOT EXISTS HotHotHot (
			id INT AUTO_INCREMENT PRIMARY KEY,
			category VARCHAR(255),
			pos VARCHAR(255),
			val FLOAT,
			created_at DATETIME
		);";

	$SQL .= "CREATE TABLE IF NOT EXISTS MinMax (
			id INT AUTO_INCREMENT PRIMARY KEY,
			typed VARCHAR(255),
			minInterieur FLOAT,
			maxInterieur FLOAT,
			minExterieur FLOAT,
			maxExterieur FLOAT,
			created_at DATETIME
		);";

		$db->pdo->exec($SQL);
	}

	public function down()
	{
		// Some SQL
		/*
		$db = \app\core\Application::$app->db;
		$SQL = "DROP TABLE test()";
		$db->pdo->exec($SQL);
		*/
	}
}
