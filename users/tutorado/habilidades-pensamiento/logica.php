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
        $ConsultaLogica = mysqli_query($mysqli,"SELECT IDTutorado, Interpretacion FROM `test-logica` WHERE IDTutorado = '$tutorado'");
        $data2=mysqli_fetch_assoc($ConsultaLogica);
        $logica = $data2['IDTutorado'];
        $TOTAL = $data2['Interpretacion'];

        //EVALUACION INTERPRETACION
        if ($TOTAL >= 38) {
            $inter = "MUY ALTO";
            
        }elseif ($TOTAL >= 30) {
            $inter = "ALTO";
            
        }elseif ($TOTAL >= 28) {
            $inter = "POR ENCIMA DEL PROMEDIO";
            
        }elseif ($TOTAL >= 20) {
            $inter = "PROMEDIO ALTO";
            
        }elseif ($TOTAL >= 18) {
            $inter = "PROMEDIO";
            
        }elseif ($TOTAL >= 10) {
            $inter = "PROMEDIO BAJO";
            
        }elseif ($TOTAL >= 8) {
            $inter = "POR DEBAJO DEL PROMEDIO";
            
        }elseif ($TOTAL >= 1) {
            $inter = "BAJO";
            
        }elseif ($TOTAL >= 0) {
            $inter = "MUY BAJO";
            
        }

       if ($tutorado = $logica) {
            echo'<script type="text/javascript">
            alert("Ya respondiste este test, tu lógica es: '.$inter.'");
            window.location.href="../general/Logica.php";
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
     <link rel="stylesheet" href="../../../css/styleInputforms.css">
    <link rel="stylesheet" href="../../../css/stylelogica.css">
    
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
          <hr class="sidenav-heading justify-content-center">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="../index.php"> <i class="far fa-user"></i>Identificación</a>
            </li>
            <li><a href="../desarrollo-humano/index.php" aria-expanded="false" > <i class="far fa-smile-wink"></i>Desarrollo Humano </a>
            </li>
            <li><a href="../habilidades-pensamiento/index.php" aria-expanded="false" > <i class="far fa-lightbulb fa-2x"></i>Pensamiento </a>
              
            </li>
            <li><a href="./fortalecimiento/index.php" aria-expanded="false" > <i class="fas fa-dumbbell"></i>Fortalecimiento </a>
            
            </li>
            <li><a href="../general/normateca-books.php" aria-expanded="false" > <i class="fas fa-book"></i>Material de Lectura</a>
            
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
                            <a style="font-size: 20px;font-family: lato; " href="index.php">
                                Pensamiento
                            </a>
                        </li>
                        <div style="font-size: 20px;font-family: lato; ">&nbsp; > &nbsp;</div>
                        <li class="active">
                            <a style="font-size: 20px;">
                                <u>Lógica</u>
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
                  
        <div class="container">

<form role="form" id="form" method="POST" action="consultas/insertar-logica.php" >
  <?php while($datosconsulta = mysqli_fetch_array($consultas)) { ?>
    <textarea name="IDTutorado" hidden=""><?php echo $datosconsulta['IDTutorado']; ?></textarea>
  <?php } ?>
   
     <div class="row setup-content wow slideInRight" id="step-1">
        <div class="col-md-12">
            <div class="col-xs-12">
                
                
                  <div class="container"> <br><br><br><br> 
                <div class=" d-flex justify-content-center  ">
               
              <h4 class=" titulo-form-personal" >"La lógica es la madre de toda ciencia."<br> <span class="titulo-form-autor float-right">Andrzej Sapkowski</span> </h4>
                   
                    
  
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               
               <div class="form-group ">
                
             
                   
              <label class="col-form-label col-md-12 text-left">1.- La conclusión que deriva de las premisas es:<br><br>
                      P1. Todos los mamíferos tienen un sistema respiratorio.<br>
                      P2. Todos los humanos son mamíferos.</label>
                 <center>      
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio1" name="P1" value="0"  required type="radio"  />
                <label for="radio1">A) Todos los mamíferos son humanos.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio2" name="P1" value="0" type="radio"/>
                <label for="radio2">B) No todos los humanos son mamíferos.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio3" name="P1" value="1" type="radio"/>
                <label for="radio3">C) Todos los humanos tienen un sistema respiratorio.</label>
              </div>
               </center>
                </div>
                
             
              
            </div>
        </div>
        </div>
            <button class="btn previousBtn2" type="button">Anterior</button>
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
             <label class="col-form-label col-md-12 text-left">2.- La conclusión que deriva de las premisas es:<br><br>
                       P1. Todos los seres humanos respiran.<br>
                       P2. El profesor de lógica es humano.</label>
                       
                 <center>      
                
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio5" name="P2" value="0"  type="radio" required />
                <label for="radio5">A) No todos los profesores respiran.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio6" name="P2" value="1" type="radio"/>
                <label for="radio6">B) El profesor de lógica respira.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio7" name="P2" value="0" type="radio"/>
                <label for="radio7">C) Todos los seres humanos son profesores.</label>
              </div>
       
               </center>
                </div>
                
             
              
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">3.- La conclusión que deriva de las premisas es:<br> <br>
                      P1. Todos los caninos son mamíferos.<br>
                      P2. Todos los perros son caninos.</label>
                 <center>      
                
             
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio9" name="P3" value="0" required="required" type="radio" />
                <label for="radio9">A) Todos los mamíferos son caninos.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio10" name="P3" value="0"  type="radio"/>
                <label for="radio10">B) No todos los perros son mamíferos.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio12" name="P3" value="1" type="radio"/>
                <label for="radio12">C) Todos los perros son mamíferos.</label>
              </div>
       
               </center>
                </div>
                
             
              
            </div>
        </div>
        </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
                      
                <label class="col-form-label col-md-12 text-left">4.- La conclusión que deriva de las premisas es:<br><br>
                      P1.  Todos los perros ladran.<br>
                      P2.  Patitas es un perro.</label>
                       
                 <center>      
                
             
              
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio14" name="P4" value="1" required="required" type="radio" />
                <label for="radio14">A) Patitas ladra.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio15" name="P4" value="0" type="radio"/>
                <label for="radio15">B) Todos los perros son patitas.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio16" name="P4" value="0" type="radio"/>
                <label for="radio16">C) Gotita ladra.</label>
              </div>
       
               </center>
                </div>
                
             
              
            </div>
        </div>
        </div>
            <button class="btn previousBtn2" type="button">Anterior</button>
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">5.- La conclusión que deriva de las premisas es:<br><br>
                      P1. Todo pez respira por las branquias. <br>P2. La mojarra es un pez.</label>
                       
                 <center>               
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio171" name="P5" value="0" required="" type="radio" />
                <label for="radio171">A) El pulpo es un pez.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio18" name="P5" value="1" required="" type="radio"/>
                <label for="radio18">B) Por lo tanto, la mojarra, respira por medio de las branquias.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio19" name="P5" value="0" required="" type="radio"/>
                <label for="radio19">C) La mojarra respira por los pulmones.</label>
              </div>
       
               </center>
                </div>
                
             
              
            </div>
        </div>
        </div>
            <button class="btn previousBtn2" type="button">Anterior</button>
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">6.- La conclusión que deriva de las premisas es:<br><br>
                    P1. Ningún africano es bondadoso.<br>
					P2. Todo argelino es africano.</label>
                       
                       
                 <center>               
            
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio21" name="P6" value="1" required="" type="radio" />
                <label for="radio21">A) Por lo tanto, ningún argelino es bondadoso.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio22" name="P6" value="0" required="" type="radio"/>
                <label for="radio22">B) Todos los africanos son argelinos.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio23" name="P6" value="0" required="" type="radio"/>
                <label for="radio23">C) Todo argelino es bondadoso.</label>
              </div>
              
               </center>
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">7.- La conclusión que deriva de las premisas es:<br><br>
					P1. Los moluscos son invertebrados.<br>
					P2. El pulpo es un molusco.</label>
                       
                       
                 <center>               
            
                       
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio25" name="P7" value="0" required="" type="radio" />
                <label for="radio25">A) Todos los moluscos son pulpos.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio26" name="P7" value="0" required="" type="radio"/>
                <label for="radio26">B) El pulpo es vertebrado.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio27" name="P7" value="1" required="" type="radio"/>
                <label for="radio27">C) El pulpo es invertebrado.</label>
              </div>
              
               </center>
                
                
             
              
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">8.- La conclusión que deriva de las premisas es:<br><br>
					P1. Toda ave es bípeda.<br>
					P2. El colibrí es ave.</label>
                 <center>               
                       
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio29" name="P8" value="1" required="" type="radio" />
                <label for="radio29">A) El colibrí es bípedo.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio30" name="P8" value="0" required="" type="radio"/>
                <label for="radio30">B) Todas las aves son colibrí.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio31" name="P8" value="0" required="" type="radio"/>
                <label for="radio31">C) No todas las aves son bípedas.</label>
              </div>
              
               </center>
                
                
             
              
            </div>
        </div>
        </div>
              </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">9.- La conclusión que deriva de las premisas es:<br><br>
					P1. Todo metal se dilata con el calor.<br>
					P2. La plata es un metal.</label>
                 <center>               
                  
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio33" name="P9" value="0" required="" type="radio" />
                <label for="radio33">A) La plata no se dilata.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio34" name="P9" value="1" required="" type="radio"/>
                <label for="radio34">B) La plata se dilata con el calor.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio35" name="P9" value="0" required="" type="radio"/>
                <label for="radio35">C) Todo metal es plata.</label>
              </div>
              
               </center>
                
                
             
              
            </div>
        </div>
        </div>
              </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">10.- La conclusión que deriva de las premisas es:<br><br>
				P1. Ningún mamífero es pez.<br>
				P2. Toda morsa es mamífero.</label>
                 <center>               

              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio38" name="P10" value="0" required="" type="radio" />
                <label for="radio38">A) La morsa no es un mamífero.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio39" name="P10" value="0" required="" type="radio"/>
                <label for="radio39">B) La morsa es pez.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio40" name="P10" value="1"  required="" type="radio"/>
                <label for="radio40">C) Ninguna morsa es pez.</label>
              </div>
               </center>              
            </div>
        </div>
        </div>         
        </div>
            <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
             
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-12">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">1.- Seleccione la respuesta que corresponde a la palabra que mejor complete la analogía:<br><br><center><h4>Rector: Universidad ::  director general: ?</h4></center></label>
                 <center>               
                       
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio42" name="P11" value="1" required="" type="radio" />
                <label for="radio42">A) Escuela.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio43" name="P11" value="0" required="" type="radio"/>
                <label for="radio43">B) Coordinación.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio44" name="P11" value="0" required="" type="radio"/>
                <label for="radio44">C) Departamento.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio45" name="P11" value="0" required="" type="radio"/>
                <label for="radio45">D) Unidad.</label>
              </div>
               </center>              
            </div>
        </div>
        </div></div>
        <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-13">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">2.- Seleccione la respuesta que corresponde a la palabra que mejor complete la analogía:<br><br><center><h4>Triste : contento :: lloroso : ?</h4></center></label>
                 <center>               
                       
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio45-2" name="P12" value="0" required="" type="radio" />
                <label for="radio45-2">A) Feliz.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio46" name="P12" value="1" required="" type="radio"/>
                <label for="radio46">B) Sonriente.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio47" name="P12" value="0" required="" type="radio"/>
                <label for="radio47">C) Infeliz.</label>
              </div>
              <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio47-2" name="P12" value="0" required="" type="radio"/>
                <label for="radio47-2">D) Disgustado.</label>
              </div>
               </center>              
            </div>
        </div>
        </div>
               </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
             
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-14">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">3.- Seleccione la respuesta que corresponde a la palabra que mejor complete la analogía:<br><br><center><h4>Centavo : peso :: día : ?</h4></center></label>
                 <center>               
                       
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio48" name="P13" value="0" required="" type="radio" />
                <label for="radio48">A) Edad.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio49" name="P13" value="0" required="" type="radio"/>
                <label for="radio49">B) Calendario.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio50" name="P13" value="1" required="" type="radio"/>
                <label for="radio50">C) Año.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio51" name="P13" value="0" required="" type="radio"/>
                <label for="radio51">D) Tiempo.</label>
              </div>
              
               </center>              
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-15">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">4.- Seleccione la respuesta que corresponde a la palabra que mejor complete la analogía:<br><br><center><h4>1 : 9 :: primero : ?</h4></center></label>
                 <center>               
        
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio52" name="P14" value="0" required="" type="radio" />
                <label for="radio52">A) Inicio.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio53" name="P14" value="0" required="" type="radio"/>
                <label for="radio53">B) Número.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio54" name="P14" value="0" required="" type="radio"/>
                <label for="radio54">C) Letra.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio55" name="P14" value="1" required="" type="radio"/>
                <label for="radio55">D) Noveno.</label>
              </div>
              
               </center>              
            </div>
        </div>
        </div>
              </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-16">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">5.- Seleccione la respuesta que corresponde a la palabra que mejor complete la analogía:<br><br><center><h4>Segadora : trigo :: tijeras :</h4></center></label>
                 <center>                         
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio56" name="P15" value="0" required="" type="radio" />
                <label for="radio56">A) Utensilio.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio57" name="P15" value="0" required="" type="radio"/>
                <label for="radio57">B) Herramienta.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio58" name="P15" value="1" required="" type="radio"/>
                <label for="radio58">C) Tela.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio59" name="P15" value="0" required="" type="radio"/>
                <label for="radio59">D) Corte.</label>
              </div>
              
               </center>              
            </div>
        </div>
        </div>
               </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
             
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-17">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                
                      
                <label class="col-form-label col-md-12 text-left">6.- Seleccione la respuesta que corresponde a la palabra que mejor complete la analogía:<br><br><center><h4>Perro : carnívoro :: caballo : ?</h4></center></label>
                 <center>                         
             
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio60" name="P16" value="a" required="" type="radio" />
                <label for="radio60">A) Herbívoro.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio61" name="P16" value="0" required="" type="radio"/>
                <label for="radio61">B) Mamífero.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio62" name="P16" value="0" required="" type="radio"/>
                <label for="radio62">C) Animal.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio63" name="P16" value="0" required="" type="radio"/>
                <label for="radio63">D) Cuadrúpedo.</label>
              </div>
               </center>              
            </div>
        </div>
        </div>
               </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
             
         </div>
    </div>
    </div>
     <div class="row setup-content  " id="step-18">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">7.- Seleccione la respuesta que corresponde a la palabra que mejor complete la analogía:<br><br><center><h4>Corazón : aparato circulatorio :: estomago : ?</h4></center></label>
                 <center>                         
                     
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio64" name="P17" value="0" required="" type="radio" />
                <label for="radio64">A) Cuerpo humano.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio65" name="P17" value="0" required="" type="radio"/>
                <label for="radio65">B) Aparato respiratorio.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio66" name="P17" value="1" required="" type="radio"/>
                <label for="radio66">C) Aparato digestivo.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio67" name="P17" value="0" required="" type="radio"/>
                <label for="radio67">D) Digestión.</label>
              </div>
               </center>              
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-19">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">8.- Seleccione la respuesta que corresponde a la palabra que mejor complete la analogía:<br><br><center><h4>Triángulo : figura geométrica :: cinco : ?</h4></center></label>
                 <center>                         
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio68" name="P18" value="1" required="" type="radio" />
                <label for="radio68">A) Valor numérico.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio69" name="P18" value="0" required="" type="radio"/>
                <label for="radio69">B) Número.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio70" name="P18" value="0" required="" type="radio"/>
                <label for="radio70">C) Quinto.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio71" name="P18" value="0" required="" type="radio"/>
                <label for="radio71">D) Orden.</label>
              </div>
               </center>              
            </div>
        </div>
        </div>
               </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
             
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-20">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">9.- Seleccione la respuesta que corresponde a la palabra que mejor complete la analogía:<br><br><center><h4>Centímetro : longitud :: centímetro cúbico : ?</h4></center></label>
                 <center>                         
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio72" name="P19" value="0" required="" type="radio" />
                <label for="radio72">A) Metro cúbico.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio73" name="P19" value="0" required="" type="radio"/>
                <label for="radio73">B) Espacio.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio74" name="P19" value="0" required="" type="radio"/>
                <label for="radio74">C) Medida.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio75" name="P19" value="1" required="" type="radio"/>
                <label for="radio75">D) Volumen.</label>
              </div>
               </center>              
            </div>
        </div>
        </div>
              </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
     <div class="row setup-content  " id="step-21">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">10.- Seleccione la respuesta que corresponde a la palabra que mejor complete la analogía:<br><br><center><h4>Luna : tierra :: marte : ?</h4></center></label>
                 <center>                         

              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio76" name="P20" value="0" required="" type="radio" />
                <label for="radio76">A) Planeta.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio77" name="P20" value="0" required="" type="radio"/>
                <label for="radio77">B) Júpiter.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio78" name="P20" value="1" required="" type="radio"/>
                <label for="radio78">C) Sol.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio79" name="P20" value="0" required="" type="radio"/>
                <label for="radio79">D) Galaxia.</label>
              </div>
               </center>              
            </div>
        </div>
        </div>
                </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
            
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-22">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente secuencias de patrones</label>
                   <label><strong>
							<br><br></strong></label>
                      <div class="container-fluid">
						  <div class="row" >

							<img src="../../../img/patrones1.png" class=" animated pulse d-block w-100 h-100" alt="">
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">1.- Complete la secuencia correspondiente.</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1" class="patron1">
			<input type="radio" name="P21" class="patron1" id="patron1" value="0" required />
			<img src="../../../img/logica/P1a.png" alt="" >
			</label>

        <label for="patron2" class="patron2">
			<input type="radio" name="P21" class="patron2" id="patron2" value="0"  />
			<img src="../../../img/logica/P1b.png" alt="">
			</label>

        <label for="patron3" class="patron3">
			<input type="radio" name="P21" class="patron3" id="patron3" value="1"/>
			<img src="../../../img/logica/P1c.png" alt="">
			</label>

        <label for="patron4" class="patron4">
			<input type="radio" name="P21" class="patron4" id="patron4" value="0" />
			<img src="../../../img/logica/P1d.png" alt="">
			</label>
    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-23">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente secuencias de patrones</label>
                   
                      <div class="container-fluid">
						  <div class="row" >

								<img src="../../../img/patrones2.png" class=" animated pulse d-block w-100 h-100" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">2.- Complete la secuencia correspondiente.</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-2" class="patron1">
			<input type="radio" name="P22" class="patron1" id="patron1-2" value="0" required />
			<img src="../../../img/logica/P2a.png" alt="" >
			</label>

        <label for="patron2-2" class="patron2">
			<input type="radio" name="P22" class="patron2" id="patron2-2" value="0"  />
			<img src="../../../img/logica/P2b.png" alt="">
			</label>

        <label for="patron3-2" class="patron3">
			<input type="radio" name="P22" class="patron3" id="patron3-2" value="1"/>
			<img src="../../../img/logica/P2c.png" alt="">
			</label>

        <label for="patron4-2" class="patron4">
			<input type="radio" name="P22" class="patron4" id="patron4-2" value="0" />
			<img src="../../../img/logica/P2d.png" alt="">
			</label>
    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-24">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente secuencias de patrones</label>
                   
                      <div class="container-fluid">
						  <div class="row" >

							<img src="../../../img/patrones3.png" class=" animated pulse d-block w-100 h-100" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">3.- Complete la secuencia correspondiente.</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-3" class="patron1">
			<input type="radio" name="P23" class="patron1" id="patron1-3" value="0" required />
			<img src="../../../img/logica/P3a.png" alt="" >
			</label>

        <label for="patron2-3" class="patron2">
			<input type="radio" name="P23" class="patron2" id="patron2-3" value="0"  />
			<img src="../../../img/logica/P3b.png" alt="">
			</label>

        <label for="patron3-3" class="patron3">
			<input type="radio" name="P23" class="patron3" id="patron3-3" value="0"/>
			<img src="../../../img/logica/P3c.png" alt="">
			</label>

        <label for="patron4-3" class="patron4">
			<input type="radio" name="P23" class="patron4" id="patron4-3" value="1" />
			<img src="../../../img/logica/P3d.png" alt="">
			</label>
    </div>  
                           
            </div>
        </div>
        </div>
              </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-25">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente secuencias de patrones</label>
                   
                      <div class="container-fluid">
						  <div class="row" >

							<img src="../../../img/patron4.png" class=" animated pulse d-block w-100 h-100" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">4.- Complete la secuencia correspondiente.</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-4" class="patron1">
			<input type="radio" name="P24" class="patron1" id="patron1-4" value="1" required  />
			<img src="../../../img/logica/P4a.png" alt="" >
			</label>

        <label for="patron2-4" class="patron2">
			<input type="radio" name="P24" class="patron2" id="patron2-4" value="0"  />
			<img src="../../../img/logica/P4b.png" alt="">
			</label>

        <label for="patron3-4" class="patron3">
			<input type="radio" name="P24" class="patron3" id="patron3-4" value="0"/>
			<img src="../../../img/logica/p4c.png" alt="">
			</label>

        <label for="patron4-4" class="patron4">
			<input type="radio" name="P24" class="patron4" id="patron4-4" value="0" />
			<img src="../../../img/logica/P4d.png" alt="">
			</label>

    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-26">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente secuencias de patrones</label>
                   
                      <div class="container-fluid">
						  <div class="row" >

										<img src="../../../img/Patron5.png" class=" animated pulse d-block w-100 h-100" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">5.- Complete la secuencia correspondiente.</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-5" class="patron1">
			<input type="radio" name="P25" class="patron1" id="patron1-5" value="0" required />
			<img src="../../../img/logica/P5a.png" alt="" >
			</label>

        <label for="patron2-5" class="patron2">
			<input type="radio" name="P25" class="patron2" id="patron2-5" value="0"  />
			<img src="../../../img/logica/P5b.png" alt="">
			</label>

        <label for="patron3-5" class="patron3">
			<input type="radio" name="P25" class="patron3" id="patron3-5" value="1"/>
			<img src="../../../img/logica/P5c.png" alt="">
			</label>

        <label for="patron4-5" class="patron4">
			<input type="radio" name="P25" class="patron4" id="patron4-5" value="0" />
			<img src="../../../img/logica/P5d.png" alt="">
			</label>

    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-27">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">6.- Si niño es igual a ñsnm x y bebé es zwzw, entonces a bote le corresponde:</label>
                 <center>                         
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio80" name="P26" value="0" required="" type="radio" />
                <label for="radio80">A) ylgv.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio81" name="P26" value="0" required="" type="radio"/>
                <label for="radio81">B) zngw.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio82" name="P26" value="1" required="" type="radio"/>
                <label for="radio82">C) zmhw.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio83" name="P26" value="0" required="" type="radio"/>
                <label for="radio83">D) ywvs.</label>
              </div>
               </center>              
            </div>
        </div>
        </div>
                </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
            
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-28">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">7.- Si coco es igual a eqeq x y paco es rceq, entonces a bono le corresponde.</label>
                 <center>                           
                       
              <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio84" name="P27" value="0" required="" type="radio" />
                <label for="radio84">A)	eqec.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio85" name="P27" value="1" required="" type="radio"/>
                <label for="radio85">B)	dqoq.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio86" name="P27" value="0" required="" type="radio"/>
                <label for="radio86">C)	qecr.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio87" name="P27" value="0" required="" type="radio"/>
                <label for="radio87">D)	dqpq.</label>
              </div>
               </center>              
            </div>
        </div>
        </div>
               </div>
               <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
            
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-29">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">8.- ¿Cuál es el siguiente número de la secuencia?</label>
                            <center><table class="table">
              <thead>
                <tr>
                  <th scope="col">1</th>
                  <th scope="col">7</th>
                  <th scope="col">5</th>
                  <th scope="col">11</th>
                  <th scope="col">9</th>
                  <th scope="col">15</th>
                  <th scope="col">13</th>
                  <th scope="col">?</th>
                </tr>
              </thead>

            </table></center>
            <center>                          
                       
                 <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio88" name="P28" value="0" required="" type="radio" />
                <label for="radio88">A)	15.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio89" name="P28" value="0" required="" type="radio"/>
                <label for="radio89">B)	18.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio90" name="P28" value="0" required="" type="radio"/>
                <label for="radio90">C)	9.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio91" name="P28" value="1" required="" type="radio"/>
                <label for="radio91">D)	19.</label>
              </div>
               </center>              
            </div>
        </div>
        </div>
                </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
            
         </div>
    </div>
    </div>  
    <div class="row setup-content  " id="step-30">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">9.- ¿Cuál es el siguiente número de la secuencia?</label>
                            <center><table class="table">
              <thead>
                <tr>
                  <th scope="col">8</th>
                  <th scope="col">12</th>
                  <th scope="col">18</th>
                  <th scope="col">28</th>
                  <th scope="col">?</th>
                </tr>
              </thead>

            </table></center>
            <center>                          
                       
                 <div class="inputGroup col-md-11 col-sm-12">
                <input id="radio92" name="P29" value="0" required="" type="radio" />
                <label for="radio92">A)	10.</label>
              </div>
              <div class="inputGroup2 col-md-11 col-sm-12">
                <input id="radio92-2" name="P29" value="1" required="" type="radio"/>
                <label for="radio92-2">B) 44.</label>
              </div>
              <div class="inputGroup3 col-md-11 col-sm-12">
                <input id="radio93" name="P29" value="0" required="" type="radio"/>
                <label for="radio93">C)	22.</label>
              </div>
                <div class="inputGroup4 col-md-11 col-sm-12">
                <input id="radio94" name="P29" value="0" required="" type="radio"/>
                <label for="radio94">D)	43.</label>
              </div>
               </center>              
            </div>
        </div>
        </div>
                </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
            
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-31">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente secuencias de patrones</label>
                   <label><strong>
							<br><br></strong></label>
                      <div class="container-fluid">
						  <div class="row" >

								<img src="../../../img/patron6.png" class=" animated pulse d-block w-100 h-100" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">10.- Complete la secuencia correspondiente.</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-6" class="patron1">
			<input type="radio" name="P30" class="patron1" id="patron1-6" value="0" required />
			<img src="../../../img/logica/P6a.png" alt="" >
			</label>

        <label for="patron2-6" class="patron2">
			<input type="radio" name="P30" class="patron2" id="patron2-6" value="0"  />
			<img src="../../../img/logica/P6b.png" alt="">
			</label>

        <label for="patron3-6" class="patron3">
			<input type="radio" name="P30" class="patron3" id="patron3-6" value="0"/>
			<img src="../../../img/logica/P6c.png" alt="">
			</label>

        <label for="patron4-6" class="patron4">
			<input type="radio" name="P30" class="patron4" id="patron4-6" value="0" />
			<img src="../../../img/logica/P6d.png" alt="">
			</label>

    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-32">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente secuencias de patrones</label>
                   <label><strong>
							<br><br></strong></label>
                      <div class="container-fluid">
						  <div class="row" >

						<img src="../../../img/Patron7.png" class=" animated pulse d-block w-100 h-100" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">11.- Complete la secuencia correspondiente.</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-7" class="patron1">
			<input type="radio" name="P31" class="patron1" id="patron1-7" value="0" required />
			<img src="../../../img/logica/P7a.png" alt="" >
			</label>

        <label for="patron2-7" class="patron2">
			<input type="radio" name="P31" class="patron2" id="patron2-7" value="0"  />
			<img src="../../../img/logica/P7b.png" alt="">
			</label>

        <label for="patron3-7" class="patron3">
			<input type="radio" name="P31" class="patron3" id="patron3-7" value="0"/>
			<img src="../../../img/logica/P7c.png" alt="">
			</label>

        <label for="patron4-7" class="patron4">
			<input type="radio" name="P31" class="patron4" id="patron4-7" value="0" />
			<img src="../../../img/logica/P7d.png" alt="">
			</label>

    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-33">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente ilustracion</label>
                   <label><strong>
							<br><br></strong></label>
                      <div class="container-fluid">
						  <div class="row" >

								<img src="../../../img/cuboejemplo.png" class=" animated pulse d-block w-100 h-100" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">1.- ¿Cuál es el cubo que hay que mover de la primera construcción para obtener la segunda?</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-8" class="patron1">
			<input type="radio" name="P32" class="patron1" id="patron1-8" value="0" required />
			<img src="../../../img/logica/c1a.png" alt="" >
			</label>

        <label for="patron2-8" class="patron2">
			<input type="radio" name="P32" class="patron2" id="patron2-8" value="0"  />
			<img src="../../../img/logica/c1b.png" alt="">
			</label>

        <label for="patron3-8" class="patron3">
			<input type="radio" name="P32" class="patron3" id="patron3-8" value="1"/>
			<img src="../../../img/logica/c1c.png" alt="">
			</label>

        <label for="patron4-8" class="patron4">
			<input type="radio" name="P32" class="patron4" id="patron4-8" value="0" />
			<img src="../../../img/logica/c1d.png" alt="">
			</label>

    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-34">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente ilustracion</label>
                   <label><strong>
							<br><br></strong></label>
                      <div class="container-fluid">
						  <div class="row" >

				<img src="../../../img/cuboejemplo2.png" class=" animated pulse d-block w-100 h-100" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">2.- ¿Cuál es el cubo que hay que mover de la primera construcción para obtener la segunda?</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-9" class="patron1">
			<input type="radio" name="P33" class="patron1" id="patron1-9" value="0" required />
			<img src="../../../img/logica/c2a.png" alt="" >
			</label>

        <label for="patron2-9" class="patron2">
			<input type="radio" name="P33" class="patron2" id="patron2-9" value="1"  />
			<img src="../../../img/logica/c2b.png" alt="">
			</label>

        <label for="patron3-9" class="patron3">
			<input type="radio" name="P33" class="patron3" id="patron3-9" value="0"/>
			<img src="../../../img/logica/c2c.png" alt="">
			</label>

        <label for="patron4-9" class="patron4">
			<input type="radio" name="P33" class="patron4" id="patron4-9" value="0" />
			<img src="../../../img/logica/c2d.png" alt="">
			</label>

    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-35">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente ilustracion</label>
                   <label><strong>
							<br><br></strong></label>
                      <div class="container-fluid">
						  <div class="row" >

				  <img src="../../../img/cuboejemplo3.png" class=" animated pulse d-block w-50 h-50" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">3.- ¿Cuál de las 4 figuras se puede armar al doblar el modelo siguiente:
