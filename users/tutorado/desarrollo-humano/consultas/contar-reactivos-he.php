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
        $ConsultaLineaVida = mysqli_query($mysqli,"SELECT IDHabilidadesEstudio, IDTutorado FROM `habilidades-estudio` WHERE IDTutorado = '$tutorado'");
        $data2=mysqli_fetch_assoc($ConsultaLineaVida);
        $HETutorado = $data2['IDTutorado'];
        $HE = $data2['IDHabilidadesEstudio'];


        //CONTAR MOTIVACION
        $contador = 0;
        for ($i=1; $i <=20 ; $i++) { 
            $var = "P$i";
            $resulta = mysqli_query($mysqli, "SELECT $var FROM `he-motivacion-estudio` WHERE IDHabilidadesEstudio = '$HE' ");
            
        while($datos = mysqli_fetch_array($resulta)) {
                if ($datos["P$i"]==0) {
                    $contador++;
                    
                }
                
            }
            
        }

        //CONTAR ORGANIZACION
        $contador2 = 0;
        for ($i=1; $i <=20 ; $i++) { 
            $var = "P$i";
            $resulta2 = mysqli_query($mysqli, "SELECT $var FROM `he-organizacion-estudio` WHERE IDHabilidadesEstudio = '$HE' ");
            
        while($datos2 = mysqli_fetch_array($resulta2)) {
                if ($datos2["P$i"]==0) {
                    $contador2++;

                    
                }
                
            }
            
        }


        //CONTAR TECNICAS
        $contador3 = 0;
        for ($i=1; $i <=20 ; $i++) { 
            $var = "P$i";
            $resulta3 = mysqli_query($mysqli, "SELECT $var FROM `he-tecnicas-estudio` WHERE IDHabilidadesEstudio = '$HE' ");
            
        while($datos3 = mysqli_fetch_array($resulta3)) {
                if ($datos3["P$i"]==0) {
                    $contador3++;
          
                }
                
            }
            
        }

        $TOTAL = $contador + $contador2 + $contador3;


        //EVALUACION INTERPRETACION
        if ($TOTAL >= 57) {
            $inter = "MUY ALTO";
            $valor=9;
        }elseif ($TOTAL >= 52) {
            $inter = "ALTO";
            $valor=8;
        }elseif ($TOTAL >= 50) {
            $inter = "POR ENCIMA DEL PROMEDIO";
            $valor=7;
        }elseif ($TOTAL >= 48) {
            $inter = "PROMEDIO ALTO";
            $valor=6;
        }elseif ($TOTAL >= 43) {
            $inter = "PROMEDIO";
            $valor=5;
        }elseif ($TOTAL >= 39) {
            $inter = "PROMEDIO BAJO";
            $valor=4;
        }elseif ($TOTAL >= 37) {
            $inter = "POR DEBAJO DEL PROMEDIO";
            $valor=3;
        }elseif ($TOTAL >= 34) {
            $inter = "BAJO";
            $valor=2;
        }elseif ($TOTAL >= 0) {
            $inter = "MUY BAJO";
            $valor=1;
        }

        $Motivacion="UPDATE `he-motivacion-estudio` SET ResultadoMotivacion='$contador' WHERE IDHabilidadesEstudio = $HE";
         mysqli_query($mysqli,$Motivacion) or die (mysqli_error($mysqli));

        $Organizacion="UPDATE `he-organizacion-estudio` SET ResultadoOrganizacion='$contador2' WHERE IDHabilidadesEstudio = $HE";
         mysqli_query($mysqli,$Organizacion) or die (mysqli_error($mysqli));

        $Tecnicas="UPDATE `he-tecnicas-estudio` SET ResultadoTecnica='$contador3' WHERE IDHabilidadesEstudio = $HE";
         mysqli_query($mysqli,$Tecnicas) or die (mysqli_error($mysqli));

        $Tecnicas="UPDATE `habilidades-estudio` SET ResultadoTecnica='$contador3', ResultadoOrganizacion='$contador2', ResultadoMotivacion='$contador', ResultadoHabilidadesEstudio='$TOTAL', Interpretacion='$valor' WHERE IDHabilidadesEstudio = $HE";
         mysqli_query($mysqli,$Tecnicas) or die (mysqli_error($mysqli));

        $Tecnicas="UPDATE `resultados-parciales` SET HabilidadesEstudio='1' WHERE IDTutorado = $tutorado2";
         mysqli_query($mysqli,$Tecnicas) or die (mysqli_error($mysqli)); 

        echo'<script type="text/javascript">
            alert("MOTIVACION = '.$contador.', ORGANIZACIÓN = '.$contador2.', TECNICAS = '.$contador3.', TOTAL = '.$TOTAL.', INTERPRETACION = '.$inter.'");
            window.location.href="../../consultas/calcular-resultados-finales-he.php";
            </script>';
        mysqli_close($mysqli);  
  
?>