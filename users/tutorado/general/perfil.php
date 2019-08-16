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

        $sesionActual = $_SESSION['usuario']['IDUsuario'];
    try{
        require_once("../../../php/conexion.php"); //enlazar el archivo de conexion
        $consultas = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        
        //AQUI EMPIEZA LO BUENO
        $ConsultaTutoradoNot = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $notific=mysqli_fetch_assoc($ConsultaTutoradoNot);
        $tutoradoNot = $notific['IDTutorado'];
        $notificaciones = mysqli_query($mysqli,"SELECT * FROM Notificaciones WHERE IDTutorado = '$tutoradoNot' OR IDTutorado = 0");
        
        $totalnotificaciones = "SELECT * FROM Notificaciones WHERE IDTutorado = '$tutoradoNot' OR IDTutorado = 0";
        $resultado_contar = $mysqli->query($totalnotificaciones); //ejecutar y almacenar la consulta;
        //AQUI TERMINO LO BUENO
        }catch(Exception $e){
            $error = $e->getMessage(); //usar funcion de mysqli para capturar el error e imprimirlo
        }
        
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OceanMind</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../../../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/animate.css">
    <!-- Font Awesome CSS-->
       <link rel="stylesheet" href="../../../vendor/font-awesome/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="../../../css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="../../../css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="../../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../../../css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../../../css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../../../img/logoweb.png">
    
    <!--css slider normateca-->
    <link rel="stylesheet" href="../../../css/styleperfil.css">
    
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrappr animated slideInLeft">
       <div class=" logo-principal sidenav-header-inner" style="">
           <a href="../general/general.php"><img src="../../../img/logoweb.png" class="img-fluid" alt=""></a>
       </div>
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          
          <!-- User Info-->
          
          
          <?php
            
            $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
                  $data19=mysqli_fetch_assoc($ConsultaTutorado);
                  $tutorado = $data19['IDTutorado'];
                
                  $ConsultaEA = mysqli_query($mysqli,"SELECT * FROM `resultado-estilos-aprendizaje` WHERE IDTutorado = '$tutorado' ");
                  $data20=mysqli_fetch_assoc($ConsultaEA);
                  $tutoradoEA = $data20['IDTutorado'];
                  
                  
                  $ConsultaHabilidades = mysqli_query($mysqli,"SELECT * FROM `habilidades-estudio` WHERE IDTutorado = '$tutorado' ");
                  $data21=mysqli_fetch_assoc($ConsultaHabilidades);
                  $tutoradoHabilidades = $data21['IDTutorado'];
                  
                  
                  $ConsultaPensamiento = mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTutorado = '$tutorado' ");
                  $data22=mysqli_fetch_assoc($ConsultaPensamiento);
                  $tutoradoPensamiento = $data22['IDTutorado'];
                  
                  
                  if($tutorado == $tutoradoEA ) {
                     
                     if($tutorado == $tutoradoHabilidades){
                        
                        if($tutorado == $tutoradoPensamiento){
                            echo '<div class="sidenav-header-inner text-center"><img src="../../../img/avatares/avatar-logica.png" alt="person" class="img-fluid">';
                        }else{
                            echo '<div class="sidenav-header-inner text-center"><img src="../../../img/avatares/avatar-desarrollo-humano.png" alt="person" class="img-fluid">';    
                        }
                        
                     }else{
                        echo '<div class="sidenav-header-inner text-center"><img src="../../../img/avatares/avatar-identificacion.png" alt="person" class="img-fluid">';                    
                     }
                      
                  }else{
                      echo '<div class="sidenav-header-inner text-center"><img src="../../../img/avatares/avatar-inicial.png" alt="person" class="img-fluid">';
                  }
                  
            
            
            ?>
          
          
          
            <h2 class="letra_usuario"><?php echo $_SESSION['usuario']['Nombres'] ?> <?php echo $_SESSION['usuario']['ApellidoP'] ?></h2>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="../index.php" class="brand-small" ><img src="../../../img/Logo.png" alt=""></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu animated slideInLeft">
          <hr class="sidenav-heading  justify-content-center">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="../index.php"> <i class="far fa-user"></i>Identificación</a>
            </li>
            <li><a href="../desarrollo-humano/index.php" aria-expanded="false" > <i class="far fa-smile-wink"></i>Desarrollo Humano </a>
              
            </li>
            <li><a href="../habilidades-pensamiento/index.php" aria-expanded="false" > <i class="far fa-lightbulb fa-2x"></i>Pensamiento </a>
              
            </li>
            <li><a href="../fortalecimiento/index.php" aria-expanded="false" > <i class="fas fa-dumbbell"></i>Fortalecimiento </a>
              
            </li>
            <li><a href="normateca-books.php" aria-expanded="false" > <i class="fas fa-book"></i>Material de Lectura </a>
              
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header "><a id="toggle-btn" href="#" class="menu-btn"><i class="fas fa-bars "> </i></a><a href="index.html" class="navbar-brand">
                  
                     
                  
                  <div class="brand-text d-none d-md-inline-block"></div></a></div>
                  
                  <div class="col align-self-start">
                        <ol class="breadcrumb" style="background: none; color: white; width: auto; height: 30px; font-family: lato; ">
                            <li>
                                <a style="font-size: 20px;" href="../general/general.php">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <div style="font-size: 20px;font-family:lato">&nbsp; > &nbsp;</div>
                            <li>
                                <a style="font-size: 20px;font-family:lato">
                                    <u>Perfil</u>
                                </a>
                            </li>
                            
                        </ol>
                    </div>
                  
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                
             <!-- Notificaciones dropdown-->
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell fa-2x"></i><span class="badge contadornoti"><?php echo $resultado_contar->num_rows; ?></span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu shadow p-3 mb-5 bg-white rounded dropdown-menu-right navbar-dropdown animated bounceInDown">
                    
                    <?php while($datosnotificacion = mysqli_fetch_array($notificaciones)) { ?>
   
                      
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                        <?php echo $datosnotificacion['Descripcion']; ?>    
                    </div></a></li>
                    
                    <?php } ?> 
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>Nuevas notificaciones</strong></a></li>
                  </ul>
                </li>
                
              
                <!-- Log out-->
                     <li class="nav-item dropdown  ">
            <a class="nav-link dropdown-toggle" id="notifications" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
              <img class="img-xs rounded-circle" src="../../../img/avatar-1.jpg" alt="Profile image" width="37px;" height="37px" style="margin-top: -8px">
            </a>
            <div class="dropdown-menu shadow p-3 mb-5 rounded dropdown-menu-right navbar-dropdown animated bounceInDown" aria-labelledby="UserDropdown">
                <a class="dropdown-item" href="../general/perfil.php">
                <i class="fas fa-user"></i><span>Perfil</span>
              </a>
         
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../../salir.php">
                <i class="fas fa-sign-out-alt"></i><span>Salir</span>
              </a>
            </div>
          </li>
                
              </ul>
            </div>
          </div>
        </nav>
          <div class="row navbar-perfil" >
          <div class="container-fluid col-md-6 mt-4">
            
            
            <?php
            
            $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
                  $data18=mysqli_fetch_assoc($ConsultaTutorado);
                  $tutorado = $data18['IDTutorado'];
                
                  $ConsultaEA = mysqli_query($mysqli,"SELECT * FROM `resultado-estilos-aprendizaje` WHERE IDTutorado = '$tutorado' ");
                  $data15=mysqli_fetch_assoc($ConsultaEA);
                  $tutoradoEA = $data15['IDTutorado'];
                  
                  
                  $ConsultaHabilidades = mysqli_query($mysqli,"SELECT * FROM `habilidades-estudio` WHERE IDTutorado = '$tutorado' ");
                  $data16=mysqli_fetch_assoc($ConsultaHabilidades);
                  $tutoradoHabilidades = $data16['IDTutorado'];
                  
                  
                  $ConsultaPensamiento = mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTutorado = '$tutorado' ");
                  $data17=mysqli_fetch_assoc($ConsultaPensamiento);
                  $tutoradoPensamiento = $data17['IDTutorado'];
                  
                  
           /*       if($tutorado == $tutoradoEA ) {
                     
                     if($tutorado == $tutoradoHabilidades){
                        
                        if($tutorado == $tutoradoPensamiento){
                            echo '<button class="btn btn-perfil mt-2" type="button">Nivel 3</button>';
                        }else{
                            echo '<button class="btn btn-perfil mt-2" type="button">Nivel 2</button>';    
                        }
                        
                     }else{
                        echo '<button class="btn btn-perfil mt-2" type="button">Nivel 1</button>';                    
                     }
                      
                  }else{
                      echo '<button class="btn btn-perfil mt-2" type="button">Nivel 0</button>';
                  }
                  
            
            */
            ?>
            
            <script>
   
   
        var general=[<?php
    
           $sql4=mysqli_query($mysqli,"SELECT * FROM `resultados-generales` WHERE IDTutorado = $tutorado");
                    while($info=mysqli_fetch_array($sql4))
             $general = $info['AvanceGeneral'];
             
             if ($general == 0) {
                $resultaGeneral = 0;
             }elseif ($general == 1) {
                $resultaGeneral = 12.5;
             }elseif ($general == 2) {
                $resultaGeneral = 25;
             }elseif ($general == 3) {
                $resultaGeneral = 37.5;
             }elseif ($general == 4) {
                $resultaGeneral = 50;
             }elseif ($general == 5) {
                $resultaGeneral = 62.5;
             }elseif ($general == 6) {
                $resultaGeneral = 75;
             }elseif ($general == 7) {
                $resultaGeneral = 87.5;
             }elseif ($general == 8) {
                $resultaGeneral = 100;
             }elseif ($general > 8) {
                $resultaGeneral = 100;
             }
             echo round ($resultaGeneral);
    
                    ?>];
        
        var rgeneral=[<?php
             $rg=mysqli_query($mysqli,"SELECT * FROM `resultados-generales` WHERE IDTutorado = $tutorado");
           while($info=mysqli_fetch_array($rg))
                         $rgeneral = $info['AvanceGeneral'];
                         $cien = 100;
                         $result = $cien-$resultaGeneral;
                         echo round ($result);
                       
                    ?>];
    ;
          
        
    
    </script>
            
            
                
                 
                  <form action="actualizar-datos.php">
                  <button class="btn btn-perfil mt-2" type="submit" >Actualizar información</button>
                  </form>
              
              
               
            
          </div>
           <div class="col-md-6 mt-2 container-fluid " >
                <div class=" mt-4">
   
  <div class="progress">
  <div class="progress-bar-color  progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php  echo round ($resultaGeneral);?>%"></div>
  
  
