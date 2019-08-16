<?php 
ini_set('date.timezone', 'America/Mexico_City');

                $time = date('Y/m/d', time());
?>
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

        $sesionActual = $_SESSION['usuario']['IDUsuario'];
    try{
        require_once("../../../php/conexion.php"); //enlazar el archivo de conexion
        $consultas = mysqli_query($mysqli,"SELECT * FROM coordinador WHERE IDUsuario = '$sesionActual' ");
        }catch(Exception $e){
            $error = $e->getMessage(); //usar funcion de mysqli para capturar el error e imprimirlo
        }
        
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Orienta·U</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
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
    <link rel="stylesheet" href="../../../css/styleformpersonal.css">
<link rel="stylesheet" href="../../../css/styleInputForm.css">
    <!-- Custom stylesheet - for your changes-->
    
    <!-- Favicon-->
    <link rel="shortcut icon" href="../../../img/logoweb.png">
    
     
    <!--css slider normateca-->
    
    
    <link rel="stylesheet" href="../../css/styledash.css">
    
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrappr animated slideInLeft">
       <div class=" logo-principal sidenav-header-inner" style="">
           <a href="../index.php"><img src="../../../img/logoweb.png" class="img-fluid" alt=""></a>
       </div>
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="../../../img/avatar-1.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5"><?php echo $_SESSION['usuario']['Nombres'] ?> <?php echo $_SESSION['usuario']['ApellidoP'] ?></h2>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="../index.php" class="brand-small" > <strong>O·</strong><strong class="">U</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu animated slideInLeft">
          <hr class="sidenav-heading justify-content-center">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="#tutor" aria-expanded="false" data-toggle="collapse"><i class="fas fa-chalkboard-teacher"></i> Tutor</a>
              <ul id="tutor" class="collapse list-unstyled animated bounceIn">
                <li><a href="agregar-tutor.php">Registrar Tutor</a></li>
                <li><a href="administrar-tutor.php">Administrar Tutor</a></li>
              </ul>
            </li>
            <li><a href="#pat" aria-expanded="false" data-toggle="collapse"><i class="fas fa-file-signature"></i> PAT </a>
              <ul id="pat" class="collapse list-unstyled animated bounceIn">
                <li><a href="registro-pat.php">Registrar PAT </a></li>
                <li><a href="administrar-pat.php">Administrar PAT</a></li>
             
              </ul>
            </li>
                 <li><a href="#tutorado" aria-expanded="false" data-toggle="collapse"><i class="fas fa-user-graduate"></i>Tutorados </a>
              <ul id="tutorado" class="collapse list-unstyled animated bounceIn">
                <li><a href="agregar-tutorado.php">Agregar Tutorados </a></li>
                <li><a href="administrar-tutorado.php">Ver Tutorados</a></li>
             
              </ul>
            </li>
            <li><a href="#grupo" aria-expanded="false" data-toggle="collapse"><i class="fas fa-users"></i>Grupos Tutorías </a>
              <ul id="grupo" class="collapse list-unstyled animated bounceIn">
                <li><a href="agregar-grupo.php">Crear Grupo </a></li>
                <li><a href="administrar-grupo.php">Administrar Grupos</a></li>
             
              </ul>
            </li>
            <li><a href="#normateca" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-book"></i>Normateca </a>
              <ul id="normateca" class="collapse list-unstyled animated bounceIn">
                <li><a href="ver-material.php">Ver Material</a></li>
                <li><a href="agregar-material.php">Agregar Material</a></li>
                
              </ul>
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
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Logros dropdown-->
                  
                <!-- Notificaciones dropdown-->
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell fa-2x"></i><span class="badge contadornoti">12</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu shadow p-3 mb-5 bg-white rounded dropdown-menu-right navbar-dropdown animated bounceInDown">
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-envelope"></i>You have 6 new messages </div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-upload"></i>Server Rebooted</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                          <div class="notification-time"><small>10 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view all notifications                                            </strong></a></li>
                  </ul>
                </li>
                
              
                <!-- Log out-->
                     <li class="nav-item dropdown  ">
            <a class="nav-link dropdown-toggle" id="notifications" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="img-xs rounded-circle" src="../../../img/avatar-1.jpg" alt="Profile image" width="37px;" height="37px" style="margin-top: -8px">
            </a>
            <div class="dropdown-menu shadow rounded p-3 mb-5 navbar-dropdown drop-sesion dropdown-menu-right navbar-dropdown animated bounceInDown" aria-labelledby="UserDropdown">
 
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
      <!--Contenido-->
                       
     <!--Inicio Contenido-->
     <div class="row justify-content-center mt-5 col-sm-12 ml-1 mr-1 container">
           <div class="col-md-10 col-sm-12">
              <div class="card">
              <div class="card-header d-flex justify-content-center ">
                 
              <h4 class="">Registrar Coordinador</h4>
                    </div>
                <div class="card-body">
        <div class="container">

