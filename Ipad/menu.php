<?php
header('Content-type: application/json');
include("config.php");
//Crear conexi�n a la Base de Datos
$conexion = mysql_connect($server,$dbuser,$dbpass);
if (!$conexion){
  die('No se Pudo Conectar: ' . mysql_error());
}
//Seleccionar la Base de Datos a utilizar
    $seleccionar_bd = mysql_select_db($database, $conexion);
    mysql_set_charset('utf8',$conexion);
	//mysql_query ("SET NAMES 'utf8'");
    if (!$seleccionar_bd) {
        die('Fallo la selecci�n de la Base de Datos: ' . mysql_error());
    }
    //$result = mysql_query("SELECT * FROM menu where id between 1 and 76");
	$result = mysql_query("SELECT * FROM menu where seccion = 'MENU'");
	
	$records = array();

	while($row = mysql_fetch_assoc($result)) {
		$records[] = $row;
	}
	mysql_close($conexion);
	
	echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');'; 
?>