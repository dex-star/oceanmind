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
    
  </head>
  <body>
      <!--Comentarios de facebook-->
      <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
            <h2 class="letra-usuario"><?php echo $_SESSION['usuario']['Nombres'] ?> <?php echo $_SESSION['usuario']['ApellidoP'] ?></h2>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="../index.php" class="brand-small" > <strong>O·</strong><strong class="">U</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu animated slideInLeft">
          <hr class="sidenav-heading justify-content-center">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="#tutor" aria-expanded="false" data-toggle="collapse"><i class="fas fa-university"></i> Coordinador</a>
              <ul id="tutor" class="collapse list-unstyled animated bounceIn">
                <li><a href="registrar-coordinador.php">Registrar Coordinador</a></li>
                <li><a href="administrar-cordinador.php">Administrar Coordinador</a></li>
              </ul>
            </li>
            <li><a href="#pat" aria-expanded="false" data-toggle="collapse"> <i class="far fa-smile-wink"></i>IT </a>
              <ul id="pat" class="collapse list-unstyled animated bounceIn">
                <li><a href="registrar-it.php">Registrar IT </a></li>
                <li><a href="administrar-it.php">Administrar IT</a></li>
             
              </ul>
            </li>
            <li><a href="#normateca" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-book"></i>Material de Lectura </a>
              <ul id="normateca" class="collapse list-unstyled animated bounceIn">
                <li><a href="administrar-material.php">Ver Material</a></li>
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
            <a class="nav-link dropdown-toggle" id="notifications" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
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
            <div class="col-xl-3 col-md-12 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="fas fa-user-tie"></i></div>
                <div class="name"><strong class="text-uppercase">Coordinadores</strong><span>hace 7 min</span>
                  <div class="count-number">25</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-3 col-md-12 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="name"><strong class="text-uppercase">Tutores</strong><span>hace 7 min</span>
                  <div class="count-number">20</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-3 col-md-12 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="fas fa-user-graduate"></i></div>
                <div class="name"><strong class="text-uppercase">Tutorados</strong><span>hace 7 min</span>
                  <div class="count-number">500</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-3 col-md-12 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="fas fa-university"></i></div>
                <div class="name"><strong class="text-uppercase">Institución de Educación Superior</strong><span>hace 7 min</span>
                  <div class="count-number">25</div>
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
            <div class="col-lg-3 col-md-6">
              <div class="card to-do">
                <h2 class="display h4">Tareas</h2>
                <p>Lista de Tareas pendientes</p>
                <ul class="check-lists list-unstyled">
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-1" name="list-1" class="form-control-custom">
                    <label for="list-1">Similique sunt in culpa qui officia</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-2" name="list-2" class="form-control-custom">
                    <label for="list-2">Ed ut perspiciatis unde omnis iste</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-3" name="list-3" class="form-control-custom">
                    <label for="list-3">At vero eos et accusamus et iusto </label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-4" name="list-4" class="form-control-custom">
                    <label for="list-4">Explicabo Nemo ipsam voluptatem</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-5" name="list-5" class="form-control-custom">
                    <label for="list-5">Similique sunt in culpa qui officia</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-6" name="list-6" class="form-control-custom">
                    <label for="list-6">At vero eos et accusamus et iusto </label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-7" name="list-7" class="form-control-custom">
                    <label for="list-7">Similique sunt in culpa qui officia</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-8" name="list-8" class="form-control-custom">
                    <label for="list-8">Ed ut perspiciatis unde omnis iste</label>
                  </li>
                </ul>
              </div>
            </div>
          
          
            <!-- Line Chart -->
            <div class="col-lg-6 col-md-12 flex-lg-last flex-md-first align-self-baseline">
              <div class="card sales-report">
                <h2 class="display h4">Actividad de la plataforma</h2>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet officiis</p>
                <div class="line-chart">
                  <canvas id="lineChartExample"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Statistics Section-->
      <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-4">
              <!-- Income-->
              <div class="card income text-center">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="number">545</div><strong class="text-primary">Usuarios</strong>
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
                <p>Se ha establecido un rango de visitas al mes.</p>
              </div>
            </div>
            <div class="col-lg-4">
              <!-- User Actibity-->
              <div class="card user-activity">
                <h2 class="display h4">Actividad de Usuario</h2>
                <div class="number">47</div>
                <h3 class="h4 display">Conectados</h3>
                <div class="progress">
                  <div role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary"></div>
                </div>
                <div class="page-statistics d-flex justify-content-between">
                 
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Updates Section -->
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4 col-md-12">
              <!-- Recent Updates Widget          -->
              <div id="new-updates" class="card updates recent-updated">
                <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box">	Orienta·News</a></h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
                </div>
                <div id="updates-box" role="tabpanel" class="collapse show">
                  <ul class="news list-unstyled">
                    
                    
                    <li class="d-flex justify-content-between"> 
                      <div class="left-col d-flex">
                        <div class="icon"><i class="icon-rss-feed"></i></div>
                       <a class="twitter-timeline"
  href="https://twitter.com/TwitterDev"
  data-tweet-limit="3">
