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
        require_once("../../../php/conexion.php"); //enlazar el archivo de conexion

        $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $data=mysqli_fetch_assoc($ConsultaTutorado);
        $tutorado = $data['IDTutorado'];

        //CONSULTA ID
        $ConsultaDatosPersonales = mysqli_query($mysqli,"SELECT * FROM `ficha-datos-personales` WHERE IDTutorado = '$tutorado'");
        $data3=mysqli_fetch_assoc($ConsultaDatosPersonales);
        $testDP = $data3['EstadoCivil'];
        $OrigenDP = $data3['LugarOrigen'];
        $telcasaDP = $data3['TelefonoCasa'];
        $telcelDP = $data3['TelefonoCelular'];
        $domestudianteDP = $data3['DomicilioEstudiante'];
        $domfamiliarDP = $data3['DomicilioFamilia'];
        $trabajasDP = $data3['Trabajas'];
        $lugartrabajoDP = $data3['LugarTrabajo'];
        $domtrabajoDP = $data3['DomicilioTrabajo'];
        $teltraDP = $data3['TelefonoTrabajo'];
        $trabajasDP = $data3['Trabajas'];
        $hijosDP = $data3['Hijos'];
        $numhijosDP = $data3['NumeroHijos'];
        $vivirfamDP = $data3['VivirFamiliares'];
        $parentescoDP = $data3['ParentescoFamiliar'];
        $tutorDP = $data3['NombreTutorLegal'];
        $domtutorDP = $data3['DomicilioTutorLegal'];
        $ciudadDP = $data3['Ciudad'];
        $ocupacionDP = $data3['Ocupacion'];
        $lugarempleoDP = $data3['LugarEmpleo'];
        $horarioDP = $data3['Horario'];
        $celularDP = $data3['Celular'];

        if($testDP == 1){
            $edocivil = "Soltero";
        }elseif($testDP == 2){
            $edocivil = "Casado";
        }elseif($testDP == 3){
            $edocivil = "Divorciado";
        }elseif($testDP == 4){
            $edocivil = "Viudo";
        }

        if($parentescoDP == 0){
            $respparentestoDP = "Madre";
        }if($parentescoDP == 1){
            $respparentestoDP = "Padre";
        }if($parentescoDP == 2){
            $respparentestoDP = "Ambos";
        }if($parentescoDP == 3){
            $respparentestoDP = "Abuelos";
        }if($parentescoDP == 4){
            $respparentestoDP = "Otros";
        }

        //CONSULTA
        $ConsultaTutoria = mysqli_query($mysqli,"SELECT * FROM `ficha-datos-tutoria` WHERE IDTutorado = '$tutorado'");
        $data4=mysqli_fetch_assoc($ConsultaTutoria);
        $expectativauniversidadDT = $data4['ExpectativaUniversidad'];
        $expectativatutoriaDT = $data4['ExpectavidaTutoria'];   
        $expectativacarreraDT = $data4['ExpectativaCarrera'];
        $expectativagraduarseDT = $data4['ExpectativaGraduarse'];
        $compromisotutoradoDT = $data4['CompromisoTutorado'];
        
        //CONSULTA
        $ConsultaEscolares = mysqli_query($mysqli,"SELECT * FROM `ficha-datos-escolares` WHERE IDTutorado = '$tutorado'");
        $data5=mysqli_fetch_assoc($ConsultaEscolares);
        $preparatoria = $data5['IDPreparatoria'];
        $especialidad = $data5['IDEspecialidad'];   
        $promedio = $data5['PromedioObtenido'];
        $primaria = $data5['PrimariaRepetida'];
        $secundaria = $data5['SecundariaRepetida'];
        $prepa = $data5['PrepaRepetida'];
        $materias = $data5['MateriasDificultad'];
        
        //CONSULTA NOTIFICACIÓN
        $ConsultaNotificacion = mysqli_query($mysqli,"SELECT * FROM `Notificaciones` WHERE IDTutorado = '$tutorado' AND Descripcion = 'Trofeo-Identificación desbloqueado' ");
        $data6=mysqli_fetch_assoc($ConsultaNotificacion);
        $edo_notificacion = $data6['edo_notificacion'];
        $TutoradoN = $data6['IDTutorado'];
        
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
            <li><a href="../index.php"> <i class="far fa-user"></i>Identificación</a>
            </li>
            <li><a href="../desarrollo-humano/index.php" aria-expanded="false" > <i class="far fa-smile-wink"></i>Desarrollo Humano </a>
            
            </li>
            <li><a href="../habilidades-pensamiento/index.php" aria-expanded="false" > <i class="far fa-lightbulb fa-2x"></i>Pensamiento </a>
            
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
                  
                  
                  <!--Migas de pan IOUT_Datos personales -->
                  <div class="col align-self-start">
                    <ol class="breadcrumb" style="background: none; color: white; width: auto; height: 30px; font-family: lato; ">
                        <li>
                            <a style="font-size: 20px;" href="../general/general.php">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <div style="font-size: 20px;font-family: lato;">&nbsp; > &nbsp;</div>
                        <li>
                            <a style="font-size: 20px;font-family: lato;" href="../index.php">
                                Identificación
                            </a>
                        </li>
                        <div style="font-size: 20px;font-family: lato;">&nbsp; > &nbsp;</div>
                        <li class="active">
                            <a style="font-size: 20px;font-family: lato;">
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
        
        </div> 
    </div>    
    </div>
