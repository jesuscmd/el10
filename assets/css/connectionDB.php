<?php
define ( 'DB_HOST', 'localhost' );
define ( 'DB_USER', 'appel10_el10' );
define ( 'DB_PASS', 'eldiez' );
define ( 'DB_NAME', 'appel10_el10' );
  $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $query = "SELECT * FROM menu WHERE categoria IS NOT NULL order by categoria ASC";
  $results = $con->query($query);
  $return = array();
  $categoriaAnterior = "";
  $contador = 0;
  $contadorCategoria = 0;
  if($results) {
    while($row = $results->fetch_assoc()) {
      if ($row['categoria'] != $categoriaAnterior) {
        $contadorCategoria ++;
      }
      //$return[$contadorCategoria][$contador] = array((string)$row['nombre'],(float)$row['precio'],(float)$row['id'],(string)$row['categoria'],(string)$row['description'],(string)$row['maridaje'],(string)$row['ml'],(string)$row['uva'],(string)$row['image'],(string)$row['orden']);
      $return[$contadorCategoria][$contador] = array((float)$row['id'],(string)$row['nombre'],(string)$row['categoria'],(string)$row['orden']);
      $categoriaAnterior = $row['categoria'];
      $contador ++;
    }
  }
  echo json_encode($return);
  $con->close();
 ?>