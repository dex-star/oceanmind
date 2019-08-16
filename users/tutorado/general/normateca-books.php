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
        }catch(Exception $e){
            $error = $e->getMessage(); //usar funcion de mysqli para capturar el error e imprimirlo
        }
        
        //AQUI EMPIEZA LO BUENO
        $ConsultaTutoradoNot = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $notific=mysqli_fetch_assoc($ConsultaTutoradoNot);
        $tutoradoNot = $notific['IDTutorado'];
        $notificaciones = mysqli_query($mysqli,"SELECT * FROM Notificaciones WHERE IDTutorado = '$tutoradoNot' OR IDTutorado = 0");
        
        $totalnotificaciones = "SELECT * FROM Notificaciones WHERE IDTutorado = '$tutoradoNot' OR IDTutorado = 0";
        $resultado_contar = $mysqli->query($totalnotificaciones); //ejecutar y almacenar la consulta;
        //AQUI TERMINO LO BUENO
        
        
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
    <link rel="stylesheet" href="../../../css/stylelectura.css">
    
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
                            <a style="font-size: 20px;" href="general.php">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <div style="font-size: 20px;font-family:lato">&nbsp; > &nbsp;</div>
                        <li class="active">
                            <a style="font-size: 20px;font-family:lato">
                                <u>Material de Lectura</u>
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
      </header>
     
             <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <i class="fa fa-circle active punto" data-target="#carouselExampleIndicators" data-slide-to="0"></i>
            <i class="fa fa-circle punto" data-target="#carouselExampleIndicators" data-slide-to="1"></i>
            <i class="fa fa-circle punto" data-target="#carouselExampleIndicators" data-slide-to="2"></i>
            
            
          </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                   <div class="row cardslider  ">
                   <center>
             <div class="col-md-10 col-sm-10 col-xs-12 ">
                  <div class="">  
                    <div class="card-body card fondo-card">
            <div class="col-md-12">
                <div class="col-xs-12">
                   <img src="../../../img/lectura/Portadalibro.png"  class="img-slider d-block" alt="">

                   <h1 class="titulo-libro">Morbi Finibus Leo</h1>

                   <p class="resum-libro">Curabitur tristique aliquet orci, et sodales lectus aliquet eget. In nunc sapien, 
                    eleifend in risus at, tempus commodo orci. Sed nec ex rhoncus, volutpat augue 
                    seu, bibendum lorem. Pellentesque porta efficitur augue sagittis dignissim. </p>

              <p class="fuente-libro"><strong class="autor">Autor: </strong><strong class="autor2"> Vivamus cursus</strong></p>

                 <!--info-->
                  <button class="btn btn-libro float-right" type="button">Leer Ahora</button>
                  <button class="btn btn-libro float-right" type="button">Descargar</button>
                </div>
            </div>
            </div>

                  </div>
             </div>

             </center>
        </div>
                </div>
                <div class="carousel-item">
                   <div class="row cardslider  ">
                   <center>
             <div class="col-md-10 col-sm-10 col-xs-12 ">
                  <div class="">  
                    <div class="card-body card fondo-card">
            <div class="col-md-12">
                <div class="col-xs-12">
                   <img src="../../../img/lectura/Portadalibro.png"  class="img-slider d-block" alt="">

                   <h1 class="titulo-libro">Morbi Finibus Leo</h1>

                   <p class="resum-libro">Curabitur tristique aliquet orci, et sodales lectus aliquet eget. In nunc sapien, 
                    eleifend in risus at, tempus commodo orci. Sed nec ex rhoncus, volutpat augue 
                    seu, bibendum lorem. Pellentesque porta efficitur augue sagittis dignissim. </p>

                <p class="fuente-libro"><strong class="autor">Autor: </strong><strong class="autor2"> Vivamus cursus</strong></p>

                 <!--info-->
                  <button class="btn btn-libro float-right" type="button">Leer Ahora</button>
                  <button class="btn btn-libro float-right" type="button">Descargar</button>
                </div>
            </div>
            </div>

                  </div>
             </div>

             </center>
        </div>
                </div>
                <div class="carousel-item">
                    <div class="row cardslider  ">
                   <center>
             <div class="col-md-10 col-sm-10 col-xs-12 ">
                  <div class="">  
                    <div class="card-body card fondo-card">
            <div class="col-md-12">
                <div class="col-xs-12">
                   <img src="../../../img/lectura/Portadalibro.png"  class="img-slider d-block" alt="">

                   <h1 class="titulo-libro">Morbi Finibus Leo</h1>

                   <p class="resum-libro">Curabitur tristique aliquet orci, et sodales lectus aliquet eget. In nunc sapien, 
                    eleifend in risus at, tempus commodo orci. Sed nec ex rhoncus, volutpat augue 
                    seu, bibendum lorem. Pellentesque porta efficitur augue sagittis dignissim. </p>

               <p class="fuente-libro"><strong class="autor">Autor: </strong><strong class="autor2"> Vivamus cursus</strong></p>



                  <button class="btn btn-libro float-right" type="button">Descargar</button>
                  <button class="btn btn-libro float-right" type="button">Leer Ahora</button>
                </div>
            </div>
            </div>

                  </div>
             </div>

             </center>
        </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                 <i class="fa fa-angle-left"  aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <div class="card-body">
        <section class="">
            <div class="container-fluid">

              <div class="row" >

                <div class="container-fluid">
                <h1 class="titulo-categorias">Categorías</h1>
                <ul class="nav nav-pills" id="pills-tab" role="tablist">

                  <li class="nav-item">
                    <a class="btn  btn-categoria active" id="pills-home-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">Ciencia</a>
                  </li>
                  <li class="nav-item">
                    <a class="btn btn-categoria2" id="pills-profile-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false">Salud</a>
                  </li>
                  <li class="nav-item">
                    <a class="btn btn-categoria3" id="pills-contact-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false">Literatura</a>
                  </li>
                  <li class="nav-item">
                    <a class="btn btn-categoria4" id="pills-contact-tab" data-toggle="pill" href="#pills-4" role="tab" aria-controls="pills-4" aria-selected="false">Autoayuda</a>
                  </li>
                    <li class="nav-item">
                    <a class="btn btn-categoria5" id="pills-contact-tab" data-toggle="pill" href="#pills-5" role="tab" aria-controls="pills-5" aria-selected="false">Historia</a>
                  </li>
                </ul>
            <div class="tab-content" id="pills-tabContent">
                         <h1 class="titulo-populares">Populares</h1>
              <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1">
                    <div class="card-body d-flex justify-content-center ">  
          

                       <div class="card-deck">
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada1.png" >
                <div class="">
                  <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada2.png" >
                <div class="">
                 <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada3.png" >
                <div class="">
                <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                       <div class="card fondo-trofeo">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada4.png" >
                <div class="">
                 <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card fondo-trofeo">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada5.png" >
                <div class="">
                  <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
             </div>






                </div>
              </div>
              <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2">
                    <div class="card-body d-flex justify-content-center ">  

                       <div class="card-deck">
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada1.png" >
                <div class="">
                  <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada2.png" >
                <div class="">
                 <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada3.png" >
                <div class="">
                <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                       <div class="card fondo-trofeo">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada4.png" >
                <div class="">
                 <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card fondo-trofeo">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada5.png" >
                <div class="">
                  <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
             </div>
                </div>
                          </div>
                          <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3">  <div class="card-body d-flex justify-content-center ">  


                       <div class="card-deck">
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada1.png" >
                <div class="">
                  <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada2.png" >
                <div class="">
                 <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada3.png" >
                <div class="">
                <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                       <div class="card fondo-trofeo">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada4.png" >
                <div class="">
                 <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card fondo-trofeo">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada5.png" >
                <div class="">
                  <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
             </div>
            </div>
               </div>
                <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4">  <div class="card-body d-flex justify-content-center ">  
          
            
                       <div class="card-deck">
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada1.png" >
                <div class="">
                  <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada2.png" >
                <div class="">
                 <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada3.png" >
                <div class="">
                <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                       <div class="card fondo-trofeo">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada4.png" >
                <div class="">
                 <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card fondo-trofeo">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada5.png" >
                <div class="">
                  <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
             </div>






    </div>
             </div>
              <div class="tab-pane fade" id="pills-5" role="tabpanel" aria-labelledby="pills-5">
                    <div class="card-body d-flex justify-content-center ">  
          
            
                       <div class="card-deck">
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada1.png" >
                <div class="">
                  <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada2.png" >
                <div class="">
                 <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card ">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada3.png" >
                <div class="">
                <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                       <div class="card fondo-trofeo">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada4.png" >
                <div class="">
                 <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
                      <div class="card fondo-trofeo">
                <img class=" img-portada-libro" src="../../../img/lectura/Portada5.png" >
                <div class="">
                  <h5 class="titulo-portada-libro">Morbi Finibus Leo</h5>
                  <p class="autor-libros">Vivamus cursus</p>

                </div>
              </div>
             </div>






                </div>
              </div>
            </div>
            </div>
                        </div>
                      </div>
     </section>
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
    
    
    
    <!-- Main File-->
    <script src="../../../js/front.js"></script>
  </body>
</html>