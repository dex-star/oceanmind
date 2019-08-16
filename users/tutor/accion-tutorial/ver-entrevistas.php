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
        $consultas = mysqli_query($mysqli,"SELECT * FROM it");
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
    
    
    <link rel="stylesheet" href="../../../css/styledash.css">
    
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrappr animated slideInLeft">
       <div class=" logo-principal sidenav-header-inner" style="">
           <img src="../../../img/logoweb.png" class="img-fluid" alt="">
       </div>
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          
          <!-- User Info-->
         <div class="sidenav-header-inner text-center"><img src="../../../img/avatar-1.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="letra_usuario"><?php echo $_SESSION['usuario']['Nombres'] ?> <?php echo $_SESSION['usuario']['ApellidoP'] ?></h2><span>Tutor-Docente</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="../index.php" class="brand-small" > <strong>O·</strong><strong class="">U</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
           <div class="main-menu animated slideInLeft">
         <hr class="sidenav-heading justify-content-center">
            
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
           <li><a href="#normateca" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-book"></i>Normateca </a>
              <ul id="normateca" class="collapse list-unstyled animated bounceIn">
                <li><a href="../../tutor/normateca/normateca-info.php">Ver Material</a></li>
                
              </ul>
            </li>
            <li><a href="#pat" aria-expanded="false" data-toggle="collapse"><i class="fas fa-file-signature"></i>PAT</a>
              <ul id="pat" class="collapse list-unstyled animated bounceIn">
                <li><a href="../../tutor/pat/registro-pat.php">Registrar PAT</a></li>
                <li><a href="../../tutor/pat/administrar-pat.php">Administrar PAT</a></li>
              </ul>
            </li>
            <li><a href="#reporte" aria-expanded="false" data-toggle="collapse"> <i class="far fa-file-alt"></i>Reporte Mensual </a>
              <ul id="reporte" class="collapse list-unstyled animated bounceIn">
                <li><a href="../../tutor/reporte-mensual/registro-reporte.php">Nuevo Reporte </a></li>
                <li><a href="../../tutor/reporte-mensual/administrar-reporte.php">Ver Reportes</a></li>
             
              </ul>
            </li>
                 <li><a href="#tutorado" aria-expanded="false" data-toggle="collapse"><i class="far fa-address-book"></i>Acción Tutorial </a>
              <ul id="tutorado" class="collapse list-unstyled animated bounceIn">
                <li><a href="../../tutor/accion-tutorial/entrevistas.php">Entrevistas Individuales </a></li>
                <li><a href="../../tutor/accion-tutorial/ver-entrevistas.php">Ver Entrevistas</a></li>
             
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
            <a class="nav-link dropdown-toggle" id="notifications" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
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
      
   <div class="row justify-content-center mt-5 col-sm-12 ml-1 mr-1 container">
           <div class="col-md-10 col-sm-12">
              <div class="card">
              <div class="card-header d-flex justify-content-center ">
                 
              <h4 class="">Ver Entrevistas</h4>
                    </div>
                <div class="card-body">
        <div class="container">
		  <div class="table-responsive tabla-tutorados">
			  
					<table class="table ">
					  <thead>
						<tr class="table-primary titulo-tabla">
						  <th scope="col">Folio</th>
						  <th scope="col">Nombre</th>
						  <th scope="col">Editar</th>
						  <th scope="col">Eliminar</th>						  
						  <th scope="col">Descargar</th>
						</tr>
					  </thead>
					  
					
					  <tbody>
						<tr>
						  <th scope="row">001</th>
						  
						  <td>entrevista1.pdf</td>
						  <td><a href=""><i class="fas fa-edit fa-3x"></i></a></td>
						  <td><a href=""><i class="far fa-file-excel fa-3x"></i></a></td>
						  <td><a href=""><i class="fas fa-file-download fa-3x"></i></a></td>
						</tr>
						<tr>
						  <th scope="row">002</th>
						  <td>entrevista2.pdf</td>
						  <td><a href=""><i class="fas fa-edit fa-3x"></i></a></td>
						  <td><a href=""><i class="far fa-file-excel fa-3x"></i></a></td>
						  <td><a href=""><i class="fas fa-file-download fa-3x"></i></a></td>
						</tr>
				
						
					  </tbody>
					</table>
			  </div>

</div> 
                  
                </div>
              </div>
            </div>
           </div>
      
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
    <script src="../../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../vendor/jquery-validation/jquery.validate.min.js"></script>
		
   <script src="../../../vendor/chart.js/Chart.min.js"></script>
   
   <script src="../../../js/charts-custom.js"></script>
    <script src="../../../js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    
    <script src="../../../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../../../js/wow.min.js"></script>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
    <script src="../../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../../js/indexform.js"></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
    
    <script>
      new WOW().init();
      </script>
    <!-- Main File-->
    <script src="../../../js/front.js"></script>
  </body>
</html>