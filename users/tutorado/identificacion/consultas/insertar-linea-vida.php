<?php

require('../../../../php/conexion.php');

//Acontecimiento1

if (isset($_POST['acontecimiento1'])) {
$acontecimiento1=$_POST['acontecimiento1'];
}

if (isset($_POST['edad1'])) {
$edad1=$_POST['edad1'];
}

if (isset($_POST['impacto1'])) {
$impacto1=$_POST['impacto1'];
}


//Acontecimiento2

if (isset($_POST['acontecimiento2'])) {
$acontecimiento2=$_POST['acontecimiento2'];
}

if (isset($_POST['edad2'])) {
$edad2=$_POST['edad2'];
}

if (isset($_POST['impacto2'])) {
$impacto2=$_POST['impacto2'];
}

//Acontecimiento3

if (isset($_POST['acontecimiento3'])) {
$acontecimiento3=$_POST['acontecimiento3'];
}

if (isset($_POST['edad3'])) {
$edad3=$_POST['edad3'];
}

if (isset($_POST['impacto3'])) {
$impacto3=$_POST['impacto3'];
}

//Acontecimiento4

if (isset($_POST['acontecimiento4'])) {
$acontecimiento4=$_POST['acontecimiento4'];
}

if (isset($_POST['edad4'])) {
$edad4=$_POST['edad4'];
}

if (isset($_POST['impacto4'])) {
$impacto4=$_POST['impacto4'];
}

//Acontecimiento5

if (isset($_POST['acontecimiento5'])) {
$acontecimiento5=$_POST['acontecimiento5'];
}

if (isset($_POST['edad5'])) {
$edad5=$_POST['edad5'];
}

if (isset($_POST['impacto5'])) {
$impacto5=$_POST['impacto5'];
}

//Acontecimiento6

if (isset($_POST['acontecimiento6'])) {
$acontecimiento6=$_POST['acontecimiento6'];
}

if (isset($_POST['edad6'])) {
$edad6=$_POST['edad6'];
}

if (isset($_POST['impacto6'])) {
$impacto6=$_POST['impacto6'];
}

//Acontecimiento7

if (isset($_POST['acontecimiento7'])) {
$acontecimiento7=$_POST['acontecimiento7'];
}

if (isset($_POST['edad7'])) {
$edad7=$_POST['edad7'];
}

if (isset($_POST['impacto7'])) {
$impacto7=$_POST['impacto7'];
}

//Acontecimiento8

if (isset($_POST['acontecimiento8'])) {
$acontecimiento8=$_POST['acontecimiento8'];
}

if (isset($_POST['edad8'])) {
$edad8=$_POST['edad8'];
}

if (isset($_POST['impacto8'])) {
$impacto8=$_POST['impacto8'];
}

//Acontecimiento9

if (isset($_POST['acontecimiento9'])) {
$acontecimiento9=$_POST['acontecimiento9'];
}

if (isset($_POST['edad9'])) {
$edad9=$_POST['edad9'];
}

if (isset($_POST['impacto9'])) {
$impacto9=$_POST['impacto9'];
}

//Acontecimiento10

if (isset($_POST['acontecimiento10'])) {
$acontecimiento10=$_POST['acontecimiento10'];
}

if (isset($_POST['edad10'])) {
$edad10=$_POST['edad10'];
}

if (isset($_POST['impacto10'])) {
$impacto10=$_POST['impacto10'];
}
/*
//Acontecimiento11

if (isset($_POST['acontecimiento11'])) {
$acontecimiento11=$_POST['acontecimiento11'];
}

if (isset($_POST['edad11'])) {
$edad11=$_POST['edad11'];
}

if (isset($_POST['impacto11'])) {
$impacto11=$_POST['impacto11'];
}

//Acontecimiento12

if (isset($_POST['acontecimiento12'])) {
$acontecimiento12=$_POST['acontecimiento12'];
}

if (isset($_POST['edad12'])) {
$edad12=$_POST['edad12'];
}

if (isset($_POST['impacto12'])) {
$impacto12=$_POST['impacto12'];
}

//Acontecimiento13

if (isset($_POST['acontecimiento13'])) {
$acontecimiento13=$_POST['acontecimiento13'];
}

if (isset($_POST['edad13'])) {
$edad13=$_POST['edad13'];
}

if (isset($_POST['impacto13'])) {
$impacto13=$_POST['impacto13'];
}

//Acontecimiento14

if (isset($_POST['acontecimiento14'])) {
$acontecimiento14=$_POST['acontecimiento14'];
}

if (isset($_POST['edad14'])) {
$edad14=$_POST['edad14'];
}

if (isset($_POST['impacto14'])) {
$impacto14=$_POST['impacto14'];
}

//Acontecimiento15

if (isset($_POST['acontecimiento15'])) {
$acontecimiento15=$_POST['acontecimiento15'];
}

if (isset($_POST['edad15'])) {
$edad15=$_POST['edad15'];
}

if (isset($_POST['impacto15'])) {
$impacto15=$_POST['impacto15'];
}
*/

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

