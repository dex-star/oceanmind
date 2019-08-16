<?php

require('../../../../php/conexion.php');

//Variables parte 1

if (isset($_POST['EstadoCivil'])) {
$EstadoCivil=$_POST['EstadoCivil'];
}

if (isset($_POST['LugarOrigen'])) {
$LugarOrigen=$_POST['LugarOrigen'];
}

if (isset($_POST['TelefonoCasa'])) {
$TelefonoCasa=$_POST['TelefonoCasa'];
}

if (isset($_POST['TelefonoCelular'])) {
$TelefonoCelular=$_POST['TelefonoCelular'];
}

if (isset($_POST['DomicilioEstudiante'])) {
$DomicilioEstudiante=$_POST['DomicilioEstudiante'];
}

if (isset($_POST['DomicilioFamilia'])) {
$DomicilioFamilia=$_POST['DomicilioFamilia'];
}

if (isset($_POST['Trabajas'])) {
$Trabajas=$_POST['Trabajas'];
}

if (isset($_POST['LugarTrabajo'])) {
$LugarTrabajo=$_POST['LugarTrabajo'];
}

if (isset($_POST['DomicilioTrabajo'])) {
$DomicilioTrabajo=$_POST['DomicilioTrabajo'];
}

if (isset($_POST['TelefonoTrabajo'])) {
$TelefonoTrabajo=$_POST['TelefonoTrabajo'];
}

if (isset($_POST['Hijos'])) {
$Hijos=$_POST['Hijos'];
}

if (isset($_POST['NumeroHijos'])) {
$NumeroHijos=$_POST['NumeroHijos'];
}

if (isset($_POST['VivirFamiliares'])) {
$VivirFamiliares=$_POST['VivirFamiliares'];
}

if (isset($_POST['ParentescoFamiliar'])) {
$ParentescoFamiliar=$_POST['ParentescoFamiliar'];
}

if (isset($_POST['NombreTutorLegal'])) {
$NombreTutorLegal=$_POST['NombreTutorLegal'];
}

if (isset($_POST['DomicilioTutorLegal'])) {
$DomicilioTutorLegal=$_POST['DomicilioTutorLegal'];
}

if (isset($_POST['Ciudad'])) {
$Ciudad=$_POST['Ciudad'];
}

if (isset($_POST['Ocupacion'])) {
$Ocupacion=$_POST['Ocupacion'];
}

if (isset($_POST['LugarEmpleo'])) {
$LugarEmpleo=$_POST['LugarEmpleo'];
}

if (isset($_POST['Horario'])) {
$Horario=$_POST['Horario'];
}

if (isset($_POST['Celular'])) {
$Celular=$_POST['Celular'];
}

// Variables parte 3

if (isset($_POST['IDPreparatoria'])) {
$IDPreparatoria=$_POST['IDPreparatoria'];
}

if (isset($_POST['IDEspecialidad'])) {
$IDEspecialidad=$_POST['IDEspecialidad'];
}

if (isset($_POST['PromedioObtenido'])) {
$PromedioObtenido=$_POST['PromedioObtenido'];
}

if (isset($_POST['PrimariaRepetida'])) {
$PrimariaRepetida=$_POST['PrimariaRepetida'];
}

if (isset($_POST['SecundariaRepetida'])) {
$SecundariaRepetida=$_POST['SecundariaRepetida'];
}

if (isset($_POST['PrepaRepetida'])) {
$PrepaRepetida=$_POST['PrepaRepetida'];
}

if (isset($_POST['MateriasDificultad'])) {
$MateriasDificultad=$_POST['MateriasDificultad'];
}

// Variables parte 2

if (isset($_POST['ExpectativaUniversidad'])) {
$ExpectativaUniversidad=$_POST['ExpectativaUniversidad'];
}

if (isset($_POST['ExpectativaCarrera'])) {
$ExpectativaCarrera=$_POST['ExpectativaCarrera'];
}

if (isset($_POST['ExpectavidaTutoria'])) {
$ExpectavidaTutoria=$_POST['ExpectavidaTutoria'];
}

