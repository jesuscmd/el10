                <?php

			$nombre = $_POST[nombre];

			$celular = $_POST[celular];

			$telefono = $_POST[telefono];

			$email = $_POST[email];

			$sucursal = $_POST[sucursal];
	
			$comentarios = $_POST[comentarios];
			
			$cumple = $_POST[cumple];
			$cumple = explode("-", $cumple);
			$cumple = $cumple[2] . "/" . $cumple[1] . "/" . $cumple[0];

			$mes = $_POST[mes];

			$ano = $_POST[ano];



 	$receiverMail = 'el10@godisruptive.com';
	/*$receiverMail = 'jeremiasa@godisruptive.com,el10@godisruptive.com';*/
	

	$msg = "---------------\n";

	$msg .= "Has recibido comentarios desde El 10 app \n";

	$msg .= "---------------\n\n";

	$msg .= "Nombre: ".$nombre."\n"; 

	$msg .= "Correo electronico: ".$email."\n"; 

	$msg .= "Celular: ".$celular."\n"; 

	$msg .= "Fecha de nacimiento: ". $cumple ."\n"; 

	$msg .= "Sucursal: ".$sucursal."\n"; 

	$msg .= "Comentarios: ".$comentarios."\n"; 

    $mailheaders .= "From: ".$email."\n"; 

    $mailheaders .= "Reply-To: ".$email."\n"; 

	
	mail($receiverMail, "Contacto desde El 10", $msg, $mailheaders);	
	echo "<p>Muchas Gracias, tus datos fueron enviados correctamente</p>";
	echo "<script type='text/javascript'>
				function redirect(){
				self.location = 'index.html'
				}
				setTimeout('redirect()',3000);
			 </script>";

?>
