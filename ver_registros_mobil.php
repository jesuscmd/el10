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

  while($row = mysql_fetch_assoc($result)) {
  
if($id=="PIZZ"){$pizz="&nbsp;<span style=\"font-size:8px;\">1/4</span>";}  
  
	if($row['imagen'] == '' or $row['imagen'] == null){
	  echo '<div class="m_listado"><div class="m_l_izq"><p style="color:#147786; height:14px; text-transform:uppercase;">'.$row['nombre'].'</p></div>';
	  echo '<div class="m_l_der"><p style="color:#147786; height:14px; text-transform:uppercase;">'."$".$row['precio'].$pizz.'</p></div></div>';
	  echo '<p>'.$row['descripcion'].'</p>';
	}else{
	  if($categoria == 'vinos'){
		echo '<div class="m_listado_v"><div class="m_l_izq_v">'.$row['nombre'].'</div>';
		echo '<div class="m_l_der_v"></div><div class="clear"></div>';
		echo '<table width="100%" class="linea_b"><tr><td width="50%" valign="top">';
		echo '<strong>Botella</strong><br>'.$row['precio'].$row['imagen'].'<br><strong>Copeo</strong><br>';
		echo $row['precio_p'].'</td><td width="50%">';
		
		//if(is_file(strtolower($url."/".$row['imagen'].".jpg"))){
		echo '<br/><img src="'.$url."/".$row['imagen'].'.jpg">';
		//}

        echo '</td></tr></table><strong>Descripción</strong><br>';
		echo $row['descripcion'].'<br><br><strong>Maridaje</strong><br>'.$row['maridaje'].'</div><br><br><br>';
		/*
		echo '<div class="m_listado_v"><div class="m_l_izq_v"><p style="color:#F00; height:14px; text-transform:uppercase;">vinosssss'.$row['nombre'].'</p></div>';
		echo '<div class="m_l_der"><p style="color:#F00; height:14px; text-transform:uppercase;">$ '.$row['precio'].'</p></div></div>';
		echo '<img src="'.$url."/".$row['imagen'].'.jpg" width="280px"/>';
		echo '<p>'.$row['descripcion'].'</p>';
		*/
	  }else{
		echo '<div class="m_listado"><div class="m_l_izq"><p style="color:#147786; height:14px; text-transform:uppercase;">'.$row['nombre'].'</p></div>';
		echo '<div class="m_l_der"><p style="color:#147786; height:14px; text-transform:uppercase;">$ '.$row['precio'].$pizz.'</p></div></div>';
		
		
		//if(is_file(strtolower($url."/".$row['imagen'].".jpg"))){
		echo '<br/><img src="'.$url."/".$row['imagen'].'.jpg" width="280px"/>';
		//}
		
		echo '<p>'.$row['descripcion'].'</p><br><br><br>';
	  }
	}
  }
	
  mysql_close($conexion);
}else{
	print "error";
}
?>







