<?php

require('../../../../php/conexion.php');

//Variables parte 1

if (isset($_POST['P1'])) {
$P1=$_POST['P1'];
}

if (isset($_POST['P2'])) {
$P2=$_POST['P2'];
}

if (isset($_POST['P3'])) {
$P3=$_POST['P3'];
}

if (isset($_POST['P4'])) {
$P4=$_POST['P4'];
}

if (isset($_POST['P5'])) {
$P5=$_POST['P5'];
}

if (isset($_POST['P6'])) {
$P6=$_POST['P6'];
}

if (isset($_POST['P7'])) {
$P7=$_POST['P7'];
}

if (isset($_POST['P8'])) {
$P8=$_POST['P8'];
}

if (isset($_POST['P9'])) {
$P9=$_POST['P9'];
}

if (isset($_POST['notificacion'])) {
$notificacion=$_POST['notificacion'];
}

if (isset($_POST['edo_notificacion'])) {
$edo_notificacion=$_POST['edo_notificacion'];
}

//IDTutorado

if (isset($_POST['IDTutorado'])) {
$IDTutorado=$_POST['IDTutorado'];
}

//Consulta1

$mysql="INSERT INTO `test-asertividad` (IDTestAsertividad, P1, P2, P3, P4, P5, P6, P7, P8, P9, IDTutorado) values('null','$P1', '$P2', '$P3', '$P4', '$P5', '$P6', '$P7', '$P8', '$P9', '$IDTutorado')";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));


$Notificacion="INSERT INTO `Notificaciones` (IDNotificacion, Titulo, Descripcion, IDIcono, edo_notificacion, IDTutorado) values('null', 'null', '$notificacion', 'null', '$edo_notificacion', '$IDTutorado')";
mysqli_query($mysqli,$Notificacion) or die (mysqli_error($mysqli)); 

echo'<script type="text/javascript">
        alert("Se guardó la información, clic en aceptar para continuar.");
        window.location.href="contar-asertividad.php";
        </script>';
mysqli_close($mysqli)




//consulta2


?>