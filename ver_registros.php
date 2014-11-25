<?php
if(isset($_GET['letra'])){
include("config.php");
//Crear conexión a la Base de Datos
$conexion = mysql_connect($server,$dbuser,$dbpass);
if (!$conexion){
  die('No se Pudo Conectar: ' . mysql_error());
}
$url = "http://198.1.89.58/~appel10/el10/menu";
$letra = $_GET["letra"];
//echo $letra;
//Seleccionar la Base de Datos a utilizar
    $seleccionar_bd = mysql_select_db($database, $conexion);
    mysql_set_charset('utf8');
    if (!$seleccionar_bd) {
        die('Fallo la selección de la Base de Datos: ' . mysql_error());
    }
	$result = mysql_query("SELECT * FROM menu where id='$letra'");

?>
<?php while($row = mysql_fetch_assoc($result)) {
echo 'TEST ver_registros.php';
?>




	<?php if($row['imagen'] == '' or $row['imagen'] == null){ ?>
		<?php  echo '<p>'.$row['nombre'].'</p>';
			   echo '<p>'."$".$row['precio'].'</p>';
			   echo '<p>'.$row['descripcion'].'</p>';
			 }
			 else { ?>
		<p><?php echo $row['nombre'] ?></p>
		<p><?php echo "$".$row['precio'] ?></p>
		
		
	
		<?php if(is_file($url."/".$row['imagen'].".jpg")){ ?>
		<img src="<?php echo $url."/".$row['imagen']; ?>.jpg" width="280px"/>
        <?php } ?>

<p><?php echo $row['descripcion'] ?></p>
<?php
		}
	}
mysql_close($conexion);
}
else{
	print "error";
}	
?>