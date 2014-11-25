<?php
if(isset($_GET['suc'])){
//header('Content-type: application/json');
include("config.php");
//Crear conexión a la Base de Datos
$conexion = mysql_connect($server,$dbuser,$dbpass);
if (!$conexion){
  die('No se Pudo Conectar: ' . mysql_error());
}
$map = $_GET["suc"];
//echo $letra;
//Seleccionar la Base de Datos a utilizar
    $seleccionar_bd = mysql_select_db($database, $conexion);
    mysql_set_charset('utf8');
    if (!$seleccionar_bd) {
        die('Fallo la selección de la Base de Datos: ' . mysql_error());
    }
	$result = mysql_query("SELECT * FROM sucursales where id='$map'");

?>

<?php
  $records = array();

  while($row = mysql_fetch_assoc($result)) {
	  $records[] = $row;
  }
  mysql_close($conexion);
  
  echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');'; 
}
else{
	print "error";
}	
?>