//consulta principal

$mysql="INSERT INTO `linea-vida` (IDLineaVida, IDTutorado) values('null', '$IDTutorado')";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));
$ultimo_insert = mysqli_insert_id($mysqli);

//consulta1
$mysql1="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad1', '$acontecimiento1', '$impacto1', '$ultimo_insert')";
mysqli_query($mysqli,$mysql1) or die (mysqli_error($mysqli));

//consulta2
$mysql2="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad2', '$acontecimiento2', '$impacto2', '$ultimo_insert')";
mysqli_query($mysqli,$mysql2) or die (mysqli_error($mysqli));

//consulta3
$mysql3="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad3', '$acontecimiento3', '$impacto3', '$ultimo_insert')";
mysqli_query($mysqli,$mysql3) or die (mysqli_error($mysqli));

//consulta4
$mysql4="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad4', '$acontecimiento4', '$impacto4', '$ultimo_insert')";
mysqli_query($mysqli,$mysql4) or die (mysqli_error($mysqli));

//consulta5
$mysql5="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad5', '$acontecimiento5', '$impacto5', '$ultimo_insert')";
mysqli_query($mysqli,$mysql5) or die (mysqli_error($mysqli));

//consulta6
$mysql6="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad6', '$acontecimiento3', '$impacto3', '$ultimo_insert')";
mysqli_query($mysqli,$mysql6) or die (mysqli_error($mysqli));

//consulta7
$mysql7="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad7', '$acontecimiento7', '$impacto7', '$ultimo_insert')";
mysqli_query($mysqli,$mysql7) or die (mysqli_error($mysqli));

//consulta8
$mysql8="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad8', '$acontecimiento8', '$impacto8', '$ultimo_insert')";
mysqli_query($mysqli,$mysql8) or die (mysqli_error($mysqli));

//consulta9
$mysql9="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad9', '$acontecimiento9', '$impacto9', '$ultimo_insert')";
mysqli_query($mysqli,$mysql9) or die (mysqli_error($mysqli));

//consulta10
$mysql10="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad10', '$acontecimiento10', '$impacto10', '$ultimo_insert')";
mysqli_query($mysqli,$mysql10) or die (mysqli_error($mysqli));

/*

//consulta11
$mysql11="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad11', '$acontecimiento11', '$impacto11', '$ultimo_insert')";
mysqli_query($mysqli,$mysql11) or die (mysqli_error($mysqli));

//consulta12
$mysql12="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad12', '$acontecimiento12', '$impacto12', '$ultimo_insert')";
mysqli_query($mysqli,$mysql12) or die (mysqli_error($mysqli));

//consulta13
$mysql13="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad13', '$acontecimiento13', '$impacto13', '$ultimo_insert')";
mysqli_query($mysqli,$mysql13) or die (mysqli_error($mysqli));

//consulta14
$mysql14="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad14', '$acontecimiento14', '$impacto14', '$ultimo_insert')";
mysqli_query($mysqli,$mysql14) or die (mysqli_error($mysqli));

//consulta15
$mysql15="INSERT INTO `acontecimientos` (`IDAcontecimiento`, Edad, Acontecimiento, Impacto, IDLineaVida) 
values('null', '$edad15', '$acontecimiento15', '$impacto15', '$ultimo_insert')";
mysqli_query($mysqli,$mysql15) or die (mysqli_error($mysqli));

*/

$Notificacion="INSERT INTO `Notificaciones` (IDNotificacion, Titulo, Descripcion, IDIcono, edo_notificacion, IDTutorado) values('null', 'null', '$notificacion', 'null', '$edo_notificacion', '$IDTutorado')";
mysqli_query($mysqli,$Notificacion) or die (mysqli_error($mysqli)); 


echo'<script type="text/javascript">
    alert("Se guardó la información, clic en aceptar para continuar");
    window.location.href="contar-acontecimientos-linea-vida.php";
    </script>';
mysqli_close($mysqli);

?>