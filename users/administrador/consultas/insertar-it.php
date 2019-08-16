
<?php

require('../../../php/conexion.php');

//Variables parte 1

if (isset($_POST['ClaveIT'])) {
$ClaveIT=$_POST['ClaveIT'];
}

if (isset($_POST['Nombre'])) {
$Nombre=$_POST['Nombre'];
}

if (isset($_POST['lista_estado'])) {
$lista_estado=$_POST['lista_estado'];
}

if (isset($_POST['municipios'])) {
$municipios=$_POST['municipios'];
}

if (isset($_POST['Direccion'])) {
$Direccion=$_POST['Direccion'];
}

if (isset($_POST['LogoRuta'])) {
$LogoRuta=$_POST['LogoRuta'];
}

if (isset($_POST['SubtituloFormatos'])) {
$SubtituloFormatos=$_POST['SubtituloFormatos'];
}

if (isset($_POST['IDCoordinador'])) {
$IDCoordinador=$_POST['IDCoordinador'];
}

//Consulta1

$mysql="INSERT INTO `it` (IDIT, ClaveIT, Nombre, IDEstado, IDMunicipio, Direccion, LogoRuta, SubtituloFormatos, IDCoordinador) values('null', '$ClaveIT', '$Nombre', '$lista_estado', '$municipios   ', '$Direccion', '$LogoRuta', '$SubtituloFormatos', '$IDCoordinador')";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));
echo'<script type="text/javascript">
       alert("Archivo guardado");
            window.location.href="../administrar-it.php"; 
    </script>';
mysqli_close($mysqli);


?>









































