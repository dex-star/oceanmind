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

if (isset($_POST['Debilidades1'])) {
$Debilidades1=$_POST['Debilidades1'];
}

if (isset($_POST['Debilidades2'])) {
$Debilidades2=$_POST['Debilidades2'];
}

if (isset($_POST['Debilidades3'])) {
$Debilidades3=$_POST['Debilidades3'];
}

if (isset($_POST['Debilidades4'])) {
$Debilidades4=$_POST['Debilidades4'];
}

if (isset($_POST['notificacion'])) {
$notificacion=$_POST['notificacion'];
}

if (isset($_POST['edo_notificacion'])) {
$edo_notificacion=$_POST['edo_notificacion'];
}

if (isset($_POST['IDTutorado3'])) {
$IDTutorado3=$_POST['IDTutorado3'];
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
        
        if(!empty($fortaleza1 != "" && $oportunidad1 !="" && $amenaza1 != "" )){
           $Notificacion="INSERT INTO `Notificaciones` (IDNotificacion, Titulo, Descripcion, IDIcono, edo_notificacion, IDTutorado) values('null', 'null', '$notificacion', 'null', '$edo_notificacion', '$IDTutorado3')";
            mysqli_query($mysqli,$Notificacion) or die (mysqli_error($mysqli));           
        }else{
            
        }
   
	    
if ($tutorado = $fodaT) {

	 $Debilidades="UPDATE `foda` SET Debilidad1='$Debilidades1', Debilidad2='$Debilidades2', Debilidad3 = '$Debilidades3', Debilidad4 ='$Debilidades4' WHERE IDFODA = $foda";
	 mysqli_query($mysqli,$Debilidades) or die (mysqli_error($mysqli));
	 echo'<script type="text/javascript">
    alert("Se guardó la información, clic en aceptar para continuar.");
    window.location.href="../foda-iniciado.php";
    </script>';

} else {
  $Debilidades="INSERT INTO `foda` (IDFODA, Debilidad1, Debilidad2, Debilidad3, Debilidad4, IDTutorado) VALUES ('NULL', '$Debilidades1', '$Debilidades2', '$Debilidades3', '$Debilidades4', '$IDTutorado3')";
	mysqli_query($mysqli,$Debilidades) or die (mysqli_error($mysqli));
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