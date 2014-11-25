<?php
//Proceso de conexión con la base de datos
$conex = mysql_connect("localhost", "appel10_el10", "eldiez")
		or die("No se pudo realizar la conexion");
	mysql_select_db("appel10_el10",$conex)
		or die("ERROR con la base de datos");

// Recibimos la variable Cedula pasada mediante el metodo GET
// y depositamos el valor de esta en la variable llamada $Cedula
 
$id=$_GET['id'];
$query="SELECT id FROM menu WHERE id='$id'";
$result=mysql_query($query,$conex) or die("Error: ".mysql_error());
 
// Verificamos con la consulta SELECT si existe un registro asociado al número
// recibido concretamos la consulta DELETE, sino avisamos que fué imposible realizarla
 
if(mysql_num_rows($result) > 0){
    $query="DELETE FROM menu WHERE id='$id'";
    $result=mysql_query($query,$conex) or die("Error: ".mysql_error());
    //echo "<p>Se ha dado de baja el ticket con id ".$id."</p>";
	echo "<script language = javascript>
			alert('Se ha dado de baja el ticket con id $id');
			self.location = 'menu_.php'
		  </script>";
	
}else{
    //echo "<p>No fué posible dar de baja al ticket con id ".$id."</p>";
	echo "<script language = javascript>
			alert('No fué posible dar de baja al ticket con id $id');
			self.location = 'menu_.php'
		  </script>";
}
// Cerramos la conexión
mysql_close($conex);
 
?>