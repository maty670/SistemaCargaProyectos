<?php 

try{
	
	$servername = 'localhost';
	$db_name = 'gestion_registros';
	$username = 'root';
	$password = '';
	
	$conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn ->exec("SET CHARACTER SET UTF8");
}catch(Exception $e){
	echo "Linea del error: " . $e->getline();
}
?>