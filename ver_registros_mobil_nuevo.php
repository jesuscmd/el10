<?php
if(isset($_GET['letra'])){
//header('Content-type: application/json');
include("config.php");
//Crear conexión a la Base de Datos
$conexion = mysql_connect($server,$dbuser,$dbpass);
if (!$conexion){
  die('No se Pudo Conectar: ' . mysql_error());
}


$url = "http://198.1.89.58/~appel10/el10/menu";
$letra = $_GET["letra"];
$id = $_GET["id"];
$categoria = $_GET["categoria"];
//echo $letra;
//Seleccionar la Base de Datos a utilizar
    $seleccionar_bd = mysql_select_db($database, $conexion);
    mysql_set_charset('utf8');
    //mysql_set_charset('latin1',$conexion);
    if (!$seleccionar_bd) {
        die('Fallo la selección de la Base de Datos: ' . mysql_error());
    }
	$result = mysql_query("SELECT * FROM menu where id='$letra'");

  $row = mysql_fetch_assoc($result);
  echo json_encode($row);
  mysql_close($conexion);
}else{
	print "error";
}
?>







