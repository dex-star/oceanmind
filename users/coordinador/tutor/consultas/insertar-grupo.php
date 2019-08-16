<?php

require('../../../../php/conexion.php');

//ORGANIZACION ESTUDIO

if (isset($_POST['Periodo'])) {
$Periodo=$_POST['Periodo'];
}

if (isset($_POST['Aula'])) {
$Aula=$_POST['Aula'];
}

if (isset($_POST['Turno'])) {
$Turno=$_POST['Turno'];
}

if (isset($_POST['IDTutor'])) {
$IDTutor=$_POST['IDTutor'];
}

if (isset($_POST['IDCarrera'])) {
$IDCarrera=$_POST['IDCarrera'];
}

//Consulta1
$mysql="INSERT INTO `grupo` (IDGrupo, Periodo, Aula, Turno, IDTutor, IDCarrera) values('null', '$Periodo', '$Aula', '$Turno', '$IDTutor', '$IDCarrera')";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));

echo'<script type="text/javascript">
            alert("Tu información ha sido almacenada");
            window.location.href="../administrar-grupo.php";
            </script>';

mysqli_close($mysqli);


?>