Tweets by @TwitterDev
</a>
                      </div>
                      <div class="right-col text-right">
                        <div class="update-date">24<span class="month">Jan</span></div>
                      </div>
                    </li>
                    <!-- Item-->
                    <li class="d-flex justify-content-between"> 
                      <div class="left-col d-flex">
                        <div class="icon"><i class="icon-rss-feed"></i></div>
                        <div class="title"><strong>¡OrientaU en Marcha!.</strong>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                        </div>
                      </div>
                      <div class="right-col text-right">
                        <div class="update-date">24<span class="month">Jan</span></div>
                      </div>
                    </li>
                    <!-- Item-->
                    <li class="d-flex justify-content-between"> 
                      <div class="left-col d-flex">
                        <div class="icon"><i class="icon-rss-feed"></i></div>
                        <div class="title"><strong>¡Somos mas los buenos en OrientaU!</strong>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                        </div>
                      </div>
                      <div class="right-col text-right">
                        <div class="update-date">24<span class="month">Jan</span></div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- Recent Updates Widget End-->
            </div>
            <div class="col-lg-4 col-md-6">
              <!-- Daily Feed Widget-->
              <div id="daily-feeds" class="card updates daily-feeds">
                <div id="feeds-header" class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h5 display text-center"><a data-toggle="collapse" data-parent="#daily-feeds" href="#feeds-box" aria-expanded="true" aria-controls="feeds-box">Comentarios </a></h2>
                 
                </div>
                <div id="feeds-box" role="tabpanel" class="collapse show">
                <div class="bg-white container mb-4">
        
            <div class="">
                <div class="fb-comments" data-href="http://redgeek.online/orienta-u/users/tutorado/general/general.php" data-width="100%" data-numposts="10"></div>
                
            </div>
        </div>
                </div>
              </div>
              <!-- Daily Feed Widget End-->
            </div>
            <div class="col-lg-4 col-md-6">
              <!-- Recent Activities Widget      -->
              <div id="recent-activities-wrapper" class="card updates activities">
                <div id="activites-header" class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h5 display"><a data-toggle="collapse" data-parent="#recent-activities-wrapper" href="#activities-box" aria-expanded="true" aria-controls="activities-box">Actividades Recientes</a></h2><a data-toggle="collapse" data-parent="#recent-activities-wrapper" href="#activities-box" aria-expanded="true" aria-controls="activities-box"><i class="fa fa-angle-down"></i></a>
                </div>
                <div id="activities-box" role="tabpanel" class="collapse show">
                  <ul class="activities list-unstyled">
                    <!-- Item-->
                    <li>
                      <div class="row">
                        <div class="col-4 date-holder text-right">
                          <div class="icon"><i class="icon-clock"></i></div>
                          <div class="date"> <span>6:00 am</span><span class="text-info">6 hours ago</span></div>
                        </div>
                        <div class="col-8 content"><strong>Nuevo Registro</strong>
                          <p>El instituto tecnologico de Felipe Carrillo Puerto se ha unido a Orienta·U</p>
                        </div>
                      </div>
                    </li>
                    <!-- Item-->
                    <li>
                      <div class="row">
                        <div class="col-4 date-holder text-right">
                          <div class="icon"><i class="icon-clock"></i></div>
                          <div class="date"> <span>6:00 am</span><span class="text-info">6 hours ago</span></div>
                        </div>
                        <div class="col-8 content"><strong>Nuevo Registro</strong>
                          <p>El Centro Regional de Educacion Normal de Felipe Carrillo Puerto Se ha unido a Orienta·U</p>
                        </div>
                      </div>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
     <!--Inicio de Preguntas-->
     
       
     
      <!--Fin de Preguntas-->
      
     
     
      
       
      
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
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../js/charts-custom-coordinador.js"></script>
    <script src="../../vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="../../js/charts-home.js"></script>
   <script src="../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    
    <script src="../../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../../js/wow.min.js"></script>
    <script src="../../vendor/jquery-validation/jquery.validate.min.js"></script>
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