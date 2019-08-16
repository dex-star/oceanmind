<?php 
require_once 'conexionLista.php';

function getIt(){
  $mysqli = getConn();
  $id = $_POST['IDEstado'];
  $query = "SELECT * FROM `escuelas-superior` WHERE entidad = $id";
  $result = $mysqli->query($query);
  $it = '<option value="0">Elige una IT</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $it .= "<option value='$row[nombrecct]'>$row[nombrecct]</option>";
  }
  return $it;
}

echo getIt();
