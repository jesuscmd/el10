<?php

  require('connection.php');

  $var = $_POST['idArticulo'];
  $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);  
  $query = "SELECT * FROM menu WHERE id = $var";
  $results = $con->query($query);
  $return = array();

  if($results) {
    while($row = $results->fetch_assoc()) {
      $return = array('descripcion' => (string)utf8_encode($row['descripcion']),'precio' => (float)$row['precio'],'uva' => (string)utf8_encode($row['uva']),'maridaje' => (string)utf8_encode($row['maridaje']),'ml' => (float)$row['ml'],'personalizacion' => (float)$row['personalizacion'],'imagen' => (float)$row['imagen']);
    }
  }

  echo json_encode($return);
  $con->close();
 ?>