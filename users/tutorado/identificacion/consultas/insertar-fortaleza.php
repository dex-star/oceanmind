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

if (isset($_POST['Fortaleza1'])) {
$Fortaleza1=$_POST['Fortaleza1'];
}

if (isset($_POST['Fortaleza2'])) {
$Fortaleza2=$_POST['Fortaleza2'];
}

if (isset($_POST['Fortaleza3'])) {
$Fortaleza3=$_POST['Fortaleza3'];
}

if (isset($_POST['Fortaleza4'])) {
$Fortaleza4=$_POST['Fortaleza4'];
}

if (isset($_POST['notificacion'])) {
$notificacion=$_POST['notificacion'];
}

if (isset($_POST['edo_notificacion'])) {
$edo_notificacion=$_POST['edo_notificacion'];
}

if (isset($_POST['IDTutorado1'])) {
$IDTutorado1=$_POST['IDTutorado1'];
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

if(!empty($oportunidad1 != "" && $debilidad1 !="" && $amenaza1 != "" )){
   $Notificacion="INSERT INTO `Notificaciones` (IDNotificacion, Titulo, Descripcion, IDIcono, edo_notificacion, IDTutorado) values('null', 'null', '$notificacion', 'null', '$edo_notificacion', '$IDTutorado1')";
    mysqli_query($mysqli,$Notificacion) or die (mysqli_error($mysqli));           
}else{
    
}
	

if ($tutorado = $fodaT) {

	 $fortalezas="UPDATE `foda` SET Fortaleza1='$Fortaleza1', Fortaleza2='$Fortaleza2', Fortaleza3 = '$Fortaleza3', Fortaleza4 ='$Fortaleza4' WHERE IDFODA = $foda";
	 mysqli_query($mysqli,$fortalezas) or die (mysqli_error($mysqli));
	 echo'<script type="text/javascript">
    alert("Se guardó la información, clic en aceptar para continuar.");
    window.location.href="../foda.php";
    </script>';

} else {
  $fortaleza="INSERT INTO `foda` (IDFODA, Fortaleza1, Fortaleza2, Fortaleza3, Fortaleza4, IDTutorado) VALUES ('NULL', '$Fortaleza1', '$Fortaleza2', '$Fortaleza3', '$Fortaleza4', '$IDTutorado1')";
	mysqli_query($mysqli,$fortaleza) or die (mysqli_error($mysqli));
	echo'<script type="text/javascript">
    alert("Se guardó la información, clic en aceptar para continuar");
    window.location.href="../foda.php";
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