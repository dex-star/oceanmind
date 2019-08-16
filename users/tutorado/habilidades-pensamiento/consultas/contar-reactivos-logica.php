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

        //CONSULTA PARA OBTENER IDTESTLOGICA
        $ConsultaLogica = mysqli_query($mysqli,"SELECT IDTestLogica, IDTutorado FROM `test-logica` WHERE IDTutorado = '$tutorado'");
        $data2=mysqli_fetch_assoc($ConsultaLogica);
        $LogicaTutorado = $data2['IDTutorado'];
        $Logica = $data2['IDTestLogica'];


        //CONTAR INTERPRETACION INFORMACION
        $contador = 0;
        for ($i=1; $i <=10 ; $i++) { 
            $var = "P$i";
            $resulta = mysqli_query($mysqli, "SELECT $var FROM `interpretacion-informacion` WHERE IDTestLogica = '$Logica' ");
            
        while($datos = mysqli_fetch_array($resulta)) {
                if ($datos["P$i"]==1) {
                    $contador++;
                    
                }
                
            }
            
        }

        //CONTAR RELACIONES LOGICAS
        $contador2 = 0;
        for ($i=1; $i <=10 ; $i++) { 
            $var = "P$i";
            $resulta2 = mysqli_query($mysqli, "SELECT $var FROM `interpretacion-relaciones-logicas` WHERE IDTestLogica = '$Logica' ");
            
        while($datos2 = mysqli_fetch_array($resulta2)) {
                if ($datos2["P$i"]==1) {
                    $contador2++;

                    
                }
                
            }
            
        }


        //CONTAR PATRONES
        $contador3 = 0;
        for ($i=1; $i <=10 ; $i++) { 
            $var = "P$i";
            $resulta3 = mysqli_query($mysqli, "SELECT $var FROM `reconocimiento-patrones` WHERE IDTestLogica = '$Logica' ");
            
        while($datos3 = mysqli_fetch_array($resulta3)) {
                if ($datos3["P$i"]==1) {
                    $contador3++;
          
                }
                
            }
            
        }

        //CONTAR ESPACIAL
        $contador4 = 0;
        for ($i=1; $i <=7 ; $i++) { 
            $var = "P$i";
            $resulta4 = mysqli_query($mysqli, "SELECT $var FROM `representacion-espacial` WHERE IDTestLogica = '$Logica' ");
            
        while($datos4 = mysqli_fetch_array($resulta4)) {
                if ($datos4["P$i"]==1) {
                    $contador4++;
          
                }
                
            }
            
        }

        $TOTAL = $contador + $contador2 + $contador3 + $contador4;


        //EVALUACION INTERPRETACION
        if ($TOTAL >= 38) {
            $inter = "MUY ALTO";
            $valor=9;
        }elseif ($TOTAL >= 30) {
            $inter = "ALTO";
            $valor=8;
        }elseif ($TOTAL >= 28) {
            $inter = "POR ENCIMA DEL PROMEDIO";
            $valor=7;
        }elseif ($TOTAL >= 20) {
            $inter = "PROMEDIO ALTO";
            $valor=6;
        }elseif ($TOTAL >= 18) {
            $inter = "PROMEDIO";
            $valor=5;
        }elseif ($TOTAL >= 10) {
            $inter = "PROMEDIO BAJO";
            $valor=4;
        }elseif ($TOTAL >= 8) {
            $inter = "POR DEBAJO DEL PROMEDIO";
            $valor=3;
        }elseif ($TOTAL >= 1) {
            $inter = "BAJO";
            $valor=2;
        }elseif ($TOTAL >= 0) {
            $inter = "MUY BAJO";
            $valor=1;
        }


         $final="UPDATE `test-logica` SET ResultadoInterpretacionInformacion ='$contador', ResultadoInterpretacionRelacionesLogicas = '$contador2', ResultadoInterpretacionReconocimientoPatrones ='$contador3', ResultadoRepresentacionEspacial='$contador4', ResultadoTestLogica='$TOTAL', Interpretacion='$valor'  WHERE IDTutorado = $tutorado";
         mysqli_query($mysqli,$final) or die (mysqli_error($mysqli));         

        $Tecnicas="UPDATE `resultados-parciales` SET TestLogica='1' WHERE IDTutorado = $tutorado2";
         mysqli_query($mysqli,$Tecnicas) or die (mysqli_error($mysqli)); 

        echo'<script type="text/javascript">
            alert("Has finalizado este test, tu nivel de lógica es: '.$inter.'");
            window.location.href="../../consultas/calcular-resultados-finales-logica.php";
            </script>';
        mysqli_close($mysqli);  
  
?>