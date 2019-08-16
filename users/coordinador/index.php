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
        require_once("../../php/conexion.php"); //enlazar el archivo de conexion
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
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/animate.css">
    <!-- Font Awesome CSS-->
       <link rel="stylesheet" href="../../vendor/font-awesome/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="../../css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="../../css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../../css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    
    <!-- Favicon-->
    <link rel="shortcut icon" href="../../img/logoweb.png">
    
     
    <!--css slider normateca-->
    
    
    <link rel="stylesheet" href="../../css/styledash.css">
    
     <script src="../../js/jquery.js"></script>
  <script src="../../js/jquery.knob.js"></script>
  <script>
  var por = "%";
    $(document).ready(function() {
        $(this).attr("value", $(this).attr("value") + "%");
      //$(".dial").knob();
      $('.dial').knob({
        'min':0,
        'max':100,
        'width':130,
        'height':130,
          
        'displayInput':true,
        'fgColor':"#00baf0 ",
        'change': function (v) { console.log(v); },
        draw: function () {
        $(this.i).val(this.cv + '%');},
        'readOnly':true,
      });
    });
  </script>
   <script>
    $(document).ready(function() {
      //$(".dial").knob();
      $('.dial2').knob({
        'min':0,
        'max':100,
        'width':130,
        'height':130,
          
        'displayInput':true,
        'fgColor':"#8AB839",
        'change': function (v) { console.log(v); },
        draw: function () {
        $(this.i).val(this.cv + '%');},
        'readOnly':true
      });
    });
  </script>
   <script>
    $(document).ready(function() {
      //$(".dial").knob();
      $('.dial3').knob({
        'min':0,
        'max':100,
        'width':130,
        'height':130,
        
          
        'displayInput':true,
        'fgColor':"#FABE28",
        
        'change': function (v) { console.log(v); },
        draw: function () {
        $(this.i).val(this.cv + '%');},
        'readOnly':true
      });
    });
  </script>
  
  <style>
    .container{
      margin:0 auto;
      text-align: center
    }
    h1{
      font-family: 'raleway';
      font-size:40px;
      margin-bottom: 100px;
    }
      @media (min-width: 320px) {
      
 .gris {
    color: 	#909090 ;
   
    
     
  }
}
      
                
      
  </style>
    
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrappr animated slideInLeft">
       <div class=" logo-principal sidenav-header-inner" style="">
           <a href="index.php"><img src="../../img/logoweb.png" class="img-fluid" alt=""></a>
       </div>
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="../../img/avatar-1.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="letra_usuario"><?php echo $_SESSION['usuario']['Nombres'] ?> <?php echo $_SESSION['usuario']['ApellidoP'] ?></h2>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="index.php" class="brand-small" > <strong>O·</strong><strong class="">U</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu animated slideInLeft">
          <hr class="sidenav-heading justify-content-center">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="#tutor" aria-expanded="false" data-toggle="collapse"><i class="fas fa-chalkboard-teacher"></i> Tutor</a>
              <ul id="tutor" class="collapse list-unstyled animated bounceIn">
                <li><a href="tutor/agregar-tutor.php">Registrar Tutor</a></li>
                <li><a href="tutor/administrar-tutor.php">Administrar Tutor</a></li>
              </ul>
            </li>
            <li><a href="#pat" aria-expanded="false" data-toggle="collapse"><i class="fas fa-file-signature"></i> PAT </a>
              <ul id="pat" class="collapse list-unstyled animated bounceIn">
                <li><a href="tutor/registro-pat.php">Registrar PAT</a></li>
                <li><a href="tutor/administrar-pat.php">Administrar PAT</a></li>
             
              </ul>
            </li>
                 <li><a href="#tutorado" aria-expanded="false" data-toggle="collapse"><i class="fas fa-user-graduate"></i>Tutorados </a>
              <ul id="tutorado" class="collapse list-unstyled animated bounceIn">
                <li><a href="tutor/agregar-tutorado.php">Agregar Tutorados </a></li>
                <li><a href="tutor/administrar-tutorado.php">Ver Tutorados</a></li>
             
              </ul>
            </li>
            <li><a href="#grupo" aria-expanded="false" data-toggle="collapse"><i class="fas fa-users"></i>Grupos Tutorías </a>
              <ul id="grupo" class="collapse list-unstyled animated bounceIn">
                <li><a href="tutor/agregar-grupo.php">Crear Grupo </a></li>
                <li><a href="tutor/administrar-grupo.php">Administrar Grupos</a></li>
             
              </ul>
            </li>
            <li><a href="#normateca" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-book"></i>Normateca </a>
              <ul id="normateca" class="collapse list-unstyled animated bounceIn">
                <li><a href="tutor/ver-material.php">Ver Material</a></li>
                <li><a href="tutor/agregar-material.php">Agregar Material</a></li>
                
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
              <img class="img-xs rounded-circle" src="../../img/avatar-1.jpg" alt="Profile image" width="37px;" height="37px" style="margin-top: -8px">
            </a>
            <div class="dropdown-menu shadow rounded p-3 mb-5 navbar-dropdown drop-sesion dropdown-menu-right navbar-dropdown animated bounceInDown" aria-labelledby="UserDropdown">

              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../salir.php">
                <i class="fas fa-sign-out-alt"></i><span>Salir</span>
              </a>
            </div>
          </li>
                
              </ul>
            </div>
          </div>
        </nav>
      </header>
        <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <!-- Count item widget-->
            <div class="col-xl-3  col-6 ">
              <div class="wrapper count-title">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="name"><strong class="text-uppercase">Grupos Tutorías</strong><span>hace 7 min</span>
                  <div class="count-number">15</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-3  col-6">
              <div class="wrapper count-title">
                <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="name"><strong class="text-uppercase">Tutores</strong><span>hace 7 min</span>
                  <div class="count-number">15</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-3  col-6">
              <div class="wrapper count-title ">
                <div class="icon"><i class="fas fa-user-graduate"></i></div>
                <div class="name"><strong class="text-uppercase">Tutorados</strong><span>hace 7 min</span>
                  <div class="count-number">450</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-3  col-6">
              <div class="wrapper count-title ">
                <div class="icon"><i class="fas fa-file-alt"></i></div>
                <div class="name"><strong class="text-uppercase">Reporte Mensual</strong><span>hace 7 min</span>
                  <div class="count-number">20</div>
                </div>
              </div>
            </div>
   
          </div>
        </div>
      </section>
      
       <section class="dashboard-header section-padding">
        <div class="container-fluid">
          <div class="row d-flex align-items-md-stretch">
            <!-- To Do List-->
            <div class="col-lg-12 col-md-12 mt-3">
			  <div class="">
			  	  <p class="universidad"><strong>Escuela :</strong> <br>Instituto Tecnológico Superior de Felipe Carrillo Puerto </p>
             
			  </div>
             </div>
            
         
          </div>
        </div>
      </section>
  
      <!-- Statistics Section-->
      <section class="statistics m-4">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-4">
              <!-- Income-->
              <div class="card income text-center">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="number">320</div><strong class="text-primary">Usuarios</strong>
                <p>Total de usuarios registrados en la plataforma</p>
              </div>
            </div>
            <div class="col-lg-4">
              <!-- Monthly Usage-->
              <div class="card data-usage">
                <h2 class="display h4">Uso Mensual</h2>
                <div class="row d-flex align-items-center">
                  <div class="col-sm-6">
                    <div id="progress-circle" class="d-flex align-items-center justify-content-center"></div>
                  </div>
                  <div class="col-sm-6"><strong class="text-primary">230 visitas</strong><small>Plan Establecido</small><span>300 visitas</span></div>
                </div>
                <p>Se ha establecido un rango de consumo mensual.</p>
              </div>
            </div>
            <div class="col-lg-4">
              <!-- User Actibity-->
              <div class="card user-activity">
                <h2 class="display h4">Usuarios Activos</h2>
                <div class="number">210</div>
                <h3 class="h4 display">Conectados</h3>
                <div class="progress">
                  <div role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary"></div>
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </section>
              <section class="charts">
        <div class="container-fluid">
          <!-- Page Header-->
          
          <div class="row">
            <div class="col-lg-6">
              <div class="card line-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h4>Progreso de Tutor</h4>
                </div>
                <div class="card-body">
                  <canvas id="lineChartExample"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card bar-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h4>Grupos de Tutorias</h4>
                </div>
                <div class="card-body">
                  <canvas id="barChartExample"></canvas>
                </div>
              </div>
            </div>
            
            
            
            
            
            <div class="col-lg-12 justify-content-center text-center ">
              <div class="card polar-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h4>Habilidades de Pensamiento</h4>
                </div>
                <div class="card-body">
                  <div class="chart-container">
                    <canvas id="polarChartExample"></canvas>
                  </div>
                  <p>Estadística General de Habilidades de Pensamiento</p>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        
        
      </section>
       
      
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
   
    <script src="../../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/jquery-validation/jquery.validate.min.js"></script>
		
   <script src="../../vendor/chart.js/Chart.min.js"></script>
   
 <script src="../../js/charts-custom-coordinador.js"></script>
    <script src="../../js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    
    <script src="../../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../../js/wow.min.js"></script>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
    <script src="../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../js/indexdash.js"></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
    
    <script>
      new WOW().init();
      </script>
    <!-- Main File-->
    <script src="../../js/front.js"></script>
  </body>
</html>