</div>
  <h6 class="text-center progress-text"><?php  echo round ($resultaGeneral);?>% Completado</h6>
   </div>
              
               
           </div>
          
          </div>
      </header>
    <div class="row justify-content-center mt-5 col-sm-12   ml-1 mr-1 container">
           <div class="col-md-11 col-sm-12 col-xs-12 ">
              
                  
        
        <h1 class="titulo-logros">Logros</h1>
          <div class="card-body d-flex justify-content-center ">  
          
          
          
            
           <div class="card-deck">
               
               
               <?php 
      
                  $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
                  $data5=mysqli_fetch_assoc($ConsultaTutorado);
                  $tutorado = $data5['IDTutorado'];
                  
                  $ConsultaIDT = mysqli_query($mysqli,"SELECT * FROM `ficha-identificacion` WHERE IDTutorado = '$tutorado' ");
                  $data6=mysqli_fetch_assoc($ConsultaIDT);
                  $tutoradoID = $data6['IDTutorado'];
                  
                  
                  $ConsultaFodaT = mysqli_query($mysqli,"SELECT * FROM `foda` WHERE IDTutorado = '$tutorado' ");
                  $data7=mysqli_fetch_assoc($ConsultaFodaT);
                  $tutoradoFoda = $data7['IDTutorado'];
                  $fortaleza1 = $data7['Fortaleza1'];
                  $fortaleza2 = $data7['Fortaleza2'];
                  $fortaleza3 = $data7['Fortaleza3'];
                  $fortaleza4 = $data7['Fortaleza4'];
                  $oportunidades1 = $data7['Oportunidad1'];
                  $oportunidades2 = $data7['Oportunidad2'];
                  $oportunidades3 = $data7['Oportunidad3'];
                  $oportunidades4 = $data7['Oportunidad4'];
                  $debilidades1 = $data7['Debilidad1'];
                  $debilidades2 = $data7['Debilidad2'];
                  $debilidades3 = $data7['Debilidad3'];
                  $debilidades4 = $data7['Debilidad4'];
                  $amenaza1 = $data7['Amenaza1'];
                  $amenaza2 = $data7['Amenaza2'];
                  $amenaza3 = $data7['Amenaza3'];
                  $amenaza4 = $data7['Amenaza4'];
                  
                  $ConsultaLVT = mysqli_query($mysqli,"SELECT * FROM `linea-vida` WHERE IDTutorado = '$tutorado' ");
                  $data8=mysqli_fetch_assoc($ConsultaLVT);
                  $tutoradoLV = $data8['IDTutorado'];
                  
                  $ConsultaEAT = mysqli_query($mysqli,"SELECT * FROM `resultado-estilos-aprendizaje` WHERE IDTutorado = '$tutorado' ");
                  $data9=mysqli_fetch_assoc($ConsultaEAT);
                  $tutoradoEA = $data9['IDTutorado'];
                  
                  //TROFEO 1 IDENTIFICACION
                  if ($tutorado = $tutoradoID) {
                      echo '<div class="card fondo-trofeo">
                        <img class="card-img-top img-trofeo" src="../../../img/trofeos/trofeo-identificacion.png" >
                        <div class="">
                          <h5 class="titulo-trofeo">IDENTIFICACIÓN</h5>
                          <hr class="hr-logros" >
                          <p class="num-trofeo">TROFEO DATOS PERSONALES</p>
                         
                        </div>
                        </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">
                 <i class="far fa-sad-cry card-img-top img-sad"></i>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este trofeo!</h5>
                                </div>
  </div>';
                  }
                  
                  //TROFEO 2 FODA
                  if ($tutorado = $tutoradoFoda) {
                      
                      if(!empty($fortaleza1 != "" && $fortaleza2 != "" && $fortaleza3 != "" && $fortaleza4 != "" && $oportunidades1 != "" && $oportunidades2 != "" && $oportunidades3 != "" && $oportunidades4 != "" && $debilidades1 != "" && $debilidades2 != "" && $debilidades3 != "" && $debilidades4 != "" && $amenaza1 != "" && $amenaza2 != "" && $amenaza3 != "" && $amenaza4 != "")){
                          echo '<div class="card fondo-trofeo">
                            <img class="card-img-top img-trofeo" src="../../../img/trofeos/trofeo-identificacion.png" >
                            <div class="">
                              <h5 class="titulo-trofeo">IDENTIFICACIÓN</h5>
                              <hr class="hr-logros" >
                              <p class="num-trofeo">TROFEO FODA</p>
                             
                            </div>
                          </div>';
                      }else{
                          echo '<div class="card fondo-trofeo">
                                <i class="far fa-sad-cry card-img-top img-sad"></i>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este trofeo!</h5>
                                </div>
                                
                              </div>';
                      }
                      
                      
     
                  }else{
                        echo '<div class="card fondo-trofeo">
                               <i class="far fa-sad-cry card-img-top img-sad"></i>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este trofeo!</h5>
                                </div>
                                
                              </div>';
                  }
                  
                  //TROFEO 3 LINEA VIDA
                  if ($tutorado = $tutoradoLV) {
                      echo '<div class="card fondo-trofeo">
                            <img class="card-img-top img-trofeo" src="../../../img/trofeos/trofeo-identificacion.png" >
                            <div class="">
                              <h5 class="titulo-trofeo">IDENTIFICACIÓN</h5>
                              <hr class="hr-logros" >
                              <p class="num-trofeo">TROFEO LINEA DE VIDA</p>
                             
                            </div>
                          </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">
                                 <i class="far fa-sad-cry card-img-top img-sad"></i>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este trofeo!</h5>
                                </div>
                              </div>';
                  }
                  
                  //TROFEO 4 ESTILOS-APRENDIZALE
                  if ($tutorado = $tutoradoEA) {
                      echo '<div class="card fondo-trofeo">
                            <img class="card-img-top img-trofeo" src="../../../img/trofeos/trofeo-identificacion.png" >
                            <div class="">
                              <h5 class="titulo-trofeo">IDENTIFICACIÓN</h5>
                                <hr class="hr-logros" >
                              <p class="num-trofeo">TROFEO ESTILOS DE APRENDIZAJE</p>
                             
                            </div>
                          </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">
                                <i class="far fa-sad-cry card-img-top img-sad"></i>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este trofeo!</h5>
                                </div>
                                
                              </div>';
                  }
      
      ?>
               

                </div>
                
             
              


       
    </div>
    
         <div class="card-body d-flex justify-content-center ">  
          
          
           
          
          
            
             <div class="card-deck">
                 
                 <?php
          
           $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
           $data10=mysqli_fetch_assoc($ConsultaTutorado);
           $tutorado = $data10['IDTutorado'];
                  
           $ConsultaTAT = mysqli_query($mysqli,"SELECT * FROM `test-autoestima` WHERE IDTutorado = '$tutorado' ");
           $data11=mysqli_fetch_assoc($ConsultaTAT);
           $tutoradoTAT = $data11['IDTutorado'];
           
           $ConsultaAT = mysqli_query($mysqli,"SELECT * FROM `test-asertividad` WHERE IDTutorado = '$tutorado' ");
           $data12=mysqli_fetch_assoc($ConsultaAT);
           $tutoradoAT = $data12['IDTutorado'];
           
           $ConsultaHET = mysqli_query($mysqli,"SELECT * FROM `habilidades-estudio` WHERE IDTutorado = '$tutorado' ");
           $data13=mysqli_fetch_assoc($ConsultaHET);
           $tutoradoHET = $data13['IDTutorado'];
           
           $ConsultaTL = mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTutorado = '$tutorado' ");
           $data14=mysqli_fetch_assoc($ConsultaTL);
           $tutoradoTL = $data14['IDTutorado'];
           
           //TROFEO 5 AUTOESTIMA
                  if ($tutorado = $tutoradoTAT) {
                      echo '<div class="card fondo-trofeo">
                            <img class="card-img-top img-trofeo" src="../../../img/trofeos/trofeo-desarrollo-humano.png" >
                            <div class="">
                              <h5 class="titulo-trofeo">DESARROLLO HUMANO</h5>
                              <hr class="hr-logros" >
                              <p class="num-trofeo">TROFEO AUTOESTIMA</p>
                             
                            </div>
                          </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">
                           <i class="far fa-sad-cry card-img-top img-sad"></i>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este trofeo!</h5>
                                </div>
                                
                          </div>';
                  }
                  
            //TROFEO 6 AUTOESTIMA
                  if ($tutorado = $tutoradoAT) {
                      echo '<div class="card fondo-trofeo">
                            <img class="card-img-top img-trofeo" src="../../../img/trofeos/trofeo-desarrollo-humano.png" >
                            <div class="">
                              <h5 class="titulo-trofeo">DESARROLLO HUMANO</h5>
                                <hr class="hr-logros" >
                              <p class="num-trofeo">TROFEO ASERTIVIDAD</p>
                             
                            </div>
                          </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">
                        <i class="far fa-sad-cry card-img-top img-sad"></i>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este trofeo!</h5>
                                </div>
                          </div>';
                  }
                  
            //TROFEO 7 HABILIDADES ESTUDIO
                  if ($tutorado = $tutoradoHET) {
                      echo '<div class="card fondo-trofeo">
                            <img class="card-img-top img-trofeo" src="../../../img/trofeos/trofeo-desarrollo-humano.png" >
                            <div class="">
                              <h5 class="titulo-trofeo">DESARROLLO HUMANO</h5>
                               <hr class="hr-logros" >
                              <p class="num-trofeo">TROFEO HABILIDADES DE ESTUDIO</p>
                             
                            </div>
                          </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">
                           <i class="far fa-sad-cry card-img-top img-sad"></i>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este trofeo!</h5>
                                </div>
                          </div>';
                  }
                  
                  //TROFEO 8 PENSAMIENTO
                  if ($tutorado = $tutoradoTL) {
                      echo '<div class="card fondo-trofeo">
                            <img class="card-img-top img-trofeo" src="../../../img/trofeos/trofeo-logica.png" >
                            <div class="">
                              <h5 class="titulo-trofeo">PENSAMIENTO LÓGICO</h5>
                               <hr class="hr-logros" >
                              <p class="num-trofeo">TROFEO LÓGICA</p>
                             
                            </div>
                          </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">
                              <i class="far fa-sad-cry card-img-top img-sad"></i>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este trofeo!</h5>
                                </div>
                          </div>';
                  } 
                 
          
          
