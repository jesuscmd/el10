<?php
include("config.php");
//Crear conexión a la Base de Datos
$conexion = mysql_connect($server,$dbuser,$dbpass);
if (!$conexion){
  die('No se Pudo Conectar: ' . mysql_error());
}
//Seleccionar la Base de Datos a utilizar
    $seleccionar_bd = mysql_select_db($database, $conexion);
    mysql_set_charset('utf8');
    if (!$seleccionar_bd) {
        die('Fallo la selección de la Base de Datos: ' . mysql_error());
    }
    $result = mysql_query("SELECT * FROM menu where id between 174 and 175");	
	
	$records = array();

	while($row = mysql_fetch_assoc($result)) {
		$records[] = $row;
	}
	mysql_close($conexion);
	
	echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');'; 
?>