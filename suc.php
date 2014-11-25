<?php
header('Content-type: application/json');
include("config.php");
//Crear conexión a la Base de Datos
$conexion = mysql_connect($server,$dbuser,$dbpass);
if (!$conexion){
  die('No se Pudo Conectar: ' . mysql_error());
}
//Seleccionar la Base de Datos a utilizar
    $seleccionar_bd = mysql_select_db($database, $conexion);
    $sucursal = $_REQUEST['sucursal'];
    //mysql_set_charset('latin1',$conexion);
    if (!$seleccionar_bd) {
        die('Fallo la selección de la Base de Datos: ' . mysql_error());
    }
    //$result = mysql_query("SELECT * FROM menu where id between 171 and 237 ");    
    $result = mysql_query("SELECT * FROM sucursales WHERE id='$sucursal'");
    $records = array();

    while($row = mysql_fetch_assoc($result)) {
        $records[] = array_map('utf8_encode', $row);
    }
    mysql_close($conexion);
    
    echo $_GET['jsoncallback'] . '(' . jsonRemoveUnicodeSequences($records) . ');'; 
function jsonRemoveUnicodeSequences($struct){return preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($struct));}	
 
?>