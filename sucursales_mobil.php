<?
function distancia($par1, $par2){
  $lat1 = $par1[0];
  $lon1 = $par1[1];
  $lat2 = $par2[0];
  $lon2 = $par2[1];
  
  //distancia en radianes (formula del gran circulo)
  return acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($lon1 - $lon2));
}

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
    if($map == 'CERCANA' && isset($_GET['ubi']) && isset($_GET['activos'])){
      $ubicacionUsuario = explode(',', $_GET['ubi']);
      $menorDistancia = NULL;
      $idCercano = 0;
      $query = sprintf("SELECT id, mapa FROM sucursales WHERE id IN (%s)", $_GET['activos']);
      $result = mysql_query($query);
      while($row = mysql_fetch_assoc($result)){
	$ubicacionSucursal = explode(',', $row['mapa']);
	$distancia = distancia($ubicacionUsuario, $ubicacionSucursal);
	if($menorDistancia === NULL){
	  $idCercano = $row['id'];
	  $menorDistancia = $distancia;
	}
	else if($menorDistancia > $distancia){
	  $idCercano = $row['id'];
	  $menorDistancia = $distancia;
	}
      }
      echo $_GET['jsoncallback'] . '(' . sprintf('{id:%d}', $idCercano) . ');';
    }
    else{
      $result = mysql_query("SELECT * FROM sucursales where id='$map'");
        $records = array();
	while($row = mysql_fetch_assoc($result)) {
	  $records[] = $row;
	}
	mysql_close($conexion);
	
	echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');'; 
    }
}
else{
	print "{error: error}";
}	
?>