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

    $ConsultaDatosPersonales = mysqli_query($mysqli,"SELECT * FROM `foda` WHERE IDTutorado = '$tutorado'");
    $data3=mysqli_fetch_assoc($ConsultaDatosPersonales);
    $f1 = $data3['Fortaleza1'];
    $f2 = $data3['Fortaleza2'];
    $f3 = $data3['Fortaleza3'];
    $f4 = $data3['Fortaleza4'];
    $o1 = $data3['Oportunidad1'];
    $o2 = $data3['Oportunidad2'];
    $o3 = $data3['Oportunidad3'];
    $o4 = $data3['Oportunidad4'];
    $d1 = $data3['Debilidad1'];
    $d2 = $data3['Debilidad2'];
    $d3 = $data3['Debilidad3'];
    $d4 = $data3['Debilidad4'];
    $a1 = $data3['Amenaza1'];
    $a2 = $data3['Amenaza2'];
    $a3 = $data3['Amenaza3'];
    $a4 = $data3['Amenaza4'];
    
    //CONSULTA NOTIFICACIÓN
        $ConsultaNotificacion = mysqli_query($mysqli,"SELECT * FROM `Notificaciones` WHERE IDTutorado = '$tutorado' AND Descripcion = 'Trofeo-FODA desbloqueado' ");
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
   <link rel="stylesheet" href="../../../css/styleFODA.css">
    <link rel="stylesheet" href="../../../css/styleInput.css">
    
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
                        <div style="font-size: 20px;font-family: lato;">&nbsp; > &nbsp;</div>
                        <li>
                            <a style="font-size: 20px;font-family: lato;" href="../index.php">
                                Identificación
                            </a>
                        </li>
                        <div style="font-size: 20px;font-family: lato;">&nbsp; > &nbsp;</div>
                        <li class="active">
                            <a style="font-size: 20px;font-family: lato;">
                                <u>FODA</u>
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
      
      <div class="row justify-content-center col-sm-12 ml-1 mr-1">
           <div class="col-md-10 col-sm-12">
              <div class="">
                <div class="card-header d-flex justify-content-center ">
                  <div class="stepwizard">
    <div class=" setup-panel">
        <div class="stepwizard-step " style="display: none">
            <a href="#step-1" type="" class="btn btn-primary btn-circle" ><i class="far fa-address-card fa-2x"></i></a>
            <p></p>
        </div>
        <div class="stepwizard-step" style="display: none">
			<a href="#step-2" type="" class="btn btn-circle disabled  btn-default "><i class="fas fa-school fa-2x"></i></a> 
            <p></p>
        </div>
      
        
    </div>
