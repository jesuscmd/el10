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
    //$result = mysql_query("SELECT * FROM menu where id between 24 and 29");
	$result = mysql_query("SELECT * FROM menu where categoria='BAGUETTES' ORDER BY id");
	
	$records = array();

	while($row = mysql_fetch_assoc($result)) {
		$records[] = $row;
	}
	mysql_close($conexion);
	
	echo $_GET['jsoncallback'] . '(' . jsonRemoveUnicodeSequences($records) . ');'; 
function jsonRemoveUnicodeSequences($struct){return preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($struct));}	

?>