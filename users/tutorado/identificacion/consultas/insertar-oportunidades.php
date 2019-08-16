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

if (isset($_POST['Oportunidades1'])) {
$Oportunidades1=$_POST['Oportunidades1'];
}

if (isset($_POST['Oportunidades2'])) {
$Oportunidades2=$_POST['Oportunidades2'];
}

if (isset($_POST['Oportunidades3'])) {
$Oportunidades3=$_POST['Oportunidades3'];
}

if (isset($_POST['Oportunidades4'])) {
$Oportunidades4=$_POST['Oportunidades4'];
}

if (isset($_POST['notificacion'])) {
$notificacion=$_POST['notificacion'];
}

if (isset($_POST['edo_notificacion'])) {
$edo_notificacion=$_POST['edo_notificacion'];
}

if (isset($_POST['IDTutorado2'])) {
$IDTutorado2=$_POST['IDTutorado2'];
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
   

if(!empty($fortaleza1 != "" && $debilidad1 !="" && $amenaza1 != "" )){
   $Notificacion="INSERT INTO `Notificaciones` (IDNotificacion, Titulo, Descripcion, IDIcono, edo_notificacion, IDTutorado) values('null', 'null', '$notificacion', 'null', '$edo_notificacion', '$IDTutorado2')";
    mysqli_query($mysqli,$Notificacion) or die (mysqli_error($mysqli));           
}else{
    
}


if ($tutorado = $fodaT) {

	 $Oportunidades="UPDATE `foda` SET Oportunidad1='$Oportunidades1', Oportunidad2='$Oportunidades2', Oportunidad3 = '$Oportunidades3', Oportunidad4 ='$Oportunidades4' WHERE IDFODA = $foda";
	 mysqli_query($mysqli,$Oportunidades) or die (mysqli_error($mysqli));
	 echo'<script type="text/javascript">
    alert("Se guardó la información, clic en aceptar para continuar.");
    window.location.href="../foda-iniciado.php";
    </script>';

} else {
  $Oportunidades="INSERT INTO `foda` (IDFODA, Oportunidad1, Oportunidad2, Oportunidad3, Oportunidad4, IDTutorado) VALUES ('NULL', '$Oportunidades1', '$Oportunidades2', '$Oportunidades3', '$Oportunidades4', '$IDTutorado2')";
	mysqli_query($mysqli,$Oportunidades) or die (mysqli_error($mysqli));
	echo'<script type="text/javascript">
    alert("Se guardó la información, clic en aceptar para continuar.");
    window.location.href="../foda-iniciado.php";
    </script>';
	mysqli_close($mysqli);		
}


?>