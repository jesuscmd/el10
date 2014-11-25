<?php
include("../config.php");
$conexion = mysql_connect($server,$dbuser,$dbpass);
if (!$conexion){die('No se Pudo Conectar: ' . mysql_error());}
$seleccionar_bd = mysql_select_db($database, $conexion);
mysql_set_charset('utf8');
if (!$seleccionar_bd) {die('Fallo la selección de la Base de Datos: ' . mysql_error());}
$result = mysql_query("SELECT * FROM sucursales where id='8'");
while($row = mysql_fetch_assoc($result)) { ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body style="background:#FFF;">
<div style="width:800px; height:400px;">
<h1 style="color:#09C; font-size:45px;">Reforma</h1>
<p><?php echo $row['direccion']; ?></p>
<iframe style="width:640px; height:300px; overflow:auto;" src="
http://maps.google.com/maps?q=<?php echo $row['mapa']; ?>&amp;hl=es&amp;ie=UTF8&amp;t=m&amp;output=embed
"></iframe>
<!--
<img src="?.jpg" style="border:solid 5px; color:#FFF; text-align:center;">
-->
</div>
</body>
</html>
<?php
}
mysql_close($conexion);
?>
