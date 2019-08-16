<?php

require('../../../php/conexion.php');

if (isset($_POST['newpass'])) {
$newpass=$_POST['newpass'];
}

if (isset($_POST['nickname'])) {
$nickname=$_POST['nickname'];
}

//IDTutorado

if (isset($_POST['IDUsuario'])) {
$IDUsuario=$_POST['IDUsuario'];
}


//Consulta1

$mysql="UPDATE usuarios SET Nickname = '$nickname', Password =MD5 ('$newpass') WHERE IDUsuario = '$IDUsuario'";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));


echo'<script type="text/javascript">
        alert("Contraseña actualizada, iniciar sesión de nuevo.");
        window.location.href="../../salir.php";
        </script>';
mysqli_close($mysqli)



?>