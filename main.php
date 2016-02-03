<?php

require('db.php');

/* Create the table */
if (!$mysqli->query("CREATE TABLE IF NOT EXISTS inventory(
		id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		name VARCHAR(255) UNIQUE NOT NULL,
		category VARCHAR(255) DEFAULT '',
		length INT UNSIGNED,
		rented INT UNSIGNED DEFAULT 0);")) {
    echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

?>

