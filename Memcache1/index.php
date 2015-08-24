<?php
//Instantiate new MemCached instance 

$memcached = new Memcached;
//Make a connection
$host = 'localhost';
$port = '11211';

$cache = $memcached->addServer($host,$port);


$mysqlengine = 'mysql';
$database = 'aena';
$host = 'localhost';
$username = 'root';
$password = 'java_innova4b';
$dsn=$mysqlengine.':dbname='.$database.';host='.$host;

$pdo = new PDO($dsn,$username,$password);

//Query
$query = "insert into aeropuerto (nombre,num_puertas,pais) values (:airport,:num_gates,:country)";
$airport = 'Biarritz';
$num_gates = 20;
$country = 'France';

$statement = $pdo->prepare($query);
$success = $statement->execute(array(':airport' => $airport, ':num_gates' => $num_gates, ':country' => $country));

if ($success === true) {
	echo 'Success';
	//Create an associative Array
	$cache_Array = array('airport' => $airport, 'num_gates' => $num_gates, 'country'=> $country);
	//Save data to mem Cache
	$memcached->set('array',$cache_Array,$timeout=60) or die('Unable to cache database row');
	
	if ($cache) {
		$get_array = $memcached->get('array');
		var_dump($get_array);
	}
		
} else {
	echo 'Fail';
}