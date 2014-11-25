<?php
// DATABASE: Connection variables
$db_host		= "localhost";
$db_name		= "appel10_el10";
$db_username	= "appel10_el10";
$db_password	= "eldiez";

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$precio_p = $_POST['precio_p'];
$categoria = $_POST['categoria'];
$decripcion = $_POST['descripcion'];
$maridaje = $_POST['maridaje'];
$ml = $_POST['maridaje'];
$uva = $_POST['uva'];
$imagen = $_POST['imagen'];
$seccion = $_POST['seccion'];

// DATABASE: Try to connect
if (!$db_connect = mysql_connect($db_host, $db_username, $db_password))
	die('Unable to connect to MySQL.');
if (!$db_select = mysql_select_db($db_name, $db_connect))
	die('Unable to select database');

	mysql_set_charset('utf8', $db_connect);
	$query = mysql_query ("select * from menu where nombre = '$nombre'");
	$num_rows = mysql_num_rows($query);

	if ($num_rows > 0) {
		echo "<script type='text/javascript'>
				alert('Ya estas Registrado');
				self.location = 'menu_.php'
			 </script>";
	}
	else{	
		//Insertar campos en la Base de Datos (No inserto el id_empleado ya que se genera automaticamente)
		$insertar = mysql_query("INSERT INTO menu(nombre,precio,precio_p,categoria,descripcion,maridaje,ml,uva,imagen,seccion)values('$nombre','$precio','$precio_p','$categoria','$descripcion','$maridaje','$ml','$uva','$imagen','$seccion')",$db_connect);
		
		if (!$insertar) {
			die('<center>Fallo en la insercion de registro en la Base de Datos: </center>' . mysql_error());
		}
		echo "<script type='text/javascript'>
				alert('Dato Registrado');
				self.location = 'menu_.php'
			 </script>";
	}
    mysql_close($db_connect);
?>