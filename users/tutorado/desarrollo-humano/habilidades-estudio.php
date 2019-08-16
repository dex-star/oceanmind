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
        $ConsultaHabilidades = mysqli_query($mysqli,"SELECT IDTutorado, Interpretacion   FROM `habilidades-estudio` WHERE IDTutorado = '$tutorado'");
        $data2=mysqli_fetch_assoc($ConsultaHabilidades);
        $Habilidades = $data2['IDTutorado'];
        $TOTAL = $data2['Interpretacion'];

        if ($TOTAL >= 57) {
            $inter = "MUY ALTO";
            
        }elseif ($TOTAL >= 52) {
            $inter = "ALTO";
            
        }elseif ($TOTAL >= 50) {
            $inter = "POR ENCIMA DEL PROMEDIO";
            
        }elseif ($TOTAL >= 48) {
            $inter = "PROMEDIO ALTO";
            
        }elseif ($TOTAL >= 43) {
            $inter = "PROMEDIO";
            
        }elseif ($TOTAL >= 39) {
            $inter = "PROMEDIO BAJO";
            
        }elseif ($TOTAL >= 37) {
            $inter = "POR DEBAJO DEL PROMEDIO";
            
        }elseif ($TOTAL >= 34) {
            $inter = "BAJO";
            
        }elseif ($TOTAL >= 0) {
            $inter = "MUY BAJO";
            
        }        

        if ($tutorado = $Habilidades) {
            echo'<script type="text/javascript">
            alert("Ya has respondido este test, tu habilidad para el estudio es: '.$inter.'");
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
    <link rel="stylesheet" href="../../../css/stylelike.css">
    
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
          <hr class="sidenav-heading justify-content-center">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="../index.php"> <i class="far fa-user"></i>Identificación</a>
            </li>
            <li><a href="../desarrollo-humano/index.php" aria-expanded="false"> <i class="far fa-smile-wink"></i>Desarrollo Humano </a>
             
            </li>
            <li><a href="../habilidades-pensamiento/index.php" aria-expanded="false" > <i class="far fa-lightbulb fa-2x"></i>Pensamiento </a
            </li>
            <li><a href="../fortalecimiento/index.php" aria-expanded="false"> <i class="fas fa-dumbbell"></i>Fortalecimiento </a
            </li>
            <li><a href="../general/normateca-books.php" aria-expanded="false"> <i class="fas fa-book"></i>Normateca </a>
              
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
                            <a style="font-size: 20px;font-family: lato;" href="index.php">
                                Desarrollo Humano
                            </a>
                        </li>
                        <div style="font-size: 20px;">&nbsp; > &nbsp;</div>
                        <li class="active">
                            <a style="font-size: 20px;font-family: lato;">
                               <u> Habilidades de Estudio</u>
                            </a>
                        </li>
                    </ol>
                </div>
                  
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Logros dropdown-->
               
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
                 <div class=" d-flex justify-content-center ">
                  <div class="stepwizard" id="stepwizard">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-7" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">6</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-8" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">7</p></a> 
        
        </div>
         <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-9" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">8</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-10" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">9</p></a> 
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-11" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">10</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-12" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">11</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-13" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">12</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-14" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">13</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-15" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">14</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-16" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">15</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-17" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">16</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-18" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">17</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-19" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">18</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-20" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">19</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-21" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">20</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-22" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">21</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-23" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">22</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-24" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">23</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-25" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">24</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-27" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">26</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-28" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">27</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-29" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">28</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-30" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">29</p></a> 
        </div>
           <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-31" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">30</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-32" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">31</p></a> 
        </div>
           <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-33" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">32</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-34" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">33</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-35" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">34</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
           <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
        </div>
           <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-40" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">39</p></a> 
        </div>
           <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-41" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">40</p></a> 
        </div>
           <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-42" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">41</p></a> 
        </div>
           <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-43" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">42</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-44" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">43</p></a> 
        </div>
           <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-45" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">44</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-46" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">45</p></a> 
        </div>
           <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-47" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">46</p></a> 
        </div>
           <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-48" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">47</p></a> 
        </div>
           <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-49" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">48</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-50" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">49</p></a> 
        </div>
           <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-51" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">50</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-52" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">51</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-53" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">52</p></a> 
        </div>
           <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-54" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">53</p></a> 
        </div>
           <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-55" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">54</p></a> 
        </div>
           
         <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-56" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">55</p></a> 
             
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-57" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">56</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-58" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">57</p></a> 
             
        </div><div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-59" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">58</p></a> 
             
        </div><div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-60" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">59</p></a> 
             <div class="progress progress-final"></div>
        </div><div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-61" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">60</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-62" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">61</p></a> 
        </div>
        </div> 
    </div>    
    </div>
</div>
   
    
                </div>
        <div class="container">


<form role="form" id="form" method="POST" action="consultas/insertar-habilidades-estudio.php">
         <?php while($datosconsulta = mysqli_fetch_array($consultas)) { ?>
    <textarea name="IDTutorado" hidden=""><?php echo $datosconsulta['IDTutorado']; ?></textarea>
  <?php } ?> 
     <div class="row setup-content wow slideInRight" id="step-1">
        <div class="col-md-12">
            <div class="col-xs-12">
            
                
                  <div class="container"> <br><br><br> 
                <div class=" d-flex justify-content-center  ">
               
               <h4 class=" titulo-form-personal" >"La mente es como un paracaídas, solo funciona si se abre"<br> <span class="titulo-form-autor float-right">Albert Einstein</span> </h4>
                   
                    
  
                </div>
                </div>
         
                
            </div>
             <button class="btn btn-inicio nextBtn float-right " type="button" >Continuar</button>
             
        </div>
       
    </div>
     <div class="row setup-content  " id="step-2">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
               <br><br>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                
                 <label class="col-form-label col-md-12 ">A.- ¿Sueles dejar para el último la preparación de tus trabajos?</label>   
                       
                    <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes1" class="radio-button nextBtn" type="radio" name="P1" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no1" class="radio-button nextBtn" type="radio" name="P1" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>

                      
                </div>
                       
                </center>
             
              
            </div>
        </div>
        </div>
              
              </div>
         </div>
    </div>
      <div class="row setup-content  " id="step-3">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                
             
                 <label class="col-form-label col-md-12 ">B.- ¿Crees que el sueño o el cansancio te impidan estudiar eficazmente en muchas ocasiones?</label>   
                       
                <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes2" class="radio-button nextBtn" type="radio" name="P2" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no2" class="radio-button nextBtn" type="radio" name="P2" value="0P3" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>

        
                      
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
        <div class="row setup-content  " id="step-4">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
               
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                
             
                 <label class="col-form-label col-md-12 ">C.- ¿Es frecuente que no termines tu tarea a tiempo?</label>   
               
 
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes3" class="radio-button nextBtn" type="radio" name="P3" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no3" class="radio-button nextBtn" type="radio" name="P3" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>
                       
                
        
                      
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
              
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-5">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                
             
                 <label class="col-form-label col-md-12 ">D.- ¿Te sorprendes con cierta frecuencia, pensando en algo que no tiene nada que ver con lo que estudias?</label>   
                
                   <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes4" class="radio-button nextBtn" type="radio" name="P4" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no4" class="radio-button nextBtn" type="radio" name="P4" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>         
                          
                
        
                      
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-6">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                
             
                 <label class="col-form-label col-md-12 ">E.- ¿Sueles tener dificultad en entender tus apuntes de clase cuando tratas de repasarlos, después de cierto tiempo?</label>   
                
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes5" class="radio-button nextBtn" type="radio" name="P5" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no5" class="radio-button nextBtn" type="radio" name="P5" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>          
        
                      
                </div>
                 <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-7">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">

                 <label class="col-form-label col-md-12 ">F.- ¿Sueles dejar pasar un día o más antes de repasarlos apuntes tomados en clase?</label>   
                          <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes6" class="radio-button nextBtn" type="radio" name="P6" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no6" class="radio-button nextBtn" type="radio" name="P6" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                 
                </div>
                 <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-8">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">

                 <label class="col-form-label col-md-12 ">G.- ¿Sueles dedicar tu tiempo libre entre las 4:00 de la tarde y las 9:00 de la noche a otras actividades que no sean estudiar?</label>   
                <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes7" class="radio-button nextBtn" type="radio" name="P7" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no7" class="radio-button nextBtn" type="radio" name="P7" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-9">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">

                 <label class="col-form-label col-md-12 ">H.- ¿Descubres algunas veces de pronto, que debes entregar una tarea antes de lo que creías?</label>   
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes8" class="radio-button nextBtn" type="radio" name="P8" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no8" class="radio-button nextBtn" type="radio" name="P8" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                     
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
              
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-10">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">

                 <label class="col-form-label col-md-12 ">I.- ¿Te retrasas, con frecuencia, en una asignatura debido a que tienes que estudiar otra?</label> 
                     
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes9" class="radio-button nextBtn" type="radio" name="P9" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no9" class="radio-button nextBtn" type="radio" name="P9" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                     
                </div>
                 <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
              
              </div>
         </div>
    </div>
       <div class="row setup-content  " id="step-11">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">

                 <label class="col-form-label col-md-12 ">J.- ¿Te parece que tu rendimiento es muy bajo, en relación con el tiempo que dedicas al estudio?</label> 
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes10" class="radio-button nextBtn" type="radio" name="P10" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no10" class="radio-button nextBtn" type="radio" name="P10" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                     
                     
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-12">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">

                 <label class="col-form-label col-md-12 ">K.- ¿Está situado tu escritorio directamente frente a una ventana, puerta u otra fuente de distracción?</label> 
                         <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes11" class="radio-button nextBtn" type="radio" name="P11" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no11" class="radio-button nextBtn" type="radio" name="P11" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                     
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-13">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
               
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">

                 <label class="col-form-label col-md-12 ">L.- ¿Sueles tener fotografías, trofeos o recuerdos sobre tu mesa de escritorio?</label> 
                     <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes12" class="radio-button nextBtn" type="radio" name="P12" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no12" class="radio-button nextBtn" type="radio" name="P12" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                     
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
            </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-14">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">M.- ¿Sueles estudiar recostado en la cama o arrellanado en un asiento cómodo?</label> 
                       <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes13" class="radio-button nextBtn" type="radio" name="P13" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no13" class="radio-button nextBtn" type="radio" name="P13" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                     
                </div>
                    <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-15">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">N.- ¿Produce resplandor la lámpara que utilizas al estudiar?</label> 
                       <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes14" class="radio-button nextBtn" type="radio" name="P14" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no14" class="radio-button nextBtn" type="radio" name="P14" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                     
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-16">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                 <label class="col-form-label col-md-12 ">O.- Tu mesa de estudio ¿está tan desordenada y llena de objetos, que no dispones de sitio suficiente para estudiar con eficacia.</label> 
                       <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes15" class="radio-button nextBtn" type="radio" name="P15" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no15" class="radio-button nextBtn" type="radio" name="P15" value="0P16" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                     
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-17">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">P.- ¿Sueles interrumpir tu estudio, por personas que vienen a visitarte?</label>
                       
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes16" class="radio-button nextBtn" type="radio" name="P16" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no16" class="radio-button nextBtn" type="radio" name="P16" value="0P17" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                        
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-18">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">Q.- ¿Estudias, con frecuencia, mientras tienes puesta la televisión y/o la radio?</label>
                      
                    <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes17" class="radio-button nextBtn" type="radio" name="P17" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no17" class="radio-button nextBtn" type="radio" name="P17" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                             
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
             
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-19">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
               
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">R.- En el lugar donde estudias, ¿se pueden ver con facilidad revistas, fotos de jóvenes o materiales pertenecientes a tu afición?</label>
                         <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes18" class="radio-button nextBtn" type="radio" name="P18" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no18" class="radio-button nextBtn" type="radio" name="P18" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                        
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-20">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">S.- ¿Con frecuencia, interrumpen tu estudio, actividades o ruidos que provienen del exterior?</label>
                     
                       
                 <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes19" class="radio-button nextBtn" type="radio" name="P19" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no19" class="radio-button nextBtn" type="radio" name="P19" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                        
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-21">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
   
   
    
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">T.- ¿Suele hacerse lento tu estudio debido a que no tienes a la mano los libros y los materiales necesarios?</label>
                     <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes20" class="radio-button nextBtn" type="radio" name="P20" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no20" class="radio-button nextBtn" type="radio" name="P20" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                        
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <!--Tecnicas de Estudio-->
    <div class="row setup-content  " id="step-22">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">A.- ¿Tiendes a comenzar la lectura de un libro de texto sin hojear previamente los subtítulos y las ilustraciones?</label>
                       <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes21" class="radio-button nextBtn" type="radio" name="P21" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no21" class="radio-button nextBtn" type="radio" name="P21" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                         
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-23">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">B.- ¿Te saltas por lo general las figuras, gráficas y tablas cuando estudias un tema?</label>
                       
                            <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes22" class="radio-button nextBtn" type="radio" name="P22" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no22" class="radio-button nextBtn" type="radio" name="P22" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                         
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-24">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
             
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">C.- ¿Suelo serte difícil seleccionar los puntos de los temas de estudio?</label>
                           <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes23" class="radio-button nextBtn" type="radio" name="P23" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no23" class="radio-button nextBtn" type="radio" name="P23" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                         
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-25">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
               
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">D.- ¿Te sorprendes con cierta frecuencia, pensando en algo que no tiene nada que ver con lo que estudias?</label>
                <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes24" class="radio-button nextBtn" type="radio" name="P24" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no24" class="radio-button nextBtn" type="radio" name="P24" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                         
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-26">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">E.- ¿Sueles tener dificultad en entender tus apuntes de clase cuando tratas de repasarlos, después de cierto tiempo?</label>
                    
                <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes25" class="radio-button nextBtn" type="radio" name="P25" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no25" class="radio-button nextBtn" type="radio" name="P25" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                               
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-27">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">F.- Al tomar notas, ¿te sueles quedar atrás con frecuencia debido a que no puedes escribir con suficiente rapidez?</label>
                    
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes26" class="radio-button nextBtn" type="radio" name="P26" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no26" class="radio-button nextBtn" type="radio" name="P26" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                            
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-28">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">G.- Poco después de comenzar un curso, ¿sueles encontrarte con tus apuntes formando un “revoltijo"?</label>
                       <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes27" class="radio-button nextBtn" type="radio" name="P27" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no27" class="radio-button nextBtn" type="radio" name="P27" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                            
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-29">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">H.- ¿Tomas normalmente tus apuntes tratando de escribir las palabras exactas del docente?</label>
                        
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes28" class="radio-button nextBtn" type="radio" name="P28" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no28" class="radio-button nextBtn" type="radio" name="P28" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                            
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-30">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">I.- Cuando tomas notas de un libro, ¿tienes la costumbre de copiar el material necesario, palabra por Palabra?</label>
                        <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes29" class="radio-button nextBtn" type="radio" name="P29" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no29" class="radio-button nextBtn" type="radio" name="P29" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                            
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-31">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
              
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">J.- ¿Te es difícil preparar un temario apropiado para una evaluación?</label>
                <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes30" class="radio-button nextBtn" type="radio" name="P30" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no30" class="radio-button nextBtn" type="radio" name="P30" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                            
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-32">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">K.- ¿Tienes problemas para organizar los datos o el contenido de una evaluación?</label>
                <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes31" class="radio-button nextBtn" type="radio" name="P31" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no31" class="radio-button nextBtn" type="radio" name="P31" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-33">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">L.- ¿Al repasar el temario de una evaluación formulas un resumen de este?</label>
                        <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes32" class="radio-button nextBtn" type="radio" name="P32" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no32" class="radio-button nextBtn" type="radio" name="P32" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-34">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">M.- ¿Te preparas a veces para un evaluación memorizando fórmulas, definiciones o reglas que no entiendes con claridad?</label>
                        <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes33" class="radio-button nextBtn" type="radio" name="P33" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no33" class="radio-button nextBtn" type="radio" name="P33" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                       
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-35">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">N.- ¿Te resulta difícil decidir qué estudiar y cómo estudiarlo cuando preparas una evaluación?</label>
                <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes34" class="radio-button nextBtn" type="radio" name="P34" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no34" class="radio-button nextBtn" type="radio" name="P34" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                       
                       
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-36">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
              
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">O.- ¿Sueles tener dificultades para organizar, en un orden lógico, las asignaturas que debes estudiar por temas?</label>
                       
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes35" class="radio-button nextBtn" type="radio" name="P35" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no35" class="radio-button nextBtn" type="radio" name="P35" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                       
                       
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-37">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                 
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">P.- Al preparar evaluación, ¿sueles estudiar toda la asignatura, en el último momento?</label>
                        <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes36" class="radio-button nextBtn" type="radio" name="P36" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no36" class="radio-button nextBtn" type="radio" name="P36" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                       
                       
                       
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-38">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">Q.- ¿Sueles entregar tus exámenes sin revisarlos detenidamente, para ver si tienen algún error cometido por descuido?</label>
                    
                                  <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes37" class="radio-button nextBtn" type="radio" name="P37" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no37" class="radio-button nextBtn" type="radio" name="P37" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                       
                       
                       
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-39">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">R.- ¿Te es posible con frecuencia terminar una evaluación de exposición de un tema en el tiempo prescrito?</label>
                     
                     <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes38" class="radio-button nextBtn" type="radio" name="P38" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no38" class="radio-button nextBtn" type="radio" name="P38" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                       
                       
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-40">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
               
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">S.- ¿Sueles perder puntos en exámenes con preguntas de “Verdadero - falso", debido a que no lees detenidamente?</label>
                     <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes39" class="radio-button nextBtn" type="radio" name="P39" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no39" class="radio-button nextBtn" type="radio" name="P39" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                     
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-41">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
             
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">T.- ¿Empleas normalmente mucho tiempo en contestar la primera mitad de la prueba y tienes que apresurarte en la segunda?</label>
                     
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes40" class="radio-button nextBtn" type="radio" name="P40" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no40" class="radio-button nextBtn" type="radio" name="P40" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <!--Motivacion para el estudio-->
    <div class="row setup-content  " id="step-42">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">A.- Después de los primeros días o semanas del curso, ¿tiendes a perder interés por el estudio?</label>
                 <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes41" class="radio-button nextBtn" type="radio" name="P41" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no41" class="radio-button nextBtn" type="radio" name="P41" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-43">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">B.- ¿Crees que en general, basta estudiar lo necesario para obtener un "aprobado” en las asignaturas.</label>
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes42" class="radio-button nextBtn" type="radio" name="P42" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no42" class="radio-button nextBtn" type="radio" name="P42" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                    
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-44">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">C.- ¿Te sientes frecuentemente confuso o indeciso sobre cuáles deben ser tus metas formativas y profesionales?</label>
                        <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes43" class="radio-button nextBtn" type="radio" name="P43" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no43" class="radio-button nextBtn" type="radio" name="P43" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-45">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">D.- ¿Sueles pensar que no vale la pena el tiempo y el esfuerzo que son necesarios para lograr una educación universitaria?</label>
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes44" class="radio-button nextBtn" type="radio" name="P44" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no44" class="radio-button nextBtn" type="radio" name="P44" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                   
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-46">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">E.- ¿Crees que es más importante divertirte y disfrutar de la vida, que estudiar?</label>
                    
                       <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes45" class="radio-button nextBtn" type="radio" name="P45" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no45" class="radio-button nextBtn" type="radio" name="P45" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                  
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-47">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">F.- ¿Sueles pasar el tiempo de clase en divagaciones o soñando despierto en lugar de atender al docente?</label>
                      
                       <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes46" class="radio-button nextBtn" type="radio" name="P46" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no46" class="radio-button nextBtn" type="radio" name="P46" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-48">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">G.- ¿Te sientes habitualmente incapaz de concentrarte en tus estudios debido a que estas inquieto, aburrido o de mal humor?</label>

                           <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes47" class="radio-button nextBtn" type="radio" name="P47" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no47" class="radio-button nextBtn" type="radio" name="P47" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                  
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-49">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                  
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">H.- ¿Piensas con frecuencia que las asignaturas que estudias tienen poco valor practico para ti?</label>
                             <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes48" class="radio-button nextBtn" type="radio" name="P48" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no48" class="radio-button nextBtn" type="radio" name="P48" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                     
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-50">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
              
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">I.- ¿Sientes, frecuentes deseos de abandonar la escuela y conseguir un trabajo?</label>
                    
                <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes49" class="radio-button nextBtn" type="radio" name="P49" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no49" class="radio-button nextBtn" type="radio" name="P49" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                     
                       
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-51">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">J.- ¿Sueles tener la sensación de lo que se enseña en los centros docentes no te prepara para afrontar los problemas de la vida adulta?</label>
                    
                <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes50" class="radio-button nextBtn" type="radio" name="P50" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no50" class="radio-button nextBtn" type="radio" name="P50" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                     
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-52">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
              
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">K.- ¿Sueles dedicarte de modo casual, según el estado de ánimo en que te encuentres?</label>
                    <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes51" class="radio-button nextBtn" type="radio" name="P51" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no51" class="radio-button nextBtn" type="radio" name="P51" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                     
                       
                </div>
                 <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-53">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
               
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">L.- ¿Sueles tener fotografías, trofeos o recuerdos sobre tu mesa de escritorio?</label>
                    <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes52" class="radio-button nextBtn" type="radio" name="P52" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no52" class="radio-button nextBtn" type="radio" name="P52" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                          
                       
                </div>
                 <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-54">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
              
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">M.- ¿Esperas normalmente a que te fijen la fecha de un evaluación para comenzar a estudiar los textos o repasar tus apuntes de clases?</label>
                       <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes53" class="radio-button nextBtn" type="radio" name="P53" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no53" class="radio-button nextBtn" type="radio" name="P53" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                     
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-55">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
              
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">N - ¿Sueles pensar que los exámenes son pruebas penosas de las que no se puede escapar y respecto a las cuales lo que debe hacerse es sobrevivir, del modo que sea?</label>
                    
                     <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes54" class="radio-button nextBtn" type="radio" name="P54" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no54" class="radio-button nextBtn" type="radio" name="P54" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                                           
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
              
              </div>
         </div>
    </div>
    <div class="row setup-content  " id="step-56">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
          
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">O.- ¿Sientes con frecuencia que tus docentes no comprenden las necesidades de los estudiantes?</label>
                          <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes55" class="radio-button nextBtn" type="radio" name="P55" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no55" class="radio-button nextBtn" type="radio" name="P55" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                     
                      
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>
     <div class="row setup-content  " id="step-57">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">P.- ¿Tienes normalmente la sensación de que tus docentes exigen demasiadas horas de estudio fuera de clase?</label>
                         <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes56" class="radio-button nextBtn" type="radio" name="P56" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no56" class="radio-button nextBtn" type="radio" name="P56" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                     
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>  
        <div class="row setup-content  " id="step-58">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">Q.- ¿Dudas por lo general, en pedir ayuda a tus docentes en tareas que te son difíciles?</label>
                        <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes57" class="radio-button nextBtn" type="radio" name="P57" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no57" class="radio-button nextBtn" type="radio" name="P57" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                     
                       
                      
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>  
      <div class="row setup-content  " id="step-59">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
                
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">R.- ¿Sueles pensar que tus docentes no tienen contacto con los temas y sucesos de actualidad?</label>
                        <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes58" class="radio-button nextBtn" type="radio" name="P58" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no58" class="radio-button nextBtn" type="radio" name="P58" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                     
                      
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>     
      <div class="row setup-content  " id="step-60">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
              
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">S.- ¿Te sientes reacionado, por lo general, al hablar con tus docentes de tus proyectos futuros, de estudio o profesionales?</label>
                      <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes59" class="radio-button nextBtn" type="radio" name="P59" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no59" class="radio-button nextBtn" type="radio" name="P59" value="0" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                     
                      
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
              
              </div>
         </div>
    </div>      
      <div class="row setup-content  " id="step-61">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="">  
          <div class="card-body d-flex justify-content-center ">
   
   
    
                </div>
                
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <center>
               <div class="form-group ">
                  <label class="col-form-label col-md-12 ">T.- ¿Criticas con frecuencia a tus docentes cuando charlas con tus compañeros?</label>
                       <div class="container_icono">
                  <div class="radio-tile-group">

                    <div class="input-container">
                      <input id="yes60" class="radio-button nextBtn" type="radio" name="P60" value="1" />
                      <div class="radio-tile">
                        <div class="likes">
                          <i class="far fa-thumbs-up"></i>
                        </div>

                      </div>
                    </div>
                    <div class="espacio"></div>
                    <div class="input-container">
                      <input id="no60" class="radio-button nextBtn" type="radio" name="P60" value="0" />
                      <div class="radio-tile">
                          
                          <input id="notificacion" type="text" name="notificacion" value="Trofeo-HabilidadesDeEstudio desbloqueado" hidden=""/>
                          <input id="edo_notificacion" type="text" name="edo_notificacion" value="0" hidden=""/>
                          
                          <input id="notificacion2" type="text" name="notificacion2" value="Avatar-2 desbloqueado" hidden=""/>
                          <input id="edo_notificacion2" type="text" name="edo_notificacion2" value="0" hidden=""/>
                          
                        <div class="likes">
                          <i class="far fa-thumbs-down"></i>
                        </div>

                      </div>
                    </div>


                  </div>
                </div>                                                     
                      
                       
                </div>
                <button class="btn previousBtn " type="button">Anterior</button>
                </center>
             
              
            </div>
        </div>
        </div>
               
              </div>
         </div>
    </div>             
               
                   
        <div class="row setup-content  animated slideInRight" id="step-62">
        <div class="col-md-12">
           
           <center>
            <div class="col-md-12">
               <br>
               <br>
                <h1 class="titulo-salir">iHas completado Estilos de aprendizaje!</h1>
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
    
    <script src="../../../vendor/jquery.cookie/jquery.cookie.js"> </script>
    
    <script src="../../../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
    <script src="../../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../../js/indexform.js"></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
      <script src="../../../js/indexdash.js"></script>
    
    

    <!-- Main File-->
    <script src="../../../js/front.js"></script>
  </body>
</html>