</div>
                </div>     
                <div class="card-body">
           <div class="row setup-content  animated slideInRight " id="step-1">
        <div class="col-md-12">
            <div class="col-xs-12">
                <div class="form-group">
                <div class="card-header d-flex justify-content-center ">
                 
                    <h1 class="animated bounce titulo-form-personal" >Ya haz realizado tu Foda</h1>
                   
                    </div>    
                </div>
         
                <button class="btn btn-inicio nextBtn float-right " type="button" >Continuar</button>
            </div>
        </div>
    </div>          
           
             
         
                    
        <div class="container-fluid">
        
			<section class="fd">
      <div class="container ">
       
        <div class="setup-content  animated slideInRight " id="step-2">
        <div class="row">
       <div class="col-md-12">
     
             
              <div class="contenedor col-md-6 text-center" id="uno">
			<a  class=" texto" data-toggle="modal" data-target="#myModal"><i class="fas fa-hands " ></i>
			
			<p class="texto">Fortalezas</p></a>
		</div>
                 <div class="contenedor col-md-6 text-center" id="dos">
			<a  class="texto " data-toggle="modal" data-target="#myModal2">
			<i class="fas fa-lightbulb " ></i>
			<p class="texto">Oportunidades</p></a>
		</div>
            
            </div>
        
        
             
            
        
        
       <div class="col-md-12">
     
             
              <div class="contenedor col-md-6 text-center" id="tres">
			<a class="texto" data-toggle="modal" data-target="#myModal3">
			<i class="far fa-sad-cry " ></i>
			<p class="texto">Debilidades</p></a>
		</div>
                 <div class="contenedor col-md-6 text-center" id="cuatro">
			<a  class="texto" data-toggle="modal" data-target="#myModal4">
			<i class="fas fa-exclamation-triangle " ></i>
			<p class="texto">Amenazas</p></a>
		</div>
            
            </div>
             </div>
             <a class="btn nextBtn float-right" href="../index.php">Regresar</a>
             </div>
             
             </div>  
                
	<div class="col-lg-4">
             
        <div class="card-body text-center">
                  <!-- Modal-->
                  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal animacion text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content modal1 ">
                        <div class="modal-header ">
                          <h5 id="exampleModalLabel" class="titulo-modal">Fortalezas</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close cerrar-modal"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          <p>Escribe tus fortalezas en los recuadros</p>
                          
                          <form method="post">
				
		        	<div class="form-group">
                        <div class="controls">
                         <input type="text" id="fortaleza1" class="floatLabel" name="fortaleza1" required readonly value="<?php echo $f1 ?>">
                          <label for="fortaleza1" class="active">Fortaleza 1</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="fortaleza2" class="floatLabel" name="fortaleza2" required readonly value="<?php echo $f2 ?>">
                          <label for="fortaleza2" class="active">Fortaleza 2</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="fortaleza3" class="floatLabel" name="fortaleza3" required readonly value="<?php echo $f3 ?>">
                          <label for="fortaleza3" class="active">Fortaleza 3</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="fortaleza3" class="floatLabel" name="fortaleza4" required readonly value="<?php echo $f4 ?> ">
                          <label for="fortaleza3" class="active">Fortaleza 4</label>
                        </div>
                    </div>

				
			</form>

                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                          
                          <button type="submit" class="btn btn-enviar">Enviar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
            
        <!-- Inicia Ventana y formulario Oportunidades-->

     <div class="col-lg-4">
             
                <div class="card-body text-center">
                  <!-- Modal-->
                  <div id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal animacion text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content modal2">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="titulo-modal ">Oportunidades</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close cerrar-modal"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          <p>Escribe tus Oportunidades en los recuadros</p>
                          
                          <form method="post">
				
				<div class="form-group">
                        <div class="controls">
                         <input type="text" id="oportunidad1" class="floatLabel" name="oportunidad1" required readonly value="<?php echo $o1 ?>">
                          <label for="oportunidad1" class="active">Oportunidad 1</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="oportunidad2" class="floatLabel" name="oportunidad2" required readonly value="<?php echo $o2 ?>">
                          <label for="oportunidad2" class="active">Oportunidad 2</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="oportunidad3" class="floatLabel" name="oportunidad3" required readonly value="<?php echo $o3 ?>">
                          <label for="oportunidad3" class="active">Oportunidad 3</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="oportunidad4" class="floatLabel" name="oportunidad4" required readonly value="<?php echo $o4 ?>">
                          <label for="oportunidad4" class="active">Oportunidad 4</label>
                        </div>
                    </div>

				
			</form>

                        </div>
                        <div class="modal-footer  d-flex justify-content-center">
                          
                          <button type="submit" class="btn btn-enviar">Enviar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            
            
            <!-- Finaliza Ventana y formulario Oportunidades-->     
        
          <!-- Comienza Ventana y formulario Debilidades-->     
        
          <div class="col-lg-4">
               <div class="card-body text-center">
                  <!-- Modal-->
                  <div id="myModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal animacion text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content modal3">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="titulo-modal ">Debilidades</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close cerrar-modal"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          <p>Escribe tus Debilidades en los recuadros</p>
                          
                          <form method="post">
				
				<div class="form-group">
                        <div class="controls">
                         <input type="text" id="debilidad1" class="floatLabel" name="debilidad1" required readonly value="<?php echo $d1 ?>">
                          <label for="debilidad1" class="active">Debilidad 1</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="debilidad2" class="floatLabel" name="debilidad2" required readonly value="<?php echo $d2 ?>">
                          <label for="debilidad2" class="active">Debilidad 2</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="debilidad3" class="floatLabel" name="debilidad3" required readonly value="<?php echo $d3 ?>">
                          <label for="debilidad3" class="active">Debilidad 3</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="debilidad4" class="floatLabel" name="debilidad4" required readonly value="<?php echo $d4 ?>">
                          <label for="debilidad4" class="active">Debilidad 4</label>
                        </div>
                    </div>

				
			</form>

                        </div>
                        <div class="modal-footer  d-flex justify-content-center">
                          
                          <button type="submit" class="btn btn-enviar">Enviar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
            
            </div>
            <!-- Finaliza Ventana y formulario Debilidades-->     
            
             <!-- Comienza Ventana y formulario Amenazas-->     
      
          <div class="col-lg-4">
             
  <div class="card-body text-center">
                  <!-- Modal-->
                  <div id="myModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal animacion text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content modal4">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="titulo-modal ">Amenazas</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close cerrar-modal"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          <p>Escribe tus Amenazas en los recuadros</p>
                          
                          <form method="post">
				
				<div class="form-group">
                        <div class="controls">
                         <input type="text" id="amenaza1" class="floatLabel" name="amenaza1" required readonly value="<?php echo $a1 ?>">
                          <label for="amenaza1" class="active">Amenaza 1</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="amenaza2" class="floatLabel" name="amenaza2" required readonly value="<?php echo $a2 ?>">
                          <label for="amenaza2" class="active">Amenaza 2</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Amenaza3" class="floatLabel" name="Amenaza3" required readonly value="<?php echo $a3 ?>">
                          <label for="Amenaza3" class="active">Amenaza 3</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Amenaza4" class="floatLabel" name="Amenaza4" required readonly value="<?php echo $a4 ?>">
                          <label for="Amenaza4" class="active">Amenaza 4</label>
                        </div>
                    </div>

				
			</form>

                        </div>
                        <div class="modal-footer  d-flex justify-content-center">
                          
                          <button type="submit" class="btn btn-enviar">Enviar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            
            </div>
            <!-- Finaliza Ventana y formulario Amenazas-->     
        

				</div> 
                  
                
              
            
            
            
          </section> 
          

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
    <script src="../../../js/inputform.js"></script>
    
    <script>
      new WOW().init();
      </script>
      
      
      
    
     
    <!-- Main File-->
    <script src="../../../js/front.js"></script>
    
    <!-- modal -->
    <center>    <div class="modal fade" tabindex="-1" id="mostrarmodal" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
           

            <div class="fb-share-button" data-href="http://oceanmind.com.mx/compartir/trofeo-foda.php" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a>
            </div>
            
          </div>
          
          <form action="consultas/update-modal-foda.php" method="POST">
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
  if($edo_notificacion == 0){
     echo '
     <script>
                $(document).ready(function()
                {
                    $("#mostrarmodal").modal("show");
                });
            </script>
     '; 
  }
  ?>
  
            
            

  
   
  
</html>