<?php

require('../../../../php/conexion.php');

//ORGANIZACION ESTUDIO

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

if (isset($_POST['P10'])) {
$P10=$_POST['P10'];
}

if (isset($_POST['P11'])) {
$P11=$_POST['P11'];
}

if (isset($_POST['P12'])) {
$P12=$_POST['P12'];
}

if (isset($_POST['P13'])) {
$P13=$_POST['P13'];
}

if (isset($_POST['P14'])) {
$P14=$_POST['P14'];
}

if (isset($_POST['P15'])) {
$P15=$_POST['P15'];
}

if (isset($_POST['P16'])) {
$P16=$_POST['P16'];
}

if (isset($_POST['P17'])) {
$P17=$_POST['P17'];
}

if (isset($_POST['P18'])) {
$P18=$_POST['P18'];
}

if (isset($_POST['P19'])) {
$P19=$_POST['P19'];
}

if (isset($_POST['P20'])) {
$P20=$_POST['P20'];
}

if (isset($_POST['P21'])) {
$P21=$_POST['P21'];
}

if (isset($_POST['notificacion'])) {
$notificacion=$_POST['notificacion'];
}

if (isset($_POST['edo_notificacion'])) {
$edo_notificacion=$_POST['edo_notificacion'];
}

if (isset($_POST['notificacion2'])) {
$notificacion2=$_POST['notificacion2'];
}

if (isset($_POST['edo_notificacion2'])) {
$edo_notificacion2=$_POST['edo_notificacion2'];
}

//IDTutorado

if (isset($_POST['IDTutorado'])) {
$IDTutorado=$_POST['IDTutorado'];
}

$Visual = $P1 + $P3 + $P6 + $P9 + $P10 + $P11 + $P14;

$Auditivo = $P2 + $P5 + $P12 + $P15 + $P16 + $P18 + $P20;

$Kinestesico = $P4 + $P7 + $P8 + $P13 + $P17 + $P19 + $P21;

$Tecnicas="UPDATE `resultados-parciales` SET TestEstilosAprendizaje='1' WHERE IDTutorado = $IDTutorado";
         mysqli_query($mysqli,$Tecnicas) or die (mysqli_error($mysqli));

$mysql1="INSERT INTO `resultado-estilos-aprendizaje` (`IDResultado`, Visual, Auditivo, Kinestesico, IDTutorado) values('null', '$Visual', '$Auditivo', $Kinestesico, $IDTutorado)";
mysqli_query($mysqli,$mysql1) or die (mysqli_error($mysqli));

$Notificacion1="INSERT INTO `Notificaciones` (IDNotificacion, Titulo, Descripcion, IDIcono, edo_notificacion, IDTutorado) values('null', 'null', '$notificacion', 'null', '$edo_notificacion', '$IDTutorado')";
mysqli_query($mysqli,$Notificacion1) or die (mysqli_error($mysqli));

$Notificacion2="INSERT INTO `Notificaciones` (IDNotificacion, Titulo, Descripcion, IDIcono, edo_notificacion, IDTutorado) values('null', 'null', '$notificacion2', 'null', '$edo_notificacion2', '$IDTutorado')";
mysqli_query($mysqli,$Notificacion2) or die (mysqli_error($mysqli));


echo'<script type="text/javascript">
            alert("Se guardó la información, clic en aceptar para continuar.");
            window.location.href="../../consultas/calcular-resultados-finales-ea.php";
            </script>';

mysqli_close($mysqli);


?>