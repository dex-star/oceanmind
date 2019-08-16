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
        $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $data=mysqli_fetch_assoc($ConsultaTutorado);
        $tutorado = $data['IDTutorado'];

        //CONSULTA IDLINEAVIDA
        $ConsultaLineaVida = mysqli_query($mysqli,"SELECT IDTutorado FROM `test-autoestima` WHERE IDTutorado = '$tutorado'");
        $data2=mysqli_fetch_assoc($ConsultaLineaVida);
        $lineavida = $data2['IDTutorado'];

        if ($tutorado = $lineavida) {
            echo'<script type="text/javascript">
            alert("Ya has respondido este test");
            window.location.href="index.php";
            </script>';
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
    
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <!--css slider normateca-->
    <link rel="stylesheet" href="../../../css/styleforms.css">
    <link rel="stylesheet" href="../../../css/styleradio.css">
     <link rel="stylesheet" href="../../../css/styleradio.css">
     <link rel="stylesheet" href="../../../css/styleInputforms.css">
    
    
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
                            echo '<div class="sidenav-header-inner text-center"><img src="../../../img/avatares/avatar-logica.png" alt="person" class="img-fluid ">';
                        }else{
                            echo '<div class="sidenav-header-inner text-center"><img src="../../../img/avatares/avatar-desarrollo-humano.png" alt="person" class="img-fluid ">';    
                        }
                        
                     }else{
                        echo '<div class="sidenav-header-inner text-center"><img src="../../../img/avatares/avatar-identificacion.png" alt="person" class="img-fluid ">';                    
                     }
                      
                  }else{
                      echo '<div class="sidenav-header-inner text-center"><img src="../../../img/avatares/avatar-inicial.png" alt="person" class="img-fluid ">';
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
            <li><a href="../habilidades-pensamiento/index.php" aria-expanded="false"> <i class="far fa-lightbulb fa-2x"></i>Pensamiento </a>
             
            </li>
            <li><a href="../fortalecimiento/index.php" aria-expanded="false" > <i class="fas fa-dumbbell"></i>Fortalecimiento </a>
             
            </li>
            <li><a href="../general/normateca-books.php" aria-expanded="false" > <i class="fas fa-book"></i>Material de Lectura </a>
             
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
                        <div style="font-size: 20px;">&nbsp; > &nbsp;</div>
                        <li>
                            <a style="font-size: 20px; font-family:lato;" href="index.php">
                                Desarrollo Humano
                            </a>
                        </li>
                        <div style="font-size: 20px;">&nbsp; > &nbsp;</div>
                        <li class="active">
                            <a style="font-size: 20px;font-family:lato;">
                                <u>Autoestima</u>
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
     <!--Inicio de Preguntas-->
     
        <div class="row justify-content-center mt-5 col-sm-12   ml-1 mr-1 container">
           <div class="col-md-10 col-sm-12 col-xs-12 ">
              <div class="">  
                  
        <div class="container">

<form role="form" id="form" method="POST" action="consultas/insertar-autoestima.php" >
   <?php while($datosconsulta = mysqli_fetch_array($consultas)) { ?>
      <textarea name="IDTutorado" hidden=""><?php echo $datosconsulta['IDTutorado']; ?></textarea>
    <?php } ?>
   
     <div class="row setup-content wow slideInRight" id="step-1">
        <div class="col-md-12">
            <div class="col-xs-12">
                
                
                  <div class="container"> <br><br><br>
                <div class=" d-flex justify-content-center  ">
               
              <h4 class=" titulo-form-personal" >"Quererse a uno mismo es el principio de un romance para toda la vida"<br> <span class="titulo-form-autor float-right">Oscar Wilde</span> </h4>
                   
                    
  
                </div>
                </div>
         
                
            </div>
             <button class="btn btn-inicio nextBtn float-right " type="button" >Continuar</button>
        </div>
       
    </div>
    <div class="row setup-content  " id="step-2">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  <div class="stepwizard">
    <div class="setup-panel">
       <div class="main-wrap">
       <div class="step-progress text-center ">
       
        <div class="stepwizard-step step active" style="display: none;"  >
            <a href="#step-1" type="" class="point btn btn-primary btn-circle" onclick="toggle(this)"></a>
        </div>
        <div class="stepwizard-step step ">
           <div class="progress progress-inicio" ></div>
            <a href="#step-2" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">1</p>
            </a>
            </div>
        <div class="stepwizard-step step">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-7" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">6</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-8" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">7</p></a> 
        
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-9" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">8</p></a> 
            
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-10" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">9</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-11" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">10</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-12" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">11</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                
             
                 <label class="col-form-label col-md-12 ">1.- A la hora de tomar decisiones en tu vida, como proponer cosas nuevas en el trabajo, iniciar alguna actividad de ocio, o elegir un color nuevo para pintar tu casa, ¿sueles buscar la aprobación o el apoyo de las personas que te rodean?</label>        
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio1" name="P1" value="4"  required type="radio"  />
                <label for="radio1">A) No, consideras que tu opinión sea buena y que la de los demás no tenga por qué serlo siempre.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio2" name="P1" value="2" type="radio"/>
                <label for="radio2">B) Sí, pero sólo ante las decisiones que consideras demasiado importantes como para actuar precipitadamente.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio3" name="P1" value="1" type="radio"/>
                <label for="radio3">C) Sí, siempre que puedes consultas con los demás. Te equivocas con frecuencia y quieres hacer las cosas bien.</label>
              </div>
              <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio4" name="P1" value="3" type="radio"/>
                <label for="radio4">D) Depende de la decisión. Sueles tener claro lo que vas a hacer, pero consideras las posibilidades que te ofrecen los demás.</label>
              </div> 
                </div>
                </center>
             
              
            </div>
        </div>
        </div>
            
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-3">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  <div class="stepwizard">
    <div class="setup-panel">
       <div class="main-wrap">
       <div class="step-progress text-center ">
       
        <div class="stepwizard-step step active" style="display: none;"  >
            <a href="#step-1" type="" class="point btn btn-primary btn-circle" onclick="toggle(this)"></a>
        </div>
        <div class="stepwizard-step step ">
           <div class="progress progress-inicio" ></div>
            <a href="#step-2" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">1</p>
            </a>
            </div>
        <div class="stepwizard-step step">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-7" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">6</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-8" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">7</p></a> 
        
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-9" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">8</p></a> 
            
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-10" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">9</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-11" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">10</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-12" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">11</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">2.- Imagina que estás en una reunión social o familiar importante; adviertes que no vas vestido para la ocasión y que desentonas con los demás, ¿cómo te comportas?</label>        
                       
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio5" name="P2" value="3" type="radio" required />
                <label for="radio5">A) No le das importancia, te comportas con naturalidad y si alguien te lo comenta haces alguna broma al respecto.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio6" name="P2" value="1" type="radio"/>
                <label for="radio6">B) Te da mucha vergüenza. Procuras situarte en algún lugar discreto y pasar desapercibido.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio7" name="P2" value="4" type="radio"/>
                <label for="radio7">C) Te sientes incómodo pero tratas de no pensar en ello, te integras en la reunión y das alguna excusa por tu error.</label>
              </div>
              <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio8" name="P2" value="1" type="radio"/>
                <label for="radio8">D) No te importa nada en absoluto, aunque no lleves la ropa adecuada tienes estilo y sabes llevar bien cualquier cosa.</label>
              </div> 
                </div>
                </center>
             
              
            </div>
        </div>
        </div>
             <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-4">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  <div class="stepwizard">
    <div class="setup-panel">
       <div class="main-wrap">
       <div class="step-progress text-center ">
       
        <div class="stepwizard-step step active" style="display: none;"  >
            <a href="#step-1" type="" class="point btn btn-primary btn-circle" onclick="toggle(this)"></a>
        </div>
        <div class="stepwizard-step step ">
           <div class="progress progress-inicio" ></div>
            <a href="#step-2" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">1</p>
            </a>
            </div>
        <div class="stepwizard-step step">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-7" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">6</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-8" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">7</p></a> 
        
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-9" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">8</p></a> 
            
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-10" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">9</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-11" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">10</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-12" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">11</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">3.- Tienes muchas ganas de irte a comprar ropa y le pides a algún amigo que te acompañe. Esta persona es más alta y más atractiva que tú, y todo lo que se prueba le queda mucho mejor que a ti.</label>        
               
                       
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio9" name="P3" value="2" required="required" type="radio" />
                <label for="radio9">A) Admiras el estilo de tu acompañante, al final compras un par de prendas necesarias pero muy simples en cuanto a forma y color.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio10" name="P3" value="4"  type="radio"/>
                <label for="radio10">B) No estás dispuesto a que te gane, decides comprar varias prendas muy modernas y bastante caras.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio12" name="P3" value="3" type="radio"/>
                <label for="radio12">C) Admiras su estilo pero eres muy consciente del tuyo, compras la ropa que mejor te sienta y que necesitas, y pasáis un rato ameno probándoos cosas diferentes.</label>
              </div>
              <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio13" name="P3" value="1P4" value="2" type="radio"/>
                <label for="radio13">D) A su lado te sientes bastante poca cosa, te quita las ganas de probarte nada y mucho menos de comprar. Pones una excusa y te marchas.</label>
              </div>         
                </div>
                </center>
             
              
            </div>
        </div>
        </div>
            <button class="btn previousBtn2 " type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-5">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  <div class="stepwizard">
    <div class="setup-panel">
       <div class="main-wrap">
       <div class="step-progress text-center ">
       
        <div class="stepwizard-step step active" style="display: none;"  >
            <a href="#step-1" type="" class="point btn btn-primary btn-circle" onclick="toggle(this)"></a>
        </div>
        <div class="stepwizard-step step ">
           <div class="progress progress-inicio" ></div>
            <a href="#step-2" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">1</p>
            </a>
            </div>
        <div class="stepwizard-step step">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-7" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">6</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-8" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">7</p></a> 
        
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-9" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">8</p></a> 
            
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-10" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">9</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-11" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">10</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-12" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">11</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">4.- Un día conoces a alguien nuevo y muy interesante, estas charlando animadamente y llega el momento de hablar de ti, ¿cuál de las siguientes opciones mejor se ajusta a lo que cuentas?</label>        
                    
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio14" name="P4" value="1" required="required" type="radio" />
                <label for="radio14">A) No crees que tengas mucho que contar, tu trabajo es muy corriente, tus amigos son normales y tus aficiones también. Prefieres que esta persona te cuente su vida.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio15" name="P4" value="3" type="radio"/>
                <label for="radio15">B) Tu trabajo te gusta y aunque sea corriente, siempre lo enfocas desde una perspectiva interesante, tus aficiones son tu pasión y disfrutas hablando de ellas, también hablas de tus proyectos futuros.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio16" name="P4" value="2" type="radio"/>
                <label for="radio16">C) Hablas en líneas generales de tu trabajo y de tus aficiones, sobre todo hablas de tus amigos y de lo más interesante de sus vidas.</label>
              </div>
              <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio17" name="P4" value="4P5" value="2" type="radio"/>
                <label for="radio17">D) Más que de tu trabajo actual, hablas de tus proyectos y de tus objetivos, y de lo que vas a hacer para lograrlos, de lo buenas que son tus amistades y lo poco usual de tus aficiones. Te gusta hablar de ti.</label>
              </div>     
              
                </div>
                </center>
             
              
            </div>
        </div>
        </div>
            <button class="btn previousBtn2 " type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-6">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  <div class="stepwizard">
    <div class="setup-panel">
       <div class="main-wrap">
       <div class="step-progress text-center ">
       
        <div class="stepwizard-step step active" style="display: none;"  >
            <a href="#step-1" type="" class="point btn btn-primary btn-circle" onclick="toggle(this)"></a>
        </div>
        <div class="stepwizard-step step ">
           <div class="progress progress-inicio" ></div>
            <a href="#step-2" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">1</p>
            </a>
            </div>
        <div class="stepwizard-step step">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-7" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">6</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-8" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">7</p></a> 
        
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-9" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">8</p></a> 
            
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-10" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">9</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-11" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">10</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-12" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">11</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">5.-  En tu lugar de trabajo o de estudios, se está explicando algo que es completamente nuevo para ti. Llega un momento en que te das cuenta que no has entendido casi nada ¿qué haces?</label>                   
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio42" name="P5" value="4" required="" type="radio" />
                <label for="radio42">A) Paras la explicación y requieres que se empiece de nuevo, si tú no lo entiendes habrá mucha gente que tampoco lo haga.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio18" name="P5" value="2" required="" type="radio"/>
                <label for="radio18">B) Si hay más gente que pregunte tu también lo haces, si no, buscas al ponente para que te aclare las dudas.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio19" name="P5" value="1" required="" type="radio"/>
                <label for="radio19">C) Te da mucha vergüenza preguntar y demostrar así que no entiendes. Más tarde preguntarás a algún amigo o intentarás informarte por tu cuenta.</label>
              </div>
              <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio20" name="P5" value="3" required="" type="radio"/>
                <label for="radio20">D) Tomas nota de lo que no entiendes para preguntarlo al finalizar la charla, si sigues con dudas pedirás información complementaria para prepararte mejor.</label>
              </div>
              
                </div>
                </center>
             
              
            </div>
        </div>
        </div>  
                <button class="btn previousBtn2 " type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-7">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  <div class="stepwizard">
    <div class="setup-panel">
       <div class="main-wrap">
       <div class="step-progress text-center ">
       
        <div class="stepwizard-step step active" style="display: none;"  >
            <a href="#step-1" type="" class="point btn btn-primary btn-circle" onclick="toggle(this)"></a>
        </div>
        <div class="stepwizard-step step ">
           <div class="progress progress-inicio" ></div>
            <a href="#step-2" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">1</p>
            </a>
            </div>
        <div class="stepwizard-step step">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-7" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">6</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-8" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">7</p></a> 
        
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-9" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">8</p></a> 
            
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-10" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">9</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-11" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">10</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-12" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">11</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">6.- Tener un trabajo bien remunerado y que nos guste es algo difícil de conseguir, si tuvieras que valorar tu empleo o tu situación laboral, ¿cómo la definirías?</label>                   
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio21" name="P6" value="3" required="" type="radio" />
                <label for="radio21">A) Satisfactoria, tratas de buscar el lado positivo de las cosas y nunca te faltan proyectos y objetivos que perseguir.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio22" name="P6" value="1" required="" type="radio"/>
                <label for="radio22">B) Horrible, no obstante, sabes que las cosas están mal y que tienes que aguantar lo que sea. Estás muy agradecido por tener trabajo.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio23" name="P6" value="4P7" value="2" required="" type="radio"/>
                <label for="radio23">C) No te preocupa especialmente el tema, tienes un montón de proyectos más importantes y con tu valía los alcanzarás.</label>
              </div>
              <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio24" name="P6" value="2" required="" type="radio"/>
                <label for="radio24">D) Has logrado que no te afecte, consideras más importante tu vida personal y privada y eso es por lo que luchas.</label>
              </div>
                </div>
                </center>
             
              
            </div>
        </div>
        </div>
                <button class="btn previousBtn2 " type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-8">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  <div class="stepwizard">
    <div class="setup-panel">
       <div class="main-wrap">
       <div class="step-progress text-center ">
       
        <div class="stepwizard-step step active" style="display: none;"  >
            <a href="#step-1" type="" class="point btn btn-primary btn-circle" onclick="toggle(this)"></a>
        </div>
        <div class="stepwizard-step step ">
           <div class="progress progress-inicio" ></div>
            <a href="#step-2" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">1</p>
            </a>
            </div>
        <div class="stepwizard-step step">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-7" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">6</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-8" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">7</p></a> 
        
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-9" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">8</p></a> 
            
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-10" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">9</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-11" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">10</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-12" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">11</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">7.- Has tenido un día duro, has trabajado con más ahínco para finalizar una tarea en la oficina, has hecho todas las gestiones que tenías pendientes, has resuelto un par de problemas domésticos y encima le has hecho un favor a un amigo. ¿Qué haces al llegar a casa?</label>                   
                       
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio25" name="P7" value="2" required="" type="radio" />
                <label for="radio25">A) Prefieres no pensarlo, el día ha sido duro pero para ti no es algo nuevo, solo pides poder dormir bien y que mañana sea un día más tranquilo.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio26" name="P7" value="4" required="" type="radio"/>
                <label for="radio26">B) Se lo cuentas a todo el mundo, te gusta que se te reconozca cuando haces las cosas bien y exiges en casa que te mimen por haberte esforzado tanto.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio27" name="P7" value="3" required="" type="radio"/>
                <label for="radio27">C) Estás muy satisfecho y decides darte un capricho, darte un baño de espuma y ver una buena película, o comprarte un regalito que hace tiempo querías.</label>
              </div>
              <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio28" name="P7" value="1P8" value="2" required="" type="radio"/>
                <label for="radio28">D) Te preocupa que se te haya olvidado algo o haber hecho algo mal por la prisa, repasas mentalmente las actividades y al día siguiente esperas no tener queja de nadie.</label>
              </div>
                </div>
                </center>
             
              
            </div>
        </div>
        </div>
                <button class="btn previousBtn2 " type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-9">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  <div class="stepwizard">
    <div class="setup-panel">
       <div class="main-wrap">
       <div class="step-progress text-center ">
       
        <div class="stepwizard-step step active" style="display: none;"  >
            <a href="#step-1" type="" class="point btn btn-primary btn-circle" onclick="toggle(this)"></a>
        </div>
        <div class="stepwizard-step step ">
           <div class="progress progress-inicio" ></div>
            <a href="#step-2" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">1</p>
            </a>
            </div>
        <div class="stepwizard-step step">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-7" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">6</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-8" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">7</p></a> 
        
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-9" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">8</p></a> 
            
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-10" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">9</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-11" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">10</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-12" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">11</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">8.- En tu trabajo están buscando a una persona que represente a la empresa en un concurso del ramo. Piden una persona que cumpla unos requisitos, entre ellos, explicar bien su trabajo y que haga una demostración práctica del mismo.</label>                   
                       
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio29" name="P8" value="1" required="" type="radio" />
                <label for="radio29">A) No te planteas ser voluntario, hay mil personas más capacitadas que tú para la  demostración y no se te da bien hablar en público.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio30" name="P8" value="3" required="" type="radio"/>
                <label for="radio30">B) Te presentas voluntario, puede ser una experiencia interesante y si sales elegido puedes hacer una presentación innovadora.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio31" name="P8" value="2" required="" type="radio"/>
                <label for="radio31">C) No te presentas, serías capaz de hacerla bien pero crees que hay gente mejor preparada y más original que tú.</label>
              </div>
              <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio32" name="P8" value="4P9" value="2" required="" type="radio"/>
                <label for="radio32">D) Te presentas y estás casi seguro de que te elegirán, haces buenos proyectos y darás una buena imagen de la empresa.</label>
              </div>
                </div>
                </center>
             
              
            </div>
        </div>
        </div>
        
                <button class="btn previousBtn2 " type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              </div>
         </div>
    </div>
        <div class="row setup-content  " id="step-10">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  <div class="stepwizard">
    <div class="setup-panel">
       <div class="main-wrap">
       <div class="step-progress text-center ">
       
        <div class="stepwizard-step step active" style="display: none;"  >
            <a href="#step-1" type="" class="point btn btn-primary btn-circle" onclick="toggle(this)"></a>
        </div>
        <div class="stepwizard-step step ">
           <div class="progress progress-inicio" ></div>
            <a href="#step-2" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">1</p>
            </a>
            </div>
        <div class="stepwizard-step step">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-7" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">6</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-8" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">7</p></a> 
        
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-9" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">8</p></a> 
            
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-10" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">9</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-11" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">10</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-12" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">11</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">9.- ¿Con cuál de las siguientes frases sobre la buena fortuna estás más de acuerdo?</label>               
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio33" name="P9" value="4" required="" type="radio" />
                <label for="radio33">A) La buena suerte puede tocarle a todo el mundo, yo me considero una persona afortunada a la que la vida le sonríe.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio34" name="P9" value="2" required="" type="radio"/>
                <label for="radio34">B) Para tener buena suerte hay que trabajar duro, sólo los muy afortunados la tienen sin apenas esfuerzo.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio35" name="P9" value="1" required="" type="radio"/>
                <label for="radio35">C) Yo no tengo suerte,  tanto los premios como las cosas especia les sólo les pasan a los demás.</label>
              </div>
              <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio36" name="P9" value="3" required="" type="radio"/>
                <label for="radio36">D) La suerte respecto a los premios es una cuestión de probabilidad, y respecto a las cosas de la vida, siempre depende de cómo se perciban.</label>
              </div>
                </div>
                </center>
             
              
            </div>
        </div>
        </div>
        
                <button class="btn previousBtn2 " type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-11">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  <div class="stepwizard">
    <div class="setup-panel">
       <div class="main-wrap">
       <div class="step-progress text-center ">
       
        <div class="stepwizard-step step active" style="display: none;"  >
            <a href="#step-1" type="" class="point btn btn-primary btn-circle" onclick="toggle(this)"></a>
        </div>
        <div class="stepwizard-step step ">
           <div class="progress progress-inicio" ></div>
            <a href="#step-2" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">1</p>
            </a>
            </div>
        <div class="stepwizard-step step">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-7" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">6</p></a> 
            
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-8" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">7</p></a> 
        
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-9" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">8</p></a> 
            
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-10" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">9</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-11" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">10</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-12" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">11</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">10.- En una fiesta en la que no conoces a nadie excepto a los anfitriones, te presentan a un grupo de personas de aspecto interesante. ¿Cuál es tu actitud?</label>               
                       
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio38" name="P10" value="3" required="" type="radio" />
                <label for="radio38">A) Te interesa conocerlos no sólo para pasar un buen rato en la reunión sino porque puede ser una forma de iniciar una amistad.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio39" name="P10" value="1" required="" type="radio"/>
                <label for="radio39">B) Esperas causarles una buena impresión y decir cosas que les puedan interesar.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio40" name="P10" value="4" required="" type="radio"/>
                <label for="radio40">C) Te gustaría llevarles a tu terreno en la conversación para así poder hablar de los temas que más te interesan.</label>
              </div>
              <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio41" name="P10" value="2" required="" type="radio"/>
                <label for="radio41">D) Antes de iniciar una conversación escuchas lo que dicen, y es peras para hablar a que lo hagan de temas que tú conozcas.</label>
              </div>
              <input id="notificacion" name="notificacion" value="Trofeo-Autoestima desbloqueado" type="text" hidden=""/>
              <input id="edo_notificacion" name="edo_notificacion" value="0" type="text" hidden=""/>
                </div>
                </center>
             
              
            </div>
        </div>
        </div>
            <button class="btn previousBtn2 " type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              </div>
         </div>
    </div>
     <div class="row setup-content  animated slideInRight" id="step-12">
        <div class="col-md-12">
           
           <center>
            <div class="col-md-12">
               <br>
               <br>
                <h1 class="titulo-salir">iHas completado Autoestima!</h1>
                <br>
                <button class="btn btn-salir nextBtn" required  type="submit">Finalizar</button>
            
            </div>
            </center>
        </div>
    </div>
</form>
</div>       
    </div>
       
            </div>
                </div>       
     
      <!--Fin de Preguntas-->
      
       
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
    <script src="../../../js/wow.min.js"></script>
    <script src="../../../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
    <script src="../../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../../js/indexform.js"></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
     <script src="../../../js/indexdash.js"></script>
    <script src="../../../js/inputform.js"></script>
    
    
    <script>
      new WOW().init();
      </script>
    <!-- Main File-->
    <script src="../../../js/front.js"></script>
  </body>
</html>