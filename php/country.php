<?php
include("mysqli.php");

$pais = $_GET['q'];

$resultado = MySQLDB::getInstance()->query("SELECT * FROM countries WHERE nombre LIKE '%$pais%'");
//$resultado = MySQLDB::getInstance()->query("SELECT * FROM countries WHERE nombre='$pais'");
//$resultado = $conexion->query("SELECT * FROM countries WHERE nombre LIKE '%$pais%'");
if ($resultado->num_rows != 0) { 
$datos = array();
 
while ($row=$resultado->fetch_assoc()){
 
	$datos[] = $row['nombre'];
}
 
echo json_encode($datos);
}else{

	echo "error";
}



?>