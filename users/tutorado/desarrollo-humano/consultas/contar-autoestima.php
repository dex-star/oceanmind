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

        //CONSULTA PARA OBTENER IDTUTORADO
        $ConsultaUP = mysqli_query($mysqli,"SELECT IDResultadoTestAuto FROM `test-autoestima` WHERE IDTutorado = '$tutorado' ");
        $data6=mysqli_fetch_assoc($ConsultaUP);
        $IDResultado = $data6['IDResultadoTestAuto'];



        //CONTAR UNOS
        $contador1 = 0;
        $contador2 = 0;
        $contador3 = 0;
        $contador4 = 0;
        for ($i=1; $i <=10 ; $i++) { 
            $var1 = "P$i";
            $resulta1 = mysqli_query($mysqli, "SELECT $var1 FROM `test-autoestima` WHERE IDTutorado = '$tutorado' ");
            
        while($datos1 = mysqli_fetch_array($resulta1)) {
                if ($datos1["P$i"]==1) {
                    $contador1++;
                }
                if ($datos1["P$i"]==2) {
                    $contador2++;
                    
                }
                if ($datos1["P$i"]==3) {
                    $contador3++;
                    
                }
                if ($datos1["P$i"]==4) {
                    $contador4++;
                    
                }
                
            }
            
        }

        if($contador1>$contador2){
            if ($contador1>$contador3) {
                if ($contador1>$contador4) {
                    $vars = 1;
                }else{
                    $vars = 4;
                }
            }else{
                if ($contador3>$contador4) {
                    $vars = 3;
                }else{
                    $vars = 4;
                }
            }

        }else{
            if ($contador2 > $contador3) {
                if ($contador2>$contador4) {
                    $vars = 2;
                }else{
                    $vars = 4;
                }
            }else{
                if ($contador3>$contador4) {
                    $vars = 3;
                }else{
                    $vars = 4;
                }
            }
        }


        if ($vars == 1) {
            $respuesta = "AUTOESTIMA BAJO";
        }elseif ($vars ==2) {
            $respuesta = "AUTOESTIMA SUFICIENTE";
        }elseif ($vars ==3) {
            $respuesta = "AUTOESTIMA BUENO";
        }elseif ($vars ==4) {
            $respuesta = "AUTOESTIMA ALTO";
        }

        $autoestimaUP="UPDATE `resultado-test-autoestima` SET Descripcion='$respuesta' WHERE IDResultadoTestAuto = $IDResultado";
        mysqli_query($mysqli,$autoestimaUP) or die (mysqli_error($mysqli));

        $Tecnicas="UPDATE `resultados-parciales` SET TestAutoestima='1' WHERE IDTutorado = $tutorado2";
         mysqli_query($mysqli,$Tecnicas) or die (mysqli_error($mysqli));

        echo'<script type="text/javascript">
            alert("Se guardó la información, clic en aceptar para continuar.");
            window.location.href="../../consultas/calcular-resultados-finales-autoestima.php";
            </script>';
        mysqli_close($mysqli);  

  
?>