</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-10" class="patron1">
			<input type="radio" name="P34" class="patron1" id="patron1-10" value="0" required />
			<img src="../../../img/logica/c3a.png" alt="" >
			</label>

        <label for="patron2-10" class="patron2">
			<input type="radio" name="P34" class="patron2" id="patron2-10" value="0"  />
			<img src="../../../img/logica/c3b.png" alt="">
			</label>

        <label for="patron3-10" class="patron3">
			<input type="radio" name="P34" class="patron3" id="patron3-10" value="0"/>
			<img src="../../../img/logica/c3c.png" alt="">
			</label>

        <label for="patron4-10" class="patron4">
			<input type="radio" name="P34" class="patron4" id="patron4-10" value="1" />
			<img src="../../../img/logica/c3.png" alt="">
			</label>

    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-36">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente ilustracion</label>
                   <label><strong>
							<br><br></strong></label>
                      <div class="container-fluid">
						  <div class="row" >

						<img src="../../../img/cuboejemplo4.png" class=" animated pulse d-block w-50 h-50" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">4.- Si se dobla la figura por la línea punteada, ¿qué forma resultará?</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-11" class="patron1">
			<input type="radio" name="P35" class="patron1" id="patron1-11" value="1" required />
			<img src="../../../img/logica/c4a.png" alt="" >
			</label>

        <label for="patron2-11" class="patron2">
			<input type="radio" name="P35" class="patron2" id="patron2-11" value="0"  />
			<img src="../../../img/logica/c4b.png" alt="">
			</label>

        <label for="patron3-11" class="patron3">
			<input type="radio" name="P35" class="patron3" id="patron3-11" value="0"/>
			<img src="../../../img/logica/c4c.png" alt="">
			</label>

        <label for="patron4-11" class="patron4">
			<input type="radio" name="P35" class="patron4" id="patron4-11" value="0" />
			<img src="../../../img/logica/c4d.png" alt="">
			</label>

    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-37">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente ilustracion</label>
                   <label><strong>
							<br><br></strong></label>
                      <div class="container-fluid">
						  <div class="row" >

						<img src="../../../img/cuboejemplo5.png" class=" animated pulse d-block w-50 h-50" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">5.- ¿Cuál opción muestra una vista correcta de la figura?</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-12" class="patron1">
			<input type="radio" name="P36" class="patron1" id="patron1-12" value="0" required />
			<img src="../../../img/logica/c5a.png" alt="" >
			</label>

        <label for="patron2-12" class="patron2">
			<input type="radio" name="P36" class="patron2" id="patron2-12" value="0"  />
			<img src="../../../img/logica/c5b.png" alt="">
			</label>

        <label for="patron3-12" class="patron3">
			<input type="radio" name="P36" class="patron3" id="patron3-12" value="1"/>
			<img src="../../../img/logica/c5c.png" alt="">
			</label>

        <label for="patron4-12" class="patron4">
			<input type="radio" name="P36" class="patron4" id="patron4-12" value="0" />
			<img src="../../../img/logica/c5d.png" alt="">
			</label>

    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
    <div class="row setup-content  " id="step-38">
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
        <div class="stepwizard-step step" style="display: none">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">2</p></a> 
            
        </div>
        <div class="stepwizard-step step" style="display: none" >
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">3</p></a> 
            
        </div> 
           <div class="stepwizard-step step" style="display: none"  >
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">4</p></a> 
            
        </div>
         <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-6" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">5</p></a> 
            
        </div>
         <div class="stepwizard-step step" style="display: none" >
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
        <div class="stepwizard-step step" >
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-26" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">25</p></a> 
        </div><div class="stepwizard-step step" style="display: none">
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
        <div class="stepwizard-step step" >
           <div class="progress"></div>
            <a href="#step-36" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">35</p></a> 
        </div>
        <div class="stepwizard-step step" style="display: none">
           <div class="progress"></div>
            <a href="#step-37" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">36</p></a> 
        </div>
         <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-38" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">37</p></a> 
             <div class="progress progress-final"></div>
        </div>
       <div class="stepwizard-step step" style="display: none;">
            <a href="#step-39" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><p class="titulo-num">38</p></a> 
            
        </div>
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body card fondo-card">
        <div class="col-md-12">
            <div class="col-xs-12 ">
               <div class="form-group ">
               
                <label class="col-form-label col-md-12 text-left">Observa la siguiente ilustracion</label>
                   <label><strong>
							<br><br></strong></label>
                      <div class="container-fluid">
						  <div class="row" >

						<img src="../../../img/cuboejemplo6.png" class=" animated pulse d-block w-50 h-50" alt="">
							<!-- Count item widget-->
							</div>
						  </div>
              <br>                      
        
              <p class="txtpatron">6.- ¿Cuál es la plantilla correcta del cubo?</p> <br>
              <div class="rating d-flex justify-content-center">
     	

        <label for="patron1-13" class="patron1">
			<input type="radio" name="P37" class="patron1" id="patron1-13" value="0" required />
			<img src="../../../img/logica/c6a.png" alt="" >
			</label>

        <label for="patron2-13" class="patron2">
			<input type="radio" name="P37" class="patron2" id="patron2-13" value="1"  />
			<img src="../../../img/logica/c6b.png" alt="">
			</label>

        <label for="patron3-13" class="patron3">
			<input type="radio" name="P37" class="patron3" id="patron3-13" value="0"/>
			<img src="../../../img/logica/c6c.png" alt="">
			</label>

        <label for="patron4-13" class="patron4">
			<input type="radio" name="P37" class="patron4" id="patron4-13" value="0" />
			<img src="../../../img/logica/c6d.png" alt="">
			</label>
            <input type="text" name="notificacion" id="notificacion" value="Trofeo-HabilidadDelPensamiento desbloqueado" hidden=""/>
            <input type="text" name="edo_notificacion" id="edo_notificacion" value="0" hidden=""/>
            
            <input type="text" name="notificacion2" id="notificacion2" value="Avatar-3 desbloqueado" hidden=""/>
            <input type="text" name="edo_notificacion2" id="edo_notificacion2" value="0" hidden=""/>
    </div>  
                           
            </div>
        </div>
        </div>
              </div>
              <button class="btn previousBtn2" type="button">Anterior</button>
               <button class="btn nextBtn float-right" type="button">Continuar</button>
              
         </div>
    </div>
    </div>
   
   
    
    <div class="row setup-content  animated slideInRight" id="step-39">
        <div class="col-md-12">
           
           <center>
            <div class="col-md-12">
               <br>
               <br>
                <h1 class="titulo-salir">iHas completado Lógica!</h1>
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