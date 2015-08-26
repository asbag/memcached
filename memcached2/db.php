<?php
/**
 * @author David Mezquíriz Osés
 * PDO Connection to database
 */
 
define('USERNAME', 'root');
define('PASSWORD', 'java_innova4b');
define('DBENGINE','mysql');
define('HOST', 'localhost');
define('DBNAME', 'memcached2');

$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
$dsn = DBENGINE . ':dbname=' . DBNAME . ';host=' . HOST;


$db = null;

try {
	$db = new PDO($dsn, USERNAME, PASSWORD, $options);
} catch (PDOException $e) {
	$e->getMessage();
}