</div>
                </div>
                <div class="card-body">
                        
                  <br>
                  <br>
        <div class="container">

<form role="form" id="form" >
 
  <div class="row setup-content  animated slideInRight " id="step-1">
        <div class="col-md-12">
            <div class="col-xs-12">
                <div class="form-group">
                <div class="card-header d-flex justify-content-center ">
                 
              <h4 class="animated bounce titulo-form-personal" >¡Registro Completo!<br></h4>
                   
                    </div>
 
			   
                    
             
        
                      
                </div>
         
                <button class="btn btn-inicio nextBtn float-right " type="button" >Continuar</button>
            </div>
        </div>
    </div>
  
    <div class="row setup-content  animated slideInRight" id="step-2">
        <div class="col-md-12">
            <div class="col-xs-12">

  <div class="form-group">
    
    <div class="controls">
      <input type="text" id="lugarOrigen" class="floatLabel" name="lugarOrigen"  value="<?php echo $OrigenDP ?>" readonly>
      <label for="lugarOrigen">Lugar de Origen</label>
    </div>
    </div>
    
     <div class="form-group">
    
    <div class="controls">
      <input type="text" id="estadocivil" class="floatLabel" name="estadocivil"  value="<?php echo $edocivil ?>" readonly>
      <label for="estadocivil" class="active">Estado Civil</label>
    </div>
    </div>
   
     <div class="form-group">
     <div class="controls">
      <input type="tel" id="tel1" class="floatLabel" name="tel1"  value="<?php echo $telcasaDP ?>" readonly >
      <label for="tel1" class="active">Telefono de Casa</label>
    </div>
    </div>
    <div class="form-group">
    <div class="controls">
      <input type="tel" id="tel2" class="floatLabel" name="tel2"  value="<?php echo $telcelDP ?>" readonly>
      <label for="tel2" class="active">Telefono Celular</label>
    </div>
    </div>
    <div class="form-group">
     <div class="controls">
      <input type="tel" id="foraneo" class="floatLabel" name="foraneo"  value="<?php echo $domestudianteDP ?>" readonly>
      <label for="tel2" class="active">Si	es foráneo, domicilio del lugar que	actualmente habitas:</label>
    </div> 
    </div> 
    <div class="form-group">
     <div class="controls">
      <input type="tel" id="domicilio" class="floatLabel" name="domicilio" value="<?php echo $domfamiliarDP ?>" readonly>
      <label for="tel2" class="active">Domicilio  Familiar</label>
    </div> 
    </div> 
    
    <div class="form-group">
    <label class="form-label2">¿Trabajas?:</label>
                    
     
                
                <?php 
                    if($trabajasDP == 1){
                        echo'<div class="switchform" id="switch">
                        <p class="btn-switch">					
                        <input type="radio" checked id="yes" name="Trabajas" class="btn-switch__radio btn-switch__radio_yes" disabled/>
                         <input type="radio" id="no" name="Trabajas" class="btn-switch__radio btn-switch__radio_no" disabled/>	
                          <label for="yes" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
                        <label for="no" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
                        </p>
                        </div>';
                    }
                    
                    else{
                        echo '<div class="switchform" id="switch">
          <p class="btn-switch">					
            <input type="radio"  id="yes" name="Trabajas" class="btn-switch__radio btn-switch__radio_yes" disabled/>
             <input type="radio" checked id="no" name="Trabajas" class="btn-switch__radio btn-switch__radio_no" disabled/>	
              <label for="yes" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
            <label for="no" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
            </p>
            </div>'; 
                    }
                ?>


    </div>
     
    
    <div class="form-group">
   <div class="controls">
      <input type="tel" id="trabajo1" class="floatLabel" name="trabajo1"  value="<?php echo $lugartrabajoDP  ?>" readonly>
      <label for="trabajo1" class="active">Lugar donde trabajas</label>
    </div>
    </div>
    <div class="form-group">
     <div class="controls">
      <input type="tel" id="trabajo2" class="floatLabel" name="trabajo2" value="<?php echo $domtrabajoDP   ?>" readonly>
      <label for="trabajo2" class="active">Domicilio donde Trabajas</label>
    </div>
     </div>
     <div class="form-group">
      <div class="controls">
      <input type="tel" id="trabajo3" class="floatLabel" name="trabajo3"  value="<?php echo $teltraDP   ?>" readonly>
      <label for="trabajo3" class="active">Telefono donde Trabajas</label>
    </div>
    </div> 
   
     <div class="form-group">
    
            <label class="form-label2">¿Tienes Hijos?</label>
            
            <?php 
                    if($hijosDP == 1){
                        echo'<div class="switchform" id="switch">
                        <p class="btn-switch">					
                        <input type="radio" checked id="yes2" name="Hijos" class="btn-switch__radio btn-switch__radio_yes" disabled/>
                         <input type="radio" id="no2" name="Hijos" class="btn-switch__radio btn-switch__radio_no" disabled/>	
                          <label for="yes2" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
                        <label for="no2" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
                        </p>
                        </div>';
                    }
                    
                    else{
                        echo '<div class="switchform" id="switch">
          <p class="btn-switch">					
            <input type="radio" id="yes2" name="Hijos" class="btn-switch__radio btn-switch__radio_yes" disabled/>
             <input type="radio" checked id="no2" name="Hijos" class="btn-switch__radio btn-switch__radio_no" disabled/>	
              <label for="yes2" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
            <label for="no2" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
            </p>
            </div>'; 
                    }
                ?>
            
        </div>
        
          <div class="form-group">
            <label class="form-label3">Número de Hijos</label>
             <div class="range-slider">
              <input class="range-slider__range" type="range" value="<?php echo $numhijosDP ?>" min="0" max="10" disabled>
              <span class="range-slider__value">0</span>
            </div>

        </div>
     <div class="form-group">
    <label class="form-label2">Vives con tus padres:</label>
          <?php 
                    if($vivirfamDP  == 1){
                        echo'<div class="switchform" id="switch">
                        <p class="btn-switch">					
                        <input type="radio" checked id="yes3" name="VivirFam" class="btn-switch__radio btn-switch__radio_yes" disabled/>
                         <input type="radio" id="no3" name="VivirFam" class="btn-switch__radio btn-switch__radio_no" disabled/>	
                          <label for="yes3" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
                        <label for="no3" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
                        </p>
                        </div>';
                    }
                    
                    else{
                        echo '<div class="switchform" id="switch">
          <p class="btn-switch">					
            <input type="radio" id="yes3" name="VivirFam" class="btn-switch__radio btn-switch__radio_yes" disabled/>
             <input type="radio" checked id="no3" name="VivirFam" class="btn-switch__radio btn-switch__radio_no" disabled/>	
              <label for="yes3" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
            <label for="no3" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
            </p>
            </div>'; 
                    }
                ?>
          

       </div>
         <div class="form-group">
    
    <div class="controls">
      <input type="text" id="parentescofamiliar" class="floatLabel" name="parentescofamiliar"  value="<?php echo $respparentestoDP ?>" readonly>
      <label for="parentescofamiliar" class="active">Parentesco Familiar</label>
    </div>
    </div>
     <div class="form-group">
    <div class="controls">
      <input type="text" id="tutor" class="floatLabel" name="tutor"  value="<?php echo $tutorDP ?>" readonly>
      <label for="tutor" class="active">Nombre del padre o la madre</label>
    </div>
    </div>
     <div class="form-group">
     <div class="controls">
      <input type="text" id="domiciliotutor" class="floatLabel" name="domiciliotutor" value="<?php echo $domtutorDP ?>" readonly>
      <label for="domiciliotutor" class="active">Domicilio del Tutor</label>
    </div>
    </div>
     <div class="form-group">
     <div class="controls">
      <input type="text" id="ciudadtutor" class="floatLabel" name="ciudadtutor"  value="<?php echo $ciudadDP ?>" readonly>
      <label for="ciudadtutor" class="active">Ciudad o localidad donde vive</label>
    </div>
    </div>
     <div class="form-group">
     <div class="controls">
      <input type="text" id="ocupacion" class="floatLabel" name="ocupacion" value="<?php echo $ocupacionDP ?>" readonly>
      <label for="ocupacion" class="active">Ocupación</label>
    </div>
    </div>
     <div class="form-group">
    <div class="controls">
      <input type="tel" id="trabajotutor" class="floatLabel" name="trabajotutor"  value="<?php echo $lugarempleoDP ?>" readonly>
      <label for="trabajotutor" class="active">Lugar donde trabaja</label>
    </div>
    </div>
     <div class="form-group">
     <div class="controls">
      <input type="tel" id="horariotutor" class="floatLabel" name="horariotutor"  value="<?php echo $horarioDP ?>" readonly>
      <label for="horariotutor" class="active">Horario de Trabajo</label>
    </div>
    </div>
     <div class="form-group">
     <div class="controls">
      <input type="tel" id="horariotutor" class="floatLabel" name="horariotutor" value="<?php echo $celularDP ?>" readonly>
      <label for="horariotutor" class="active">Télefono o Número celular</label>
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
      <input type="tel" id="escuela" class="floatLabel" name="escuela"  value="<?php echo $preparatoria ?>" readonly>
      <label for="escuela" class="active">Escuela de Procedencia</label>
    </div>
    </div>   
            <div class="form-group">
             <div class="controls">
              <input type="text" id="especialidad" class="floatLabel" name="especialidad"  value="<?php echo $especialidad ?>" readonly>
              <label for="especialidad" class="active">Especialidad que llevaste</label>
            </div>
            </div>
            <div class="form-group">
             <div class="controls">
              <input type="text" id="promedio" class="floatLabel" name="promedio" value="<?php echo $promedio ?>" readonly>
              <label for="promedio"  class="active">Promedio que Obtuviste</label>
            </div>
            </div>
             <div class="form-group">
                <label class="form-label2">¿Repetiste la primaria?</label>
            
                <?php 
                    if($primaria == 1){
                        echo'<div class="switchform" id="switch">
                        <p class="btn-switch">					
                        <input type="radio" checked id="yes4" name="primaria" class="btn-switch__radio btn-switch__radio_yes" disabled/>
                         <input type="radio" id="no4" name="primaria" class="btn-switch__radio btn-switch__radio_no" disabled/>	
                          <label for="yes4" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
                        <label for="no4" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
                        </p>
                        </div>';
                    }
                    
                    else{
                        echo '<div class="switchform" id="switch">
          <p class="btn-switch">					
            <input type="radio"  id="yes4" name="primaria" class="btn-switch__radio btn-switch__radio_yes" disabled/>
             <input type="radio" checked id="no4" name="primaria" class="btn-switch__radio btn-switch__radio_no" disabled/>	
              <label for="yes4" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
            <label for="no4" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
            </p>
            </div>'; 
                    }
                ?>
                 
                </div>
             <div class="form-group">
                <label class="form-label2">¿Repetiste la Secundaria?</label>
            
                 <?php 
                    if($secundaria == 1){
                        echo'<div class="switchform" id="switch">
                        <p class="btn-switch">					
                        <input type="radio" checked id="yes5" name="secundaria" class="btn-switch__radio btn-switch__radio_yes" disabled/>
                         <input type="radio" id="no5" name="secundaria" class="btn-switch__radio btn-switch__radio_no" disabled/>	
                          <label for="yes5" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
                        <label for="no5" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
                        </p>
                        </div>';
                    }
                    
                    else{
                        echo '<div class="switchform" id="switch">
          <p class="btn-switch">					
            <input type="radio"  id="yes5" name="secundaria" class="btn-switch__radio btn-switch__radio_yes" disabled/>
             <input type="radio" checked id="no5" name="secundaria" class="btn-switch__radio btn-switch__radio_no" disabled/>	
              <label for="yes5" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
            <label for="no5" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
            </p>
            </div>'; 
                    }
                ?>
                 
                </div>
                     <div class="form-group">
                <label class="form-label2">¿Repetiste el bachillerato?</label>
            
                <?php 
                    if($prepa == 1){
                        echo'<div class="switchform" id="switch">
                        <p class="btn-switch">					
                        <input type="radio" checked id="yes6" name="prepa" class="btn-switch__radio btn-switch__radio_yes" disabled/>
                         <input type="radio" id="no6" name="prepa" class="btn-switch__radio btn-switch__radio_no" disabled/>	
                          <label for="yes6" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
                        <label for="no6" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
                        </p>
                        </div>';
                    }
                    
                    else{
                        echo '<div class="switchform" id="switch">
          <p class="btn-switch">					
            <input type="radio"  id="yes6" name="prepa" class="btn-switch__radio btn-switch__radio_yes" disabled/>
             <input type="radio" checked id="no6" name="prepa" class="btn-switch__radio btn-switch__radio_no" disabled/>	
              <label for="yes6" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt">SI</span></label>						
            <label for="no6" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt">NO</span></label>							
            </p>
            </div>'; 
                    }
                ?>
                 
                </div>

                     <div class="form-group">
                     <div class="controls">
                     <input type="text" id="dificultad" class="floatLabel" name="dificultad"  value="<?php echo $materias ?>" readonly>
                     <label for="dificultad"  class="active">Materias que te causaron dificultad en la preparatoria o bachillerato</label>
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
               <input type="text" id="expectativa" class="floatLabel" name="expectativa"  value="<?php echo $expectativauniversidadDT ?>" readonly>
               <label for="expectativa"  class="active">A grandes	rasgos,	¿Cuál es la	expectativa	que	tienes al estudiar el Nivel Superior?</label>
              </div>
            </div>
              <div class="form-group">
              <div class="controls">
               <input type="text" id="expectativa2" class="floatLabel" name="expectativa2"  value="<?php echo $expectativacarreraDT ?>" readonly>
               <label for="expectativa2"  class="active">¿Qué esperas de tu carrera?</label>
              </div>
            </div>
             <div class="form-group">
              <div class="controls">
               <input type="text" id="expectativa3" class="floatLabel" name="expectativa3"  value="<?php echo $expectativagraduarseDT ?>" readonly>
               <label for="expectativa3"  class="active">¿Qué esperas de ti al cursar la carrera que elegiste?</label>
              </div>
            </div>
             <div class="form-group">
              <div class="controls">
               <input type="text" id="expectativa4" class="floatLabel" name="expectativa4" value="<?php echo $expectativatutoriaDT ?>" readonly >
               <label for="expectativa4"  class="active">¿Qué esperas OceanMind?</label>
              </div>
            </div>
             <div class="form-group">
              <div class="controls">
               <input type="text" id="expectativa4" class="floatLabel" name="expectativa4" value="<?php echo $compromisotutoradoDT ?>" readonly >
               <label for="expectativa4"  class="active">¿ A qué te comprometes  como alumno?</label>
              </div>
            </div>
	       </div>
                
                <a class="btn nextBtn float-right" href="../index.php">Regresar</a>
            </div>
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
    
    <!-- modal -->
    
    <center>
    <div class="modal fade" tabindex="-1" id="mostrarmodal" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">¡Has obtenido un trofeo!</h5>
          </div>
          <div class="modal-body">
            <img src="../../../img/trofeos/trofeo-identificacion.png" >
            
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3"></script>
            <br>
            <p>Comparte tu logro en facebook</p>

            <div class="fb-share-button" data-href="http://oceanmind.com.mx/compartir/trofeo-identificacion.php" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a>
            </div>
            
          </div>
          
          <form action="consultas/update-modal-identificacion.php" method="POST">
              <input type="text" name="actualizar_notificacion" id="actualizar_notificacion" value="1" hidden="">
              <input type="text" name="TutoradoN" id="TutoradoN" value="<?php echo $TutoradoN ?>" hidden="">
              <div class="modal-footer">
                <input type="submit" class=" rounded btn btn-danger" value="Cerrar">
              </div>
              
              
              
          </form>
          
        </div>
      </div>
    </div>
    
    </center>
    
  </body>
  
    <?php
    

        if(0 == $edo_notificacion){
            echo '
            
            <script>
                $(document).ready(function()
                {
                    $("#mostrarmodal").modal("show");
                });
            </script>
            
            ';    
        }else{
            echo '';
        }
    ?>
    

    
  
</html>