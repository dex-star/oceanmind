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
.azu{
    background:#00baf0;
}
      
                
      
  </style>
    
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrappr animated slideInLeft">
       <div class=" logo-principal sidenav-header-inner" style="">
           <img src="../../img/logoweb.png" class="img-fluid" alt="">
       </div>
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="../../img/avatar-1.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="letra_usuario"><?php echo $_SESSION['usuario']['Nombres'] ?> <?php echo $_SESSION['usuario']['ApellidoP'] ?></h2><span>Tutor-Docente</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="../index.html" class="brand-small" > <strong>O·</strong><strong class="">U</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu animated slideInLeft">
          <hr class="sidenav-heading justify-content-center">
            
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
           <li><a href="#normateca" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-book"></i>Material de lectura </a>
              <ul id="normateca" class="collapse list-unstyled animated bounceIn">
                <li><a href="../tutor/normateca/normateca-info.php">Ver Material</a></li>
                
              </ul>
            </li>
            <li><a href="#pat" aria-expanded="false" data-toggle="collapse"><i class="fas fa-file-signature"></i>Reportes</a>
              <ul id="pat" class="collapse list-unstyled animated bounceIn">
                <li><a href="../tutor/pat/registro-pat.php">Reporte</a></li>
                <li><a href="../tutor/pat/administrar-pat.php">Administrar PAT</a></li>
              </ul> 
            </li>
            <li><a href="#reporte" aria-expanded="false" data-toggle="collapse"> <i class="far fa-file-alt"></i>Alumnos</a>
              <ul id="reporte" class="collapse list-unstyled animated bounceIn">
                <li><a href="../tutor/reporte-mensual/registro-reporte.php">Nuevo Reporte </a></li>
                <li><a href="../tutor/reporte-mensual/administrar-reporte.php">Ver Reportes</a></li>
             
              </ul>
            </li>
                 <li><a href="#tutorado" aria-expanded="false" data-toggle="collapse"><i class="far fa-address-book"></i>Registros</a>
              <ul id="tutorado" class="collapse list-unstyled animated bounceIn">
                <li><a href="../tutor/accion-tutorial/entrevistas.php">Entrevistas Individuales </a></li>
                <li><a href="../tutor/accion-tutorial/ver-entrevistas.php">Ver Entrevistas</a></li>
             
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
          <div class="row col-md-12">
            <!-- Count item widget-->
            <div class="col-xl-6 col-md-6 ">
              <div class="wrapper count-title">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="name"><strong class="text-uppercase">Grupos</strong><span>hace 7 min</span>
                  <div class="count-number">1</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-6 col-md-6 ">
              <div class="wrapper count-title">
                <div class="icon"><i class="fas fa-chalkboard-teacher fa-5x"></i></i></div>
                <div class="name"><strong class="text-uppercase">Alumnos</strong><span>hace 7 min</span>
                  <div class="count-number">27</div>
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
			  	  <p class="universidad"><strong>Escuela :</strong> <br>Instituto Tecnologico Superior de Felipe Carrillo Puerto </p>
             
			  </div>
             </div>
             
          </div>
        </div>
      </section>
  
      <!-- Statistics Section-->
   
              <section class="charts">
        <div class="container-fluid">
          <!-- Page Header-->
          
          <div class="row">
            <div class="col-lg-6">
              <div class="card line-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h4>Progreso de Docentes</h4>
                </div>
                <div class="card-body">
                  <canvas id="lineChartExample"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card bar-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h4>Desarrollo Humano</h4>
                </div>
                <div class="card-body">
                  <canvas id="barChartExample"></canvas>
                </div>
              </div>
            </div>
            
           
            
            <div class="col-lg-12">
              <div class="card polar-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h4>Habilidades de Pensamiento</h4>
                </div>
                <div class="card-body">
                  <div class="chart-container">
                    <canvas id="polarChartExample"></canvas>
                  </div>
                  <p>Estadistica general de Hab. Pensamiento en el grupo </p>
                </div>
              </div>
            </div>
            
            
            
          </div>
        </div>
      </section>
      
      <section class="">
           <div class="container-fluid">
        <div class=" col-md-12 card container-fluid text-center">
               <div class="card-header d-flex text-center">
                  <h4 class="text-center">Desarrollo Humano</h4>
                </div>
                
<div class="row card-body container ">
                      
  <div class=" col-md-4 mt-3">
        <p class="gris">Autoestima</p>

        <input type="text" value="90" class="dial queri" data-width="150"  data-skin="tron" data-thickness=".3"  data-angleOffset="90">
         <!-- <input type="text" value="55" class="dial" data-width="200" data-thickness=".32" data-fgColor="#008BE8" data-bgColor="#EEEEEE" data-cursor=false data-displayInput="true" data-readOnly=true > -->
  </div>
   <div class=" col-md-4 mt-3">
        <p class="gris">Asertividad</p>
       <input type="text" value="50" class="dial2 queri" data-width="150"  data-skin="tron" data-thickness=".3"  data- angleOffset="90">
        <!-- <input type="text" value="55" class="dial" data-width="200" data-thickness=".32" data-fgColor="#008BE8" data-bgColor="#EEEEEE" data-cursor=false data-displayInput="true" data-readOnly=true > -->
   </div>
  <div class=" col-md-4 mt-3">
           <p class="gris">Habilidades de Estudio</p>
       <input type="text" value="100" class="dial3 queri" data-width="150"  data-skin="tron" data-thickness=".3"  data-angleOffset="90" >
         <!-- <input type="text" value="55" class="dial" data-width="200" data-thickness=".32" data-fgColor="#008BE8" data-bgColor="#EEEEEE" data-cursor=false data-displayInput="true" data-readOnly=true > -->
  </div>
                     
        </div>
            <p class="gris">Estadística General de Desarrollo Humano</p>
        </div>
            
        </div>
          
      </section>
      
    
       <section class="col-md-12 bg-white container-fluid">
    <div class="card-header d-flex text-center">
                  <h4 class="text-center">Fortalecimiento</h4>
                </div>
  
   <div class="row col-md-12 mb-5 card-body container-fluid">
    
  
  
    <div class=" col-md-12 mb-3 mt-3">
   <h6 class="text-center">OctoMind</h6>
 <img src="../../img/octo.jpg" alt="person" class="img-fluid rounded-circle mb-3 " width="80px" height="80px">
 <div class="progress mb-3">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
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
   
   <script src="../../js/charts-custom.js"></script>
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