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
<?php while($row = mysql_fetch_assoc($result)) {?>
	
	<div style="width:280px; height:100px; float:left;">
    	<h3 style="font-size:10px; color:#109ECC;">SERVICIO A DOMICILIO</h3>
		<h3 style="font-size:10px; color:#109ECC;"><?php echo $row['direccion'] ?></h3>
    	<div style="font-size:20px; color:#000;  font-weight:bold;"><?php echo $row['telefono'] ?></div>
    	<div style="font-size:10px; color:#000; font-weight:bold; padding-left:5px;">HORARIOS:<span style="color:#109ECC;"><?php echo $row['horario'] ?></span></div>
    </div><br/>
		<?php echo $row['mapa'] ?>
<?php
	}
mysql_close($conexion);
}
else{
	print "error";
}	
?>