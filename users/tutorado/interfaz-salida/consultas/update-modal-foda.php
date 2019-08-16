<?php

require('../../../../php/conexion.php');

//IDTutorado
if (isset($_POST['TutoradoN'])) {
$TutoradoN=$_POST['TutoradoN'];
}


//Consulta1

$mysql="UPDATE `Notificaciones` SET `edo_notificacion` = '1' WHERE IDTutorado = '$TutoradoN' AND Descripcion = 'Trofeo-FODA desbloqueado' AND edo_notificacion='0' ";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));

echo'<script type="text/javascript">
        window.location.href="../foda.php";
        </script>';
mysqli_close($mysqli)



?>