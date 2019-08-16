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
        $ConsultaLineaVida = mysqli_query($mysqli,"SELECT IDTutorado FROM `ficha-identificacion` WHERE IDTutorado = '$tutorado'");
        $data2=mysqli_fetch_assoc($ConsultaLineaVida);
        $lineavida = $data2['IDTutorado'];

       if ($tutorado = $lineavida) {
            echo'<script type="text/javascript">
            alert("Usted ya ha respondido este test");
            window.location.href="../interfaz-salida/datos-personales.php";
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
    <link rel="stylesheet" href="../../../css/styleformpersonal.css">
    <link rel="stylesheet" href="../../../css/styleSwitch.css">
    <link rel="stylesheet" href="../../../css/styleInput.css">
    <link rel="stylesheet" href="../../../css/styledashpersonal.css">
    <link rel="stylesheet" href="../../../css/stylerangeslider.css">
    
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
          <hr class="sidenav-heading justify-content-center">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="../index.php" > <i class="far fa-user"></i>Identificación</a>
            </li>
            <li><a href="../desarrollo-humano/index.php" aria-expanded="false" > <i class="far fa-smile-wink"></i>Desarrollo Humano </a>
              
            </li>
            <li><a href="../habilidades-pensamiento/index.php" aria-expanded="false"> <i class="far fa-lightbulb fa-2x"></i>Pensamiento </a>
             
            </li>
            <li><a href="../fortalecimiento/index.php" aria-expanded="false"> <i class="fas fa-dumbbell"></i>Fortalecimiento </a>
             
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
                  
                  <!--Migas de pan datos personales-->
                  <div class="col align-self-start">
                    <ol class="breadcrumb" style="background: none; color: white; width: auto; height: 30px; font-family: lato; ">
                        <li>
                            <a style="font-size: 20px;" href="../general/general.php">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <div style="font-size: 20px;font-family: lato;">&nbsp; > &nbsp;</div>
                        <li>
                            <a style="font-size: 20px;" href="../index.php">
                                Identificación
                            </a>
                        </li>
                        <div style="font-size: 20px;font-family: lato;">&nbsp; > &nbsp;</div>
                        <li class="active">
                            <a style="font-size: 20px;">
                                <u>Datos Personales</u>
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
     
       
     
      <!--Fin de Preguntas-->
      
       <div class="row justify-content-center mt-1 col-sm-12 ml-1 mr-1 container">
           <div class="col-md-10 col-sm-12">
              <div class="">
                <div class="">
                    <div class="stepwizard">
    <div class="setup-panel">
       <div class="main-wrap">
       <div class="step-progress text-center ">
       
        <div class="stepwizard-step step active" style="display: none;"  >
            <a href="#step-1" type="" class="point btn btn-primary btn-circle" onclick="toggle(this)" >
            <i class="far fa-address-card icon"></i>
            </a>
        </div>
        <div class="stepwizard-step step ">
            <a href="#step-2" type="" class="point btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><i class="far fa-address-card icon"></i>
            </a>
            </div>
        <div class="stepwizard-step step">
         <div class="progress"></div>
			<a href="#step-3" type="" class=" point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><i class="fas fa-school icon"></i></a> 
            
        </div>
        <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-4" type="" class=" point btn btn-circle " onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><i class="fas fa-chalkboard-teacher icon"></i></a> 
            
        </div> 
           <div class="stepwizard-step step">
           <div class="progress"></div>
            <a href="#step-5" type="" class="point btn btn-circle" onclick="toggle(this)" style="color:#9B9191;pointer-events: none;"><i class="fas fa-check icon"></i></a> 
            
        </div>
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body">
                        
                  <br>
                  <br>
        <div class="container">

<form role="form" id="form" method="POST" action="consultas/insertar-datos-personales.php" >
<?php while($datosconsulta = mysqli_fetch_array($consultas)) { ?>
                  <textarea name="IDTutorado" hidden=""><?php echo $datosconsulta['IDTutorado']; ?></textarea>
                <?php } ?>
      <div class="row setup-content  animated slideInRight " id="step-1">
        <div class="col-md-12">
            <div class="col-xs-12">
                <div class="form-group">
                <div class=" d-flex justify-content-center ">
                 
              <h4 class="animated bounce titulo-form-personal">¡Alto ahí!, <br> identifíquese soldad@.</h4>
                   
                    </div>
                

                </div>
         
                <button class="btn nextBtn btn-inicio float-right" type="button" >Continuar</button>
            </div>
        </div>
    </div>
    <div class="row setup-content  animated slideInRight" id="step-2">
        <div class="col-md-12">
          <div class="col-xs-12">
                
                
                    
                     <!--  General -->
  <div class="form-group">
    
    <div class="controls">
      <input type="text" id="LugarOrigen" class="floatLabel" name="LugarOrigen" required >
      <label for="LugarOrigen">Lugar de Origen</label>
    </div>
    </div>
    <div class="form-group">
     <div class="controls">
      <i class="fa fa-sort"></i>
      <select class="floatLabel" name="EstadoCivil">
        <option value="vacio"></option>
        <option value="1">Soltero</option>
        <option value="2">Casado</option>
        <option value="3">Divorciado</option>
        <option value="4">Viudo</option>
        
        
      </select>
      <label for="EstadoCivil">Estado Civil</label>
    </div>
    </div>
     <div class="form-group">
     <div class="controls">
      <input type="tel" id="TelefonoCasa" class="floatLabel" name="TelefonoCasa">
      <label for="TelefonoCasa">Teléfono de Casa</label>
    </div>
    </div>
    <div class="form-group">
    <div class="controls">
      <input type="tel" id="TelefonoCelular" class="floatLabel" name="TelefonoCelular" required>
      <label for="TelefonoCelular">Teléfono Celular</label>
    </div>
    </div>
    <div class="form-group">
    <label class="form-label2">¿Eres foraneo?:</label>
     <script>
            function deshabilitar8() {
                $('#DomicilioEstudiante').prop("disabled", true);
                $('#log35').prop("hidden", true);
                $('#DomicilioEstudiante').removeAttr("required");

                document.getElementById('log40').innerHTML = '<div class="alert alert-warning wow pulse" role="alert">Si su respuesta es NO, omita la siguiente pregunta.</div>';;
                
            }
            function habilitar8() {
                $('#DomicilioEstudiante').removeAttr("disabled");
                $('#log35').prop("hidden", true);
                $('#DomicilioEstudiante').prop("required", true);

                document.getElementById('log40').innerHTML = '<div class="alert alert-warning wow pulse" role="alert">Si su respuesta es SÍ, responda siguiente pregunta.</div>';;
            }
        </script>
        
    
        <div class="switchform" id="switch">
          <p class="btn-switch">					
           <input type="radio" id="yes9" name="BtnVivirFamiliares" onclick="habilitar8()" value="1" class="btn-switch__radio btn-switch__radio_yes" />
             <input type="radio" checked id="no9" name="BtnVivirFamiliares" onclick="deshabilitar8()" value="0" class="btn-switch__radio btn-switch__radio_no" />	
            <label for="yes9" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						 
            <label for="no9" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
          </p>
         </div>
         
         <div class="alert alert-warning wow pulse" role="alert" id="log35">Si su respuesta es NO, omita la pregunta siguiente.</div>
         
        <div id="log40"></div>
          
        
        
     <div class="controls">
      <input type="tel" id="DomicilioEstudiante" class="floatLabel" name="DomicilioEstudiante" disabled>
      <label for="DomicilioEstudiante">Domicilio actual:</label>
     </div> 
    </div> 
    <div class="form-group">
     <div class="controls">
      <input type="tel" id="DomicilioFamilia" class="floatLabel" name="DomicilioFamilia" >
      <label for="DomicilioFamilia">Domicilio  Familiar</label>
    </div> 
    </div> 
    
    <div class="form-group">
    <label class="form-label2">¿Trabajas?:</label>
    <!--
    <script>
                    //Deshabilitar trabajas
    function activeTrabajas()
    {
        document.getElementById("LugarTrabajo").disabled=false;
    	document.getElementById("DomicilioTrabajo").disabled=false;
    	document.getElementById("TelefonoTrabajo").disabled=false;
    }
                    
                    
              
    function inactiveTrabajas()
    {
        
        
    	document.getElementById("LugarTrabajo").disabled=true;
    	document.getElementById("DomicilioTrabajo").disabled=true;
    	document.getElementById("TelefonoTrabajo").disabled=true;
    }
    
    
    </script>
    -->
    
    <script>
        function deshabilitar() {
            $('#LugarTrabajo').prop("disabled", true);
            $('#DomicilioTrabajo').prop("disabled", true);
            $('#TelefonoTrabajo').prop("disabled", true);
            $('#log12').prop("hidden", true);
            
            $('#LugarTrabajo').removeAttr("required");
            $('#DomicilioTrabajo').removeAttr("required");
            $('#TelefonoTrabajo').removeAttr("required");
            
            document.getElementById('log').innerHTML = '<div class="alert alert-warning wow pulse" role="alert">Si su respuesta es NO, omita las 3 preguntas siguientes.</div>';;
            
        }
        function habilitar() {
            $('#LugarTrabajo').removeAttr("disabled");
            $('#DomicilioTrabajo').removeAttr("disabled");
            $('#TelefonoTrabajo').removeAttr("disabled");
            $('#log12').prop("hidden", true);
            
            $('#LugarTrabajo').prop("required", true);
            $('#DomicilioTrabajo').prop("required", true);
            $('#TelefonoTrabajo').prop("required", true);
            
            document.getElementById('log').innerHTML = '<div class="alert alert-warning wow pulse" role="alert">Si su respuesta es SÍ, responda las 3 preguntas siguientes.</div>';;
        }
    </script>
    
                    
            <div class="switchform" id="switch">
          <p class="btn-switch">					
            <input type="radio"  required id="yes" name="Trabajas" onclick="habilitar()" value="1" class="btn-switch__radio btn-switch__radio_yes" />
             <input type="radio" checked id="no" name="Trabajas" onclick="deshabilitar()" value="0" class="btn-switch__radio btn-switch__radio_no" />	
              <label for="yes" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
            <label for="no" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
            </p>
            </div>
    </div>
    
    <div class="alert alert-warning wow pulse" role="alert" id="log12">Si su respuesta es NO, omita las 3 preguntas siguientes.</div>
    
    <div id="log"></div> 
    
    <div class="form-group">
   <div class="controls">
      <input type="tel" id="LugarTrabajo" class="floatLabel" name="LugarTrabajo" disabled>
      <label for="LugarTrabajo">Lugar donde trabajas</label>
    </div>
    </div>
    <div class="form-group">
     <div class="controls">
      <input type="tel" id="DomicilioTrabajo" class="floatLabel" name="DomicilioTrabajo" disabled>
      <label for="DomicilioTrabajo">Domicilio donde Trabajas</label>
    </div>
     </div>
     <div class="form-group">
      <div class="controls">
      <input type="tel" id="TelefonoTrabajo" class="floatLabel" name="TelefonoTrabajo" disabled>
      <label for="TelefonoTrabajo">Teléfono donde Trabajas</label>
    </div>
    </div> 
     
     <div class="form-group">
    <label class="form-label2">¿Tienes hijos?:</label>
    
    <!--
        <script>
        //Deshabilitar hijos
        function activeHijos()
        {
        	document.getElementById("Hijos").disabled=false;
        }
        
        function inactiveHijos()
        {
        	document.getElementById("Hijos").disabled=true;
        }
                        
        </script>
    
    -->
        <script>
            function deshabilitar2() {
                $('#Hijos').prop("disabled", true);
                
                
                $('#log22').prop("hidden", true);
                
                document.getElementById('log2').innerHTML = '<div class="alert alert-warning wow pulse" role="alert">Si su respuesta es NO, omita la preguntas siguiente.</div>';;
                
            }
            function habilitar2() {
                $('#Hijos').removeAttr("disabled");
                
                $('#log22').prop("hidden", true);
                
                document.getElementById('log2').innerHTML = '<div class="alert alert-warning wow pulse" role="alert">Si su respuesta es SÍ, responda la pregunta siguiente.</div>';;
            }
        </script>
    
         <div class="switchform" id="switch">
         <p class="btn-switch">					
            <input type="radio" id="yes2" name="NumeroHijos" onclick="habilitar2()" value="1" class="btn-switch__radio btn-switch__radio_yes" />
            <input type="radio" checked id="no2" name="NumeroHijos" onclick="deshabilitar2()" value="0" class="btn-switch__radio btn-switch__radio_no" />	
            <label for="yes2" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						 
            <label for="no2" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
        </p>
        </div>
        </div>
        
        <div class="alert alert-warning wow pulse" role="alert" id="log22">Si su respuesta es NO, omita la pregunta siguiente.</div>
        
        <div id="log2"></div>
        
        <div class="form-group">
            <label class="form-label3">Número de Hijos</label>
             <div class="range-slider">
              <input id="Hijos" class="range-slider__range" type="range"  name="Hijos" value="0" min="0" max="10" disabled>
              <span class="range-slider__value">0</span>
            </div>

        </div>
     <div class="form-group">
    <label class="form-label2">Vives con tus padres:</label>
    <!--
        
        <script>
        //Deshabilitar parentesco
        function activeParentesco()
        {
        	document.getElementById("parentescoFamiliar").disabled=false;
        	document.getElementById("NombreTutorLegal").disabled=false;
        	document.getElementById("DomicilioTutorLegal").disabled=false;
        	document.getElementById("Ciudad").disabled=false;
        	document.getElementById("Ocupacion").disabled=false;
        	document.getElementById("LugarEmpleo").disabled=false;
        	document.getElementById("Horario").disabled=false;
        	document.getElementById("Celular").disabled=false;
        }
        
        function inactiveParentesco()
        {
        	document.getElementById("parentescoFamiliar").disabled=true;
        	document.getElementById("NombreTutorLegal").disabled=true;
        	document.getElementById("DomicilioTutorLegal").disabled=true;
        	document.getElementById("Ciudad").disabled=true;
        	document.getElementById("Ocupacion").disabled=true;
        	document.getElementById("LugarEmpleo").disabled=true;
        	document.getElementById("Horario").disabled=true;
        	document.getElementById("Celular").disabled=true;
        }
                        
        </script>
        -->
        
        
        <script>
            function deshabilitar3() {
                $('#parentescoFamiliar').prop("disabled", true);
                $('#NombreTutorLegal').prop("disabled", true);
                $('#DomicilioTutorLegal').prop("disabled", true);
                $('#Ciudad').prop("disabled", true);
                $('#Ocupacion').prop("disabled", true);
                $('#LugarEmpleo').prop("disabled", true);
                $('#Horario').prop("disabled", true);
                $('#Celular').prop("disabled", true);
                $('#log32').prop("hidden", true);
                
                $('#parentescoFamiliar').removeAttr("required");
                $('#NombreTutorLegal').removeAttr("required");
                $('#DomicilioTutorLegal').removeAttr("required");
                $('#Ciudad').removeAttr("required");
                $('#Ocupacion').removeAttr("required");
                $('#LugarEmpleo').removeAttr("required");
                $('#Horario').removeAttr("required");
                $('#Celular').removeAttr("required");
                
                document.getElementById('log3').innerHTML = '<div class="alert alert-warning wow pulse" role="alert">Si su respuesta es NO, omita las 8 preguntas siguientes.</div>';;
                
            }
            function habilitar3() {
                $('#parentescoFamiliar').removeAttr("disabled");
                $('#NombreTutorLegal').removeAttr("disabled");
                $('#DomicilioTutorLegal').removeAttr("disabled");
                $('#Ciudad').removeAttr("disabled");
                $('#Ocupacion').removeAttr("disabled");
                $('#LugarEmpleo').removeAttr("disabled");
                $('#Horario').removeAttr("disabled");
                $('#Celular').removeAttr("disabled");
                $('#log32').prop("hidden", true);
                
                $('#parentescoFamiliar').prop("required", true);
                $('#NombreTutorLegal').prop("required", true);
                $('#DomicilioTutorLegal').prop("required", true);
                $('#Ciudad').prop("required", true);
                $('#Ocupacion').prop("required", true);
                $('#LugarEmpleo').prop("required", true);
                $('#Horario').prop("required", true);
                $('#Celular').prop("required", true);
                
                document.getElementById('log3').innerHTML = '<div class="alert alert-warning wow pulse" role="alert">Si su respuesta es SÍ, responda las 8 preguntas siguientes.</div>';;
            }
        </script>
        
    
        <div class="switchform" id="switch">
          <p class="btn-switch">					
           <input type="radio" id="yes3" name="VivirFamiliares" onclick="habilitar3()" value="1" class="btn-switch__radio btn-switch__radio_yes" />
             <input type="radio" checked id="no3" name="VivirFamiliares" onclick="deshabilitar3()" value="0" class="btn-switch__radio btn-switch__radio_no" />	
            <label for="yes3" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						 
            <label for="no3" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
          </p>
         </div>
       </div>
       
       <div class="alert alert-warning wow pulse" role="alert" id="log32">Si su respuesta es NO, omita las 8 preguntas siguientes.</div>
        
        <div id="log3"></div>
       
     <div class="form-group">
         <div class="controls">
      <i class="fa fa-sort"></i>
      <select class="floatLabel" id="parentescoFamiliar" name="parentescoFamiliar" disabled>
        <option value="vacio"></option>
        <option value="1">1. Madre</option>
        <option value="2">2. Padre</option>
        <option value="3">3. Ambos</option>
        <option value="4">4. Abuelos</option>
        <option value="5">5. Otros</option>
      </select>
      <label for="ParentescoFamiliar">Parentesco Familiar</label>
    </div>
    </div>
     <div class="form-group">
    <div class="controls">
      <input type="tel" id="NombreTutorLegal" class="floatLabel" name="NombreTutorLegal" disabled>
      <label for="NombreTutorLegal">Nombre del padre o la madre</label>
    </div>
    </div>
     <div class="form-group">
     <div class="controls">
      <input type="tel" id="DomicilioTutorLegal" class="floatLabel" name="DomicilioTutorLegal" disabled>
      <label for="DomicilioTutorLegal">Domicilio del Tutor</label>
    </div>
    </div>
     <div class="form-group">
     <div class="controls">
      <input type="tel" id="Ciudad" class="floatLabel" name="Ciudad" disabled>
      <label for="Ciudad">Ciudad o localidad donde vive</label>
    </div>
    </div>
     <div class="form-group">
     <div class="controls">
      <input type="tel" id="Ocupacion" class="floatLabel" name="Ocupacion" disabled>
      <label for="Ocupacion">Ocupación</label>
    </div>
    </div>
     <div class="form-group">
    <div class="controls">
      <input type="tel" id="LugarEmpleo" class="floatLabel" name="LugarEmpleo" disabled>
      <label for="LugarEmpleo">Lugar donde trabaja</label>
    </div>
    </div>
     <div class="form-group">
     <div class="controls">
      <input type="tel" id="Horario" class="floatLabel" name="Horario" disabled>
      <label for="Horario">Horario de Trabajo</label>
    </div>
    </div>
     <div class="form-group">
     <div class="controls">
      <input type="tel" id="Celular" class="floatLabel" name="Celular" disabled>
      <label for="Celular">Télefono o Número celular</label>
    </div>
    </div>         
        <button class="btn previousBtn2" type="button">Anterior</button>
        <button class="btn nextBtn float-right" type="button" >Continuar</button>
            </div>
        </div>
    </div>
       <div class="row setup-content  animated slideInRight" id="step-3">
        <div class="col-md-12">
            <div class="col-xs-12">
                <div class="form-group">
                       
            <div class="form-group">
                 <div class="controls">
              <i class="fa fa-sort"></i>
              <select class="floatLabel" name="IDPreparatoria">
                <option value="vacio"></option>
                <option value="1">Centro Bachillerato Tecnologico Industrial y de Servicios #72</option>
                <option value="2">Conalep 27</option>
                <option value="3">Colegio de Bachilleres Comunidad Señor</option>
                <option value="4">Centros de Estudio del Bachillerato 5/10</option>
                <option value="4">Otro</option>
              </select>
              <label for="escuela">Escuela Media Superior de procedencia</label>
            </div>
            </div>
            <div class="form-group">
             <div class="controls">
              <input type="text" id="IDEspecialidad" class="floatLabel" name="IDEspecialidad" required>
              <label for="IDEspecialidad">Especialidad que llevaste</label>
            </div>
            </div>
            <div class="form-group">
             <div class="controls">
              <input type="text" id="PromedioObtenido" class="floatLabel" name="PromedioObtenido" required>
              <label for="PromedioObtenido">Promedio que Obtuviste</label>
            </div>
            </div>
             <div class="form-group">
                <label class="form-label2">¿Repetiste la primaria?</label>
            
                 <div class="switchform" id="switch">
                 <p class="btn-switch">					
                    <input type="radio" id="yes4" name="PrimariaRepetida" value="1" class="btn-switch__radio btn-switch__radio_yes" />
                    <input type="radio" checked id="no4" name="PrimariaRepetida" value="0" class="btn-switch__radio btn-switch__radio_no" />	
                    <label for="yes4" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						 
                    <label for="no4" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
                </p>
                </div>
                </div>
             <div class="form-group">
                <label class="form-label2">¿Repetiste la Secundaria?</label>
            
                 <div class="switchform" id="switch">
                 <p class="btn-switch">					
                    <input type="radio" id="yes5" name="SecundariaRepetida" value="1" class="btn-switch__radio btn-switch__radio_yes" />
                    <input type="radio" checked id="no5" name="SecundariaRepetida" value="0" class="btn-switch__radio btn-switch__radio_no" />	
                    <label for="yes5" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						 
                    <label for="no5" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
                </p>
                </div>
                </div>
                     <div class="form-group">
                <label class="form-label2">¿Repetiste el bachillerato?</label>
            
                 <div class="switchform" id="switch">
                 <p class="btn-switch">					
                    <input type="radio" id="yes6" name="PrepaRepetida" value="1" class="btn-switch__radio btn-switch__radio_yes" />
                    <input type="radio" checked id="no6" name="PrepaRepetida" value="0" class="btn-switch__radio btn-switch__radio_no" />	
                    <label for="yes6" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						 
                    <label for="no6" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
                </p>
                </div>
                </div>

                     <div class="form-group">
                     <div class="controls">
                     <input type="text" id="MateriasDificultad" class="floatLabel" name="MateriasDificultad" required>
                     <label for="MateriasDificultad">Materias que te causaron dificultad en la preparatoria o bachillerato</label>
                    </div>
                    </div>
            
                </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
                <button class="btn nextBtn float-right" type="button" >Continuar</button>
            </div>
        </div>
    </div>
    <div class="row setup-content  animated slideInRight" id="step-4">
        <div class="col-md-12">
              <div class="col-xs-12">
                <div class="form-group">
                
            <div class="form-group">
              <div class="controls">
               <input type="text" id="ExpectativaUniversidad" class="floatLabel" name="ExpectativaUniversidad" required>
               <label for="ExpectativaUniversidad">A grandes rasgos, ¿Cuál es la expectativa que tienes al estudiar el Nivel Superior?</label>
              </div>
            </div>
              <div class="form-group">
              <div class="controls">
               <input type="text" id="ExpectativaCarrera" class="floatLabel" name="ExpectativaCarrera" required>
               <label for="ExpectativaCarrera">¿Qué esperas de tu carrera?</label>
              </div>
            </div>
             <div class="form-group">
              <div class="controls">
               <input type="text" id="ExpectativaGraduarse" class="floatLabel" name="ExpectativaGraduarse" required>
               <label for="ExpectativaGraduarse">¿Qué esperas de ti al cursar la carrera que elegiste?</label>
              </div>
            </div>
             <div class="form-group">
              <div class="controls">
               <input type="text" id="ExpectavidaTutoria" class="floatLabel" name="ExpectavidaTutoria" required>
               <label for="ExpectavidaTutoria">¿Qué esperas de OceanMind?</label>
              </div>
            </div>
             <div class="form-group">
              <div class="controls">
               <input type="text" id="CompromisoTutorado" class="floatLabel" name="CompromisoTutorado" required>
               <label for="CompromisoTutorado">¿ A qué te comprometes  como alumno?</label>
              </div>
              <div class="controls" hidden="">
               <input type="text" id="notificacion" class="floatLabel" name="notificacion" value="Trofeo-Identificación desbloqueado">
              </div>
              <div class="controls" hidden="">
               <input type="text" id="edo_notificacion" class="floatLabel" name="edo_notificacion" value="0">
              </div>
            </div>
	       </div>
                <button class="btn previousBtn2" type="button">Anterior</button>
                <button class="btn nextBtn float-right" type="button">Continuar</button>
            </div>
        </div>
    </div>
   

   
    <div class="row setup-content  animated slideInRight" id="step-5">
        <div class="col-md-12">
           
           <center>
            <div class="col-md-12">
               <br>
               <br>
                <h1 class="titulo-salir" >iHas completado el test de Identificación!</h1>
                <br>
                <button class="btn btn-salir nextBtn animated  bounceIn" required  type="submit">Finalizar</button>
            
            </div>
            </center>
        </div>
    </div>
</form>
</div> 
                  
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
    <script src="../../../js/wow.min.js"></script>
    <script src="../../../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
    <script src="../../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../../js/indexform.js"></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
    <script src="../../../js/indexdash.js"></script>
    <script src="../../../js/inputform.js"></script>
    <script src="../../../js/rangeSlider.js"></script>
    
    <script>
      new WOW().init();
      </script>
      


    <!-- Main File-->
    <script src="../../../js/front.js"></script>
  </body>
</html>