<?php

require('../../../../php/conexion.php');

if (isset($_POST['actualizar_notificacion'])) {
$actualizar_notificacion=$_POST['actualizar_notificacion'];
}

//IDTutorado
if (isset($_POST['TutoradoN'])) {
$TutoradoN=$_POST['TutoradoN'];
}


//Consulta1

$mysql="UPDATE `Notificaciones` SET `edo_notificacion` = '$actualizar_notificacion' WHERE IDTutorado = '$TutoradoN' AND Descripcion = 'Trofeo-Autoestima desbloqueado' ";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));

echo'<script type="text/javascript">
        window.location.href="../index.php";
        </script>';
mysqli_close($mysqli)



?>