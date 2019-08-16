
<?php

require('../../../php/conexion.php');

//Variables parte 1

if (isset($_POST['NombreArchivo'])) {
$NombreArchivo=$_POST['NombreArchivo'];
}

if (isset($_POST['Descripcion'])) {
$Descripcion=$_POST['Descripcion'];
}

if (isset($_POST['Link'])) {
$Link=$_POST['Link'];
}

if (isset($_POST['Tipo'])) {
$Tipo=$_POST['Tipo'];
}

if (isset($_POST['IDAdmin'])) {
$IDAdmin=$_POST['IDAdmin'];
}

//Consulta1

$mysql="INSERT INTO `material-lectura` (IDMaterial, NombreArchivo, Descripcion, Link, Tipo, IDAdmin) values('null','{$NombreArchivo}', '{$Descripcion}', '{$Link}', '{$Tipo}', '$IDAdmin')";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));
echo'<script type="text/javascript">
       alert("Archivo guardado");
            window.location.href="../administrar-material.php"; 
    </script>';
mysqli_close($mysqli);


?>