<?php

  require('connection.php');

  $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);  
  $query = "SELECT id, nombre, orden, categoria, seccion FROM menu WHERE categoria IS NOT NULL OR nombre IS NOT NULL ORDER BY categoria ASC";
  $results = $con->query($query);
  $return = array();
  $categoriaAnterior = "";
  $contador = 0;
  $contadorCategoria = -1;
  $articulos = array();
  $categorias = array();

  if($results) {
    while($row = $results->fetch_assoc()) {
      if ($row['categoria'] != $categoriaAnterior) {
        $contadorCategoria ++;
        $articulos[$contadorCategoria]["nombre"] = utf8_encode($row['categoria']);
        $articulos[$contadorCategoria]["seccion"] = utf8_encode($row['seccion']);

        array_push($categorias, utf8_encode($row['categoria']));
        
        $contador = 0;
      };
      $orden = array('orden' => (float)$row['orden']);
      $articulos[$contadorCategoria]["articulos"][$contador] = array((float)$row['id'],(string)utf8_encode($row['nombre']),'orden' => (float)$row['orden']);
      if ($row['categoria'] != $categoriaAnterior) {
        $contador = 0;
      }
      $categoriaAnterior = $row['categoria'];
      $contador ++;
    }
  };
  /*foreach ($results as $valor){
  }*/
  $return["articulos"] = $articulos;
  $return["categorias"] = $categorias;
  echo json_encode($return);
  //echo json_encode(array(1=>"ds", 0=>8));
  $con->close();
 ?>