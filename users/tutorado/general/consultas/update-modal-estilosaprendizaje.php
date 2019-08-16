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

$mysql="UPDATE `Notificaciones` SET `edo_notificacion` = '1' WHERE IDTutorado = '$TutoradoN' AND Descripcion = 'Trofeo-EstilosDeAprendizaje desbloqueado' ";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));

echo'<script type="text/javascript">
        window.location.href="../Estilos-aprendizaje2.php";
        </script>';
mysqli_close($mysqli)



?>