?>
                </div>
                
             
              


       
    </div>
    
        
        
        
       
            </div>
                 <div class="col-md-11 col-sm-12 col-xs-12 ">
              
                  
        
          <h1 class="titulo-avatars">Avatars</h1>
          
          
          
         <div class="card-body d-flex justify-content-center ">  
          
            
           <div class="card-deck">
           
           <?php 
      
                  $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
                  $data=mysqli_fetch_assoc($ConsultaTutorado);
                  $tutorado = $data['IDTutorado'];
                
                  $ConsultaEA = mysqli_query($mysqli,"SELECT * FROM `resultado-estilos-aprendizaje` WHERE IDTutorado = '$tutorado' ");
                  $data2=mysqli_fetch_assoc($ConsultaEA);
                  $tutoradoEA = $data2['IDTutorado'];
                  
                  
                  $ConsultaHabilidades = mysqli_query($mysqli,"SELECT * FROM `habilidades-estudio` WHERE IDTutorado = '$tutorado' ");
                  $data3=mysqli_fetch_assoc($ConsultaHabilidades);
                  $tutoradoHabilidades = $data3['IDTutorado'];
                  
                  
                  $ConsultaPensamiento = mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTutorado = '$tutorado' ");
                  $data4=mysqli_fetch_assoc($ConsultaPensamiento);
                  $tutoradoPensamiento = $data4['IDTutorado'];
                  
                  //AVATAR IDENTIFICACION
                  if ($tutorado = $tutoradoEA) {
                      echo '<div class="card fondo-trofeo">
    <img class="card-img-top img-trofeo" src="../../../img/avatares/avatar-identificacion.png" >
    <div class="">
      <h5 class="titulo-trofeo">IDENTIFICACIÓN</h5>
       <hr class="hr-logros" >
      <p class="num-trofeo">AVATAR 1</p>
      
    </div>
    
  </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">

    <div class="">
    <center>
           <i class="far fa-sad-cry card-img-top img-sad"></i>
           </center>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este Avatar!</h5>
                                </div>
     
    </div>
    
    <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3"></script>
    
  </div>';
                      }
                      
                      //AVATAR DESARROLLO HUMANO
                      
                      if ($tutorado = $tutoradoHabilidades) {
                      echo ' <div class="card fondo-trofeo">
        <img class="card-img-top img-trofeo" src="../../../img/avatares/avatar-desarrollo-humano.png" >

    <div class="">
      <h5 class="titulo-trofeo">Desarrollo Humano</h5>
      <hr class="hr-logros" >
      <p class="num-trofeo">Avatar 2</p>
    </div>
    
    </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">

    <div class="">
    <center>
       <i class="far fa-sad-cry card-img-top img-sad"></i>
       </center>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este Avatar!</h5>
                                </div>
     
    </div>
    
    <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3"></script>
    
  </div>';
                      }
                      
                      
                      //AVATAR PENSAMIENTO
                      
                      if ($tutorado = $tutoradoPensamiento) {
                      echo '<div class="card fondo-trofeo">
        <img class="card-img-top img-trofeo" src="../../../img/avatares/avatar-logica.png" >

    <div class="">
      <h5 class="titulo-trofeo">Pensamiento Lógico</h5>
      <hr class="hr-logros" >
      <p class="num-trofeo">Avatar 3</p>
     
    </div>
    
    
  </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">

    <div class="">
     <center>
       <i class="far fa-sad-cry card-img-top img-sad"></i>
       </center>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este Avatar!</h5>
                                </div>
    </div>
    
    <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3"></script>
    
  </div>';
                      }
                      
                      //AVATAR FORTALECIMIENTO
                      
                      if ($tutorado = $tutoradoPensamiento) {
                      echo '<div class="card fondo-trofeo">
        <img class="card-img-top img-trofeo" src="../../../img/avatares/avatar-fortalecimiento.png" >

    <div class="">
      <h5 class="titulo-trofeo">Fortalecimiento</h5>
      <hr class="hr-logros" >
      <p class="num-trofeo">Avatar 4</p>
     
    </div>
    
      </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">

    <div class="">
    <center>
       <i class="far fa-sad-cry card-img-top img-sad"></i>
       </center>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea este Avatar!</h5>
                                </div>
     
    </div>
    
    <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3"></script>
    
  </div>';
                      }
                  
                  

      
      ?>
                </div>
                
             
              


       
    </div>
       
            </div>
            
                 <!-- APPS --> 
                 <div class="col-md-11 col-sm-12 col-xs-12 ">
              
                  
        
          <h1 class="titulo-avatars">Aplicaciones</h1>
          
          
          
         <div class="card-body d-flex justify-content-center ">  
          
            
           <div class="card-deck">
           
           <?php 
      
                  $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
                  $data=mysqli_fetch_assoc($ConsultaTutorado);
                  $tutorado = $data['IDTutorado'];
                  
                  $ConsultaPensamiento = mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTutorado = '$tutorado' ");
                  $data4=mysqli_fetch_assoc($ConsultaPensamiento);
                  $tutoradoPensamiento = $data4['IDTutorado'];
                  

                      
                      //AVATAR FORTALECIMIENTO
                      
                      if ($tutorado = $tutoradoPensamiento) {
                      echo '<div class="card fondo-trofeo">
        <img class="card-img-top img-trofeo" src="../../../img/octo.jpg"  >

    <div class="">
      <h5 class="titulo-trofeo">OctoMind App</h5>
      <hr class="hr-logros" >
      <p class="num-trofeo"><a href="../apps/octomind.apk">Descargar</a></p>
     
    </div>
    
      </div>';
     
                  }else{
                        echo '<div class="card fondo-trofeo">

    <div class="">
    <center>
       <i class="far fa-sad-cry card-img-top img-sad"></i>
       </center>
                        <div class="">
                        <h5 class="titulo-sad">¡Desbloquea esta App!</h5>
                                </div>
     
    </div>
    
    <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3"></script>
    
  </div>';
                      }
                  
                  

      
      ?>
                </div>
                
             
              


       
    </div>
       
            </div>
                </div>      
       
      
      <footer class="main-footer  mt-3 col-md-12">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
               

            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <i class="fab fa-facebook fa-2x colorfooter"  aria-hidden="true"></i>
                      <i class="fab fa-twitter fa-2x"   aria-hidden="true"></i>
                      <i class="fab fa-youtube fa-2x "    aria-hidden="true"></i>
                      <i class="fab fa-instagram fa-2x"  aria-hidden="true"></i>
            </div>
           
          </div>
        </div>
      </footer>
    </div>
    <!-- JavaScript files-->
    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="../../../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
    
    
    <!-- Main File-->
    <script src="../../../js/front.js"></script>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    
  </body>
</html>