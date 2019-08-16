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

//TECNICAS ESTUDIO

if (isset($_POST['P21'])) {
$P21=$_POST['P21'];
}

if (isset($_POST['P22'])) {
$P22=$_POST['P22'];
}

if (isset($_POST['P23'])) {
$P23=$_POST['P23'];
}

if (isset($_POST['P24'])) {
$P24=$_POST['P24'];
}

if (isset($_POST['P25'])) {
$P25=$_POST['P25'];
}

if (isset($_POST['P26'])) {
$P26=$_POST['P26'];
}

if (isset($_POST['P27'])) {
$P27=$_POST['P27'];
}

if (isset($_POST['P28'])) {
$P28=$_POST['P28'];
}

if (isset($_POST['P29'])) {
$P29=$_POST['P29'];
}

if (isset($_POST['P30'])) {
$P30=$_POST['P30'];
}

if (isset($_POST['P31'])) {
$P31=$_POST['P31'];
}

if (isset($_POST['P32'])) {
$P32=$_POST['P32'];
}

if (isset($_POST['P33'])) {
$P33=$_POST['P33'];
}

if (isset($_POST['P34'])) {
$P34=$_POST['P34'];
}

if (isset($_POST['P35'])) {
$P35=$_POST['P35'];
}

if (isset($_POST['P36'])) {
$P36=$_POST['P36'];
}

if (isset($_POST['P37'])) {
$P37=$_POST['P37'];
}

if (isset($_POST['P38'])) {
$P38=$_POST['P38'];
}

if (isset($_POST['P39'])) {
$P39=$_POST['P39'];
}

if (isset($_POST['P40'])) {
$P40=$_POST['P40'];
}

//MOTIVACION PARA EL ESTUDIO

if (isset($_POST['P41'])) {
$P41=$_POST['P41'];
}

if (isset($_POST['P42'])) {
$P42=$_POST['P42'];
}

if (isset($_POST['P43'])) {
$P43=$_POST['P43'];
}

if (isset($_POST['P44'])) {
$P44=$_POST['P44'];
}

if (isset($_POST['P45'])) {
$P45=$_POST['P45'];
}

if (isset($_POST['P46'])) {
$P46=$_POST['P46'];
}

if (isset($_POST['P47'])) {
$P47=$_POST['P47'];
}

if (isset($_POST['P48'])) {
$P48=$_POST['P48'];
}

if (isset($_POST['P49'])) {
$P49=$_POST['P49'];
}

if (isset($_POST['P50'])) {
$P50=$_POST['P50'];
}

if (isset($_POST['P51'])) {
$P51=$_POST['P51'];
}

if (isset($_POST['P52'])) {
$P52=$_POST['P52'];
}

if (isset($_POST['P53'])) {
$P53=$_POST['P53'];
}

if (isset($_POST['P54'])) {
$P54=$_POST['P54'];
}

if (isset($_POST['P55'])) {
$P55=$_POST['P55'];
}

if (isset($_POST['P56'])) {
$P56=$_POST['P56'];
}

if (isset($_POST['P57'])) {
$P57=$_POST['P57'];
}

if (isset($_POST['P58'])) {
$P58=$_POST['P58'];
}

if (isset($_POST['P59'])) {
$P59=$_POST['P59'];
}

if (isset($_POST['P60'])) {
$P60=$_POST['P60'];
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

//Consulta1
$mysql="INSERT INTO `habilidades-estudio` (IDHabilidadesEstudio, IDTutorado) values('null', '$IDTutorado')";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));
$ultimo_insert = mysqli_insert_id($mysqli);

$mysql1="INSERT INTO `he-organizacion-estudio` (`ID-HE-OE`, P1, P2, P3, P4, P5, P6, P7, P8, P9, P10, P11, P12, P13, P14, P15, P16, P17, P18, P19, P20, IDHabilidadesEstudio) values('null', '$P1', '$P2', '$P3', '$P4', '$P5', '$P6', '$P7', '$P8', '$P9', '$P10', '$P11', '$P12', '$P13', '$P14', '$P15', '$P16', '$P17', '$P18', '$P19', '$P20', '$ultimo_insert')";
mysqli_query($mysqli,$mysql1) or die (mysqli_error($mysqli));

$mysql2="INSERT INTO `he-tecnicas-estudio` (`ID-HE-TE`, P1, P2, P3, P4, P5, P6, P7, P8, P9, P10, P11, P12, P13, P14, P15, P16, P17, P18, P19, P20, IDHabilidadesEstudio) values('null', '$P21', '$P22', '$P23', '$P24', '$P25', '$P26', '$P27', '$P28', '$P29', '$P30', '$P31', '$P32', '$P33', '$P34', '$P35', '$P36', '$P37', '$P38', '$P39', '$P40', '$ultimo_insert')";
mysqli_query($mysqli,$mysql2) or die (mysqli_error($mysqli));

$mysql3="INSERT INTO `he-motivacion-estudio` (`ID-HE-ME`, P1, P2, P3, P4, P5, P6, P7, P8, P9, P10, P11, P12, P13, P14, P15, P16, P17, P18, P19, P20, IDHabilidadesEstudio) values('null', '$P41', '$P42', '$P43', '$P44', '$P45', '$P46', '$P47', '$P48', '$P49', '$P50', '$P51', '$P52', '$P53', '$P54', '$P55', '$P56', '$P57', '$P58', '$P59', '$P60', '$ultimo_insert')";
mysqli_query($mysqli,$mysql3) or die (mysqli_error($mysqli));

$Tecnicas="UPDATE `resultados-parciales` SET TestAsertividad='1' WHERE IDTutorado = $IDTutorado";
         mysqli_query($mysqli,$Tecnicas) or die (mysqli_error($mysqli));
         
$Notificacion="INSERT INTO `Notificaciones` (IDNotificacion, Titulo, Descripcion, IDIcono, edo_notificacion, IDTutorado) values('null', 'null', '$notificacion', 'null', '$edo_notificacion', '$IDTutorado')";
mysqli_query($mysqli,$Notificacion) or die (mysqli_error($mysqli));     

$Notificacion2="INSERT INTO `Notificaciones` (IDNotificacion, Titulo, Descripcion, IDIcono, edo_notificacion, IDTutorado) values('null', 'null', '$notificacion2', 'null', '$edo_notificacion2', '$IDTutorado')";
mysqli_query($mysqli,$Notificacion2) or die (mysqli_error($mysqli));    

echo'<script type="text/javascript">
            alert("Tu información ha sido almacenada");
            window.location.href="contar-reactivos-he.php";
            </script>';

mysqli_close($mysqli);


?>