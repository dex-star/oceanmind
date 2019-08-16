<?php 
require_once 'conexionLista.php';

function getMunicipios(){
  $mysqli = getConn();
  $id = $_POST['IDEstado'];
  $query = "SELECT * FROM `ubicacion-municipios` WHERE IDEstado = $id";
  $result = $mysqli->query($query);
  $municipios = '<option value="0">Elige un municipio</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $municipios .= "<option value='$row[IDMunicipio]'>$row[NombreMunicipio]</option>";
  }
  return $municipios;
}

echo getMunicipios();