if (isset($_POST['ExpectativaGraduarse'])) {
$ExpectativaGraduarse=$_POST['ExpectativaGraduarse'];
}

if (isset($_POST['CompromisoTutorado'])) {
$CompromisoTutorado=$_POST['CompromisoTutorado'];
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

$mysql="INSERT INTO `ficha-datos-personales` (IDDatosPersonales, EstadoCivil, LugarOrigen, TelefonoCasa, TelefonoCelular, DomicilioEstudiante, DomicilioFamilia, Trabajas, LugarTrabajo, DomicilioTrabajo, TelefonoTrabajo, Hijos, NumeroHijos, VivirFamiliares, ParentescoFamiliar, NombreTutorLegal, DomicilioTutorLegal, Ciudad, Ocupacion, LugarEmpleo, Horario, Celular, IDTutorado) values('null','$EstadoCivil', '{$LugarOrigen}', '$TelefonoCasa', '$TelefonoCelular', '{$DomicilioEstudiante}', '{$DomicilioFamilia}', '$Trabajas', '{$LugarTrabajo}' ,'{$DomicilioTrabajo}', '$TelefonoTrabajo', '$NumeroHijos', '$Hijos', '$VivirFamiliares', '$ParentescoFamiliar', '{$NombreTutorLegal}', '{$DomicilioTutorLegal}', '{$Ciudad}', '{$Ocupacion}', '{$LugarEmpleo}', '{$Horario}', '$Celular', '$IDTutorado')";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));
$ultimo_insert = mysqli_insert_id($mysqli);

$mysql2="INSERT INTO `ficha-datos-tutoria` (IDDatosTutoria, ExpectativaUniversidad, ExpectativaCarrera, ExpectavidaTutoria, ExpectativaGraduarse, CompromisoTutorado, IDTutorado) values('null','{$ExpectativaUniversidad}', '{$ExpectativaCarrera}', '{$ExpectavidaTutoria}', '{$ExpectativaGraduarse}', '{$CompromisoTutorado}', '$IDTutorado')";
mysqli_query($mysqli,$mysql2) or die (mysqli_error($mysqli));
$ultimo_insert2 = mysqli_insert_id($mysqli);

$mysql4="INSERT INTO `ficha-datos-escolares` (IDDatosEscolares, IDPreparatoria, IDEspecialidad, PromedioObtenido, PrimariaRepetida, SecundariaRepetida, PrepaRepetida, MateriasDificultad, IDTutorado) values('null','{$IDPreparatoria}', '{$IDEspecialidad}', '$PromedioObtenido', '$PrimariaRepetida', '$SecundariaRepetida', '$PrepaRepetida', '{$MateriasDificultad}', '$IDTutorado')";
mysqli_query($mysqli,$mysql4) or die (mysqli_error($mysqli));
$ultimo_insert3 = mysqli_insert_id($mysqli);

$mysql3="INSERT INTO `ficha-identificacion` (IDFicha, IDDatosPersonales, IDDatosEscolares, IDDatosTutoria, IDTutorado) values('null', '$ultimo_insert', '$ultimo_insert3', '$ultimo_insert2', '$IDTutorado')";
mysqli_query($mysqli,$mysql3) or die (mysqli_error($mysqli));

$Tecnicas="UPDATE `resultados-parciales` SET RegistroFichaID='1' WHERE IDTutorado = $IDTutorado";
         mysqli_query($mysqli,$Tecnicas) or die (mysqli_error($mysqli));
         
$Notificacion="INSERT INTO `Notificaciones` (IDNotificacion, Titulo, Descripcion, IDIcono, edo_notificacion, IDTutorado) values('null', 'null', '$notificacion', 'null', '$edo_notificacion', '$IDTutorado')";
mysqli_query($mysqli,$Notificacion) or die (mysqli_error($mysqli));         

mysqli_close($mysqli);

echo'<script type="text/javascript">
		alert("Se guardó la información, clic en aceptar para continuar.");
        window.location.href="../../consultas/calcular-resultados-finales-dp.php";
        </script>';


//consulta2


?>