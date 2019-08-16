<?php

require('../../../php/conexion.php');

//ORGANIZACION ESTUDIO

if (isset($_POST['Correo'])) {
$Correo=$_POST['Correo'];
}

if (isset($_POST['Password'])) {
$Password=$_POST['Password'];
}

if (isset($_POST['UsuarioTipo'])) {
$UsuarioTipo=$_POST['UsuarioTipo'];
}

if (isset($_POST['Nombres'])) {
$Nombres=$_POST['Nombres'];
}

if (isset($_POST['ApellidoP'])) {
$ApellidoP=$_POST['ApellidoP'];
}

if (isset($_POST['ApellidoM'])) {
$ApellidoM=$_POST['ApellidoM'];
}

if (isset($_POST['Sexo'])) {
$Sexo=$_POST['Sexo'];
}

if (isset($_POST['FechaNacimiento'])) {
$FechaNacimiento=$_POST['FechaNacimiento'];
}

if (isset($_POST['FechaAlta'])) {
$FechaAlta=$_POST['FechaAlta'];
}

if (isset($_POST['LinnkFoto'])) {
$LinnkFoto=$_POST['LinnkFoto'];
}


//Consulta1
$mysql="INSERT INTO `usuarios` (IDUsuario, Correo, Password, UsuarioTipo, Nombres, ApellidoP, ApellidoM, Sexo, FechaNacimiento, FechaAlta, LinnkFoto) values('null', '$Correo', '$Password', '$UsuarioTipo', '$Nombres', '$ApellidoP', '$ApellidoM', '$Sexo', '$FechaNacimiento', '$FechaAlta', '$LinnkFoto')";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));
$ultimo_insert = mysqli_insert_id($mysqli);

$mysql1="INSERT INTO `coordinador` (`IDCoordinador`, IDUsuario) values('null', '$ultimo_insert')";
mysqli_query($mysqli,$mysql1) or die (mysqli_error($mysqli));

echo'<script type="text/javascript">
            alert("Tu información ha sido almacenada");
            window.location.href="../administrar-cordinador.php";
            </script>';

mysqli_close($mysqli);


?>