<form role="form" id="form" action="consultas/insertar-coordinador.php" method="post">
    
        <div class="col-md-12">
            <div class="col-xs-12">
                <div class="form-group">
               
			    <div class="form-controlGroup">
					<input class="form-input" name="Correo" type="text" id="Correo" required/>
					<label class="form-label" for="Correo">Correo Institucional:</label>
					<i class="form-inputBar"></i>
				</div>
                <div class="form-controlGroup">
					<input class="form-input" name="Password" type="password" name="" id="Pass" required/>
					<label class="form-label" for="PAss">Contraseña:</label>
					<i class="form-inputBar"></i>
                </div>        
				
				<div class="form-controlGroup">
					<select id="user" readonly="" name="UsuarioTipo" class="form-input form-input--select" required>
						 <option value="3">Coordinador</option>
                    </select>
					<label class="form-label" for="user">Cargo:</label>
					<i class="form-inputBar"></i>
				</div>
                    
                <div class="form-controlGroup">
					<input class="form-input" name="Nombres" type="text" name="" id="Nombres" required/>
					<label class="form-label" for="Nombres">Nombre:</label>
					<i class="form-inputBar"></i>
                </div>
                    
                <div class="form-controlGroup">
					<input class="form-input" name="ApellidoP" type="text" name="" id="ApellidoP" required/>
					<label class="form-label" for="ApellidoP">Apellido Paterno:</label>
					<i class="form-inputBar"></i>
                </div>
                    
                <div class="form-controlGroup">
					<input class="form-input" name="ApellidoM" type="text" name="" id="ApellidoM" required/>
					<label class="form-label" for="ApellidoM">Apellido Materno:</label>
					<i class="form-inputBar"></i>
                </div>
                    
                <div class="form-controlGroup">
					<select id="Sexo" name="Sexo" class="form-input form-input--select" required>
						 <option value="0">Femenino</option>
                         <option value="1">Masculino</option>
                    </select>
					<label class="form-label" for="user">Sexo:</label>
					<i class="form-inputBar"></i>
				</div>
                    
                <div class="form-controlGroup">
					<input class="form-control" name="FechaNacimiento" type="date" value="2011-08-19" id="FechaNacimiento">
					<label class="form-label" for="FechaNacimiento">Fecha de Nacimiento:</label>
					<i class="form-inputBar"></i>
                </div>
                    
                <div class="form-controlGroup">
					<input class="form-control" readonly="" name="FechaAlta" type="text" value="<?php echo $time?>" id="FechaAlta">
					<label class="form-label" for="FechaAlta">Fecha Alta:</label>
					<i class="form-inputBar"></i>
                </div>
                <div class="form-controlGroup">
					<input class="form-control" name="LinnkFoto" type="text" id="LinnkFoto">
					<label class="form-label" for="LinnkFoto">Foto:</label>
					<i class="form-inputBar"></i>
                </div>    
                
                <button class="btn btn-success d-flex  justify-content-center" required  type="submit">Registrar</button>
                 
                </div>
         
                
            </div>
        </div>
    
</form>
</div> 
                  
                </div>
              </div>
            </div>
           </div>
 
     
         
      <!--Fin Contenido-->
      
     
     
      
       
      
      <footer class="main-footer  mt-3 col-md-12">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
               <p class="text">&copy; Orienta·U 2018</p>

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
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="../../../js/charts-home.js"></script>
   <script src="../../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../../js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    
    <script src="../../../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../../../js/wow.min.js"></script>
    <script src="../../../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
    <script src="../../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../../js/indexdash.js"></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
    
    <script>
      new WOW().init();
      </script>
    <!-- Main File-->
    <script src="../../../js/front.js"></script>
  </body>
</html>