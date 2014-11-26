<?php

  require('connection.php');

  $objeto = $_POST['articulo'];

  $id =               $objeto[0];
  $nombre =           utf8_decode($objeto[1]);
  $precio =           $objeto['precio'];
  $precio_p =         $objeto['precio_p'];
  $categoria =        utf8_decode($objeto['categorias']);
  $descripcion =      utf8_decode($objeto['descripcion']);
  $maridaje =         $objeto['maridaje'];
  $ml =               $objeto['ml'];
  $uva =              utf8_decode($objeto['uva']);
  //$image =          $objeto['image'];
  //$seccion =          $objeto['seccion'];
  $personalizacion =  $objeto['personalizacionNumero'];
  //$orden =            $objeto['orden'];

  // Create connection
  $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);  
  // Check connection
  if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
  } 

  $sql = "UPDATE menu SET nombre='$nombre', precio='$precio', precio_p='$precio_p', categoria='$categoria', descripcion='$descripcion', maridaje='$maridaje', ml='$ml', uva='$uva', personalizacion='$personalizacion' WHERE id = $id";


  if ($con->query($sql) === TRUE) {
    echo "New record created successfully ". $nombre;
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }

  $con->close();

 ?>