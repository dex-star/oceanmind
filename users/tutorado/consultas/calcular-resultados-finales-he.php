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

        $consulta = mysqli_query($mysqli,"SELECT * FROM `resultados-parciales` WHERE IDTutorado = '$tutorado' ");
        $data2=mysqli_fetch_assoc($consulta);
        $ficharegistro = $data2['RegistroFichaID'];
        $lineavida = $data2['LineaVida'];
        $foda = $data2['FODA'];
        $testestilosaprendizaje = $data2['TestEstilosAprendizaje'];
        $testlogica = $data2['TestLogica'];
        $testautoestima = $data2['TestAutoestima'];
        $habilidadesestudio = $data2['HabilidadesEstudio'];
        $testasertividad = $data2['TestAsertividad'];

        $resultadoDesarrolloHumano = $testasertividad + $habilidadesestudio + $testautoestima;

        $resultadoFortalecimiento = 0;

        $resultadoIdentificacion = $lineavida + $foda + $testestilosaprendizaje + $ficharegistro;

        $resultadoHabilidadPensamiento = $testlogica;

        $resultado = $resultadoDesarrolloHumano + $resultadoFortalecimiento + $resultadoIdentificacion + $resultadoHabilidadPensamiento;

        $Tecnicas="UPDATE `resultados-generales` SET Identificacion='$resultadoIdentificacion', DesarrolloHumano = '$resultadoDesarrolloHumano', HabilidadesPensamiento = '$resultadoHabilidadPensamiento', Fortalecimiento = '$resultadoFortalecimiento', AvanceGeneral = '$resultado' WHERE IDTutorado = '$tutorado2'";
            mysqli_query($mysqli,$Tecnicas) or die (mysqli_error($mysqli));

        header("location: ../desarrollo-humano/index-trofeo.php")


        
?>