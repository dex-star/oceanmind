<?php

session_start();

    if(isset($_SESSION['usuario'])){
       if($_SESSION['usuario']['UsuarioTipo'] == 2 ){
            header('Location: ../coordinador/');
        }else if($_SESSION['usuario']['UsuarioTipo'] == 3 ){
            header('Location: ../tutor/');
        }else if($_SESSION['usuario']['UsuarioTipo'] == 1 ){
            header('Location: ../administrador/');
        }
    }else{
            header('location: ../../../');
        }  

       
    try{
        require_once("../../../php/conexion.php"); //enlazar el archivo de conexion        
        }catch(Exception $e){
            $error = $e->getMessage(); //usar funcion de mysqli para capturar el error e imprimirlo
        }

//ORGANIZACION ESTUDIO

//CONSULTA PARA OBTENER IDTUTORADO
        $sesionActual = $_SESSION['usuario']['IDUsuario'];
        $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $data3=mysqli_fetch_assoc($ConsultaTutorado);
        $tutorado = $data3['IDTutorado'];
        $tutorado2 = $data3['IDTutorado'];

//CONSULTA PARA OBTENER RESULTADOS GENERALES
        $ConsultaGenerales = mysqli_query($mysqli,"SELECT IDTutorado FROM `resultados-generales` WHERE IDTutorado = '$tutorado'");
        $data2=mysqli_fetch_assoc($ConsultaGenerales);
        //$foda = $data2['IDFODA'];
        $generalIDTutorado = $data2['IDTutorado'];

        //CONSULTA PARA OBTENER RESULTADOS PARCIALES
        $ConsultaParciales = mysqli_query($mysqli,"SELECT IDTutorado FROM `resultados-parciales` WHERE IDTutorado = '$tutorado'");
        $data=mysqli_fetch_assoc($ConsultaParciales);
        //$foda = $data2['IDFODA'];
        $parcialIDTutorado = $data['IDTutorado'];


if ($tutorado = $generalIDTutorado && $tutorado = $parcialIDTutorado) {
	header('Location: ../general/general.php');
} else {

  $general="INSERT INTO `resultados-generales` (IDResultadosParciales, Identificacion, DesarrolloHumano, HabilidadesPensamiento, Fortalecimiento, AvanceGeneral, IDTutorado) VALUES ('NULL', '0', '0', '0', '0', '0', '$tutorado2')";
	mysqli_query($mysqli,$general) or die (mysqli_error($mysqli));
  $parciales="INSERT INTO `resultados-parciales` (IDResultados, RegistroFichaID, LineaVida, FODA, TestEstilosAprendizaje, TestLogica, TestAutoestima, HabilidadesEstudio, TestAsertividad, IDTutorado) VALUES ('NULL', '0', '0', '0', '0', '0', '0', '0', '0', '$tutorado2')";
	mysqli_query($mysqli,$parciales) or die (mysqli_error($mysqli));
	mysqli_close($mysqli);
    
}

    header('Location: ../general/general.php'); 


?>