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

        //CONSULTA PARA OBTENER IDTUTORADO
        $sesionActual = $_SESSION['usuario']['IDUsuario'];
        $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $data=mysqli_fetch_assoc($ConsultaTutorado);
        $tutorado = $data['IDTutorado'];
        $tutorado2 = $data['IDTutorado'];

        //CONSULTA PARA OBTENER IDLINEAVIDA
        $ConsultaLineaVida = mysqli_query($mysqli,"SELECT IDLineaVida FROM `linea-vida` WHERE IDTutorado = '$tutorado'");
        $data2=mysqli_fetch_assoc($ConsultaLineaVida);
        $lineavida = $data2['IDLineaVida'];

        //CONSULTA PARA CONTAR ACONTECIMIENTOS
        $ContarAcontecimientos = mysqli_query($mysqli,"SELECT count(Acontecimiento) AS total FROM `acontecimientos` WHERE IDLineaVida = '$lineavida'");
        $data3=mysqli_fetch_assoc($ContarAcontecimientos);
        $TotalAcontecimientos = $data3['total'];

        //CONSULTA PARA ENVIAR DATOS
        $ActualizarAcontecimiento="INSERT INTO `linea-vida` (IDLineaVida, TotalAcontecimientos) VALUES ($lineavida, $TotalAcontecimientos)
        ON DUPLICATE KEY UPDATE TotalAcontecimientos=$TotalAcontecimientos";
        mysqli_query($mysqli, $ActualizarAcontecimiento) or die (mysqli_error($mysqli));

        $Tecnicas="UPDATE `resultados-parciales` SET LineaVida='1' WHERE IDTutorado = $tutorado2";
         mysqli_query($mysqli,$Tecnicas) or die (mysqli_error($mysqli));

        echo'<script type="text/javascript">
            window.location.href="../../consultas/calcular-resultados-finales-lineavida.php";
            </script>';
        mysqli_close($mysqli);

?>