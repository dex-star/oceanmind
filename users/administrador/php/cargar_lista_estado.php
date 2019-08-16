<?php 
require_once 'conexionLista.php';

function getListaEdo(){
  $mysqli = getConn();
  $query = 'SELECT * FROM `ubicacion-estado`';
  $result = $mysqli->query($query);
  $listas = '<option value="0">Seleccione un estado</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $listas .= "<option value='$row[IDEstado]'>$row[NombreEstado]</option>";
  }
  return $listas;
}

echo getListaEdo();