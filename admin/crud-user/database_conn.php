<?php // database_conn.php
$hostname = 'localhost'; // hostnames
$database_username = 'root'; // database usernames
$database_password = ''; // database passwords
$database_name = 'db'; //database name

// connection to database
$db_connect = mysqli_connect($hostname, $database_username, $database_password, $database_name);