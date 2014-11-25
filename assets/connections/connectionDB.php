<?php

  require('connection.php');

  $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);  
  $query = "SELECT id, nombre, orden FROM menu WHERE categoria IS NOT NULL OR nombre IS NOT NULL ORDER BY categoria ASC";
  $results = $con->query($query);
  $return = array();
  $categoriaAnterior = "";
  $contador = 0;
  $contadorCategoria = 0;

  if($results) {
    while($row = $results->fetch_assoc()) {
      if ($row['categoria'] != $categoriaAnterior) {
        $contadorCategoria ++;
        $return[$contadorCategoria]["nombre"] = utf8_encode($row['categoria']);
        $contador = 0; 
      }
      $orden = array('orden' => (float)$row['orden']);
      $return[$contadorCategoria]["articulos"][$contador] = array((float)$row['id'],(string)utf8_encode($row['nombre']),'orden' => (float)$row['orden']);
      if ($row['categoria'] != $categoriaAnterior) {
        $contador = 0;
      }
      $categoriaAnterior = $row['categoria'];
      $contador ++;
    }
  };
  /*foreach ($results as $valor){
  }*/
  echo json_encode($return);
  $con->close();
 ?>