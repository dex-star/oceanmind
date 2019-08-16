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

$mysql="UPDATE usuarios SET Nickname = '$nickname' WHERE IDUsuario = '$IDUsuario'";
mysqli_query($mysqli,$mysql) or die (mysqli_error($mysqli));


echo'<script type="text/javascript">
        alert("Apodo actualizado correctamente");
        window.location.href="../general/actualizar-datos.php";
        </script>';
mysqli_close($mysqli)



?>