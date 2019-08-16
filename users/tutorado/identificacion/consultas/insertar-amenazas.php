<?php
session_start();

    if(isset($_SESSION['usuario'])){
       /*if($_SESSION['usuario']['UsuarioTipo'] == 2 ){
            header('Location: ../coordinador/');
        }else if($_SESSION['usuario']['UsuarioTipo'] == 3 ){
            header('Location: ../tutor/');
        }else if($_SESSION['usuario']['UsuarioTipo'] == 1 ){
            header('Location: ../administrador/');
        }*/
    }else{
            /*header('location: ../../../');*/
        }  

       
    try{
        require_once("../../../../php/conexion.php"); //enlazar el archivo de conexion        
        }catch(Exception $e){
            $error = $e->getMessage(); //usar funcion de mysqli para capturar el error e imprimirlo
        }

//Acontecimiento1

if (isset($_POST['Amenazas1'])) {
$Amenazas1=$_POST['Amenazas1'];
}

if (isset($_POST['Amenazas2'])) {
$Amenazas2=$_POST['Amenazas2'];
}

if (isset($_POST['Amenazas3'])) {
$Amenazas3=$_POST['Amenazas3'];
}

if (isset($_POST['Amenazas4'])) {
$Amenazas4=$_POST['Amenazas4'];
}

if (isset($_POST['notificacion'])) {
$notificacion=$_POST['notificacion'];
}

if (isset($_POST['edo_notificacion'])) {
$edo_notificacion=$_POST['edo_notificacion'];
}

if (isset($_POST['IDTutorado4'])) {
$IDTutorado4=$_POST['IDTutorado4'];
}


//CONSULTA PARA OBTENER IDTUTORADO
        $sesionActual = $_SESSION['usuario']['IDUsuario'];
        $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $data=mysqli_fetch_assoc($ConsultaTutorado);
        $tutorado = $data['IDTutorado'];
//CONSULTA PARA OBTENER IDLINEAVIDA
        $ConsultaLineaVida = mysqli_query($mysqli,"SELECT * FROM `foda` WHERE IDTutorado = '$tutorado'");
        $data2=mysqli_fetch_assoc($ConsultaLineaVida);
        $foda = $data2['IDFODA'];
        $fodaT = $data2['IDTutorado'];
        $fortaleza1 = $data2['Fortaleza1'];
        $oportunidad1 = $data2['Oportunidad1'];
        $debilidad1 = $data2['Debilidad1'];
        $amenaza1 = $data2['Amenaza1'];
        
    if(!empty($fortaleza1 != "" && $oportunidad1 !="" && $debilidad1 != "" )){
    $Notificacion="INSERT INTO `Notificaciones` (IDNotificacion, Titulo, Descripcion, IDIcono, edo_notificacion, IDTutorado) values('null', 'null', '$notificacion', 'null', '$edo_notificacion', '$tutorado')";
    mysqli_query($mysqli,$Notificacion) or die (mysqli_error($mysqli));           
    }else{
            
    }
   
if ($tutorado = $fodaT) {

	 $Amenazas="UPDATE `foda` SET Amenaza1='$Amenazas1', Amenaza2='$Amenazas2', Amenaza3 = '$Amenazas3', Amenaza4 ='$Amenazas4' WHERE IDFODA = $foda";
	 mysqli_query($mysqli,$Amenazas) or die (mysqli_error($mysqli));
	 echo'<script type="text/javascript">
    alert("Se guardó la información, clic en aceptar para continuar.");
    window.location.href="../foda-iniciado.php";
    </script>';

} else {
  $Amenazas="INSERT INTO `foda` (IDFODA, Amenaza1, Amenaza2, Amenaza3, Amenaza4, IDTutorado) VALUES ('NULL', '$Amenazas1', '$Amenazas2', '$Amenazas3', '$Amenazas4', '$IDTutorado4')";
	mysqli_query($mysqli,$Amenazas) or die (mysqli_error($mysqli));
	echo'<script type="text/javascript">
    alert("Se guardó la información, clic en aceptar para continuar");
    window.location.href="../foda-iniciado.php";
    </script>';
	mysqli_close($mysqli);		
}



/*
//consulta15
$fortaleza="INSERT INTO `foda` (IDFODA, Fortaleza1, Fortaleza2, Fortaleza3, Fortaleza4, IDTutorado) VALUES ('NULL', '$Fortaleza1', '$Fortaleza2', '$Fortaleza3', '$Fortaleza4', '$tutorado') 
	ON DUPLICATE KEY UPDATE Fortaleza1=$Fortaleza1, Fortaleza2=$Fortaleza2, Fortaleza3=$Fortaleza3, Fortaleza4=$Fortaleza4, IDTutorado=$tutorado ";
mysqli_query($mysqli,$fortaleza) or die (mysqli_error($mysqli));
echo'<script type="text/javascript">
    alert("Se guardó la información, clic en aceptar para continuar");
    window.location.href="../foda.php#step-2";
    </script>';
mysqli_close($mysqli);

*/

?>