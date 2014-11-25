<?php
if (!isset($_SESSION)) {
  session_start();
}
/*
$server="localhost";
$database="appel10_el10";
$dbuser="appel10_el10"; 
$dbpass="eldiez";*/


$server="localhost"; /* Nuestro server mysql */
$database="appel10_el10"; /* Nuestra base de datos */
$dbuser="root"; /* Nuestro user mysql */
$dbpass=""; /*Nuestro password mysql */


$conexion = mysql_connect($server,$dbuser,$dbpass);
if (!$conexion){
  die('No se Pudo Conectar: ' . mysql_error());
}

$seleccionar_bd = mysql_select_db($database, $conexion);
mysql_set_charset('utf8');

if (!$seleccionar_bd) {
	die('Fallo la selección de la Base de Datos: ' . mysql_error());
}	
		
$usuario= $_POST['usuario'];
$contrasena= $_POST['contrasena'];
$consulta= "SELECT * FROM Usuarios WHERE user ='".$usuario."' AND pass ='".$contrasena."'"; 

$resultado = mysql_query($consulta);

$fila=mysql_fetch_array($resultado);

if (!$fila[0]) //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
{
	/*echo '<script language = javascript>
	alert("Usuario o Password errados, por favor verifique.")
	self.location = "index.php"
	</script>';*/
	$_SESSION['error']="Usuario y Password incorrectos";
	header("Location: index.php");
}
else //opcion2: Usuario logueado correctamente
{
	//Definimos las variables de sesión y redirigimos a la página de usuario
	$_SESSION['id_user'] = $fila['user'];
	$_SESSION['pass_user'] = $fila['pass'];
	$_SESSION['login_user'] = "OK";

	header("Location: menu_.php");
}

?>