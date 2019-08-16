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
        require_once("../../php/conexion.php"); //enlazar el archivo de conexion
        $consultas = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $consultas2 = mysqli_query($mysqli,"SELECT * FROM usuarios WHERE IDUsuario = '$sesionActual' ");
        }catch(Exception $e){
            $error = $e->getMessage(); //usar funcion de mysqli para capturar el error e imprimirlo
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
    <link rel="stylesheet" href="../../css/styledashpersonal.css">
    <link rel="stylesheet" href="../../css/styleInput.css">
    <link rel="stylesheet" href="../../css/stylepassword.css">
    
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrappr animated slideInLeft">
       <div class=" logo-principal sidenav-header-inner" style="">
           <a href="#"><img src="../../img/logoweb.png" class="img-fluid" alt=""></a>
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
                            echo '<div class="sidenav-header-inner text-center"><img src="../../img/avatares/avatar-logica.png" alt="person" class="img-fluid ">';
                        }else{
                            echo '<div class="sidenav-header-inner text-center"><img src="../../img/avatares/avatar-desarrollo-humano.png" alt="person" class="img-fluid ">';    
                        }
                        
                     }else{
                        echo '<div class="sidenav-header-inner text-center"><img src="../../img/avatares/avatar-identificacion.png" alt="person" class="img-fluid ">';                    
                     }
                      
                  }else{
                      echo '<div class="sidenav-header-inner text-center"><img src="../../img/avatares/avatar-inicial.png" alt="person" class="img-fluid ">';
                  }
                  
            
            
            ?>
          
            <h2 class="letra_usuario"><?php echo $_SESSION['usuario']['Nombres'] ?> <?php echo $_SESSION['usuario']['ApellidoP'] ?></h2>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
         <div class="sidenav-header-logo"><a href="index.php" class="brand-small" ><img src="../../img/Logo.png" alt=""></a></div>
        </div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu animated slideInLeft">
          <hr class="sidenav-heading  justify-content-center">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="#" > <i class="far fa-user"></i>Identificación</a></li>
            <li><a href="#" aria-expanded="false" > <i class="far fa-smile-wink"></i>Desarrollo Humano </a>
              
            </li>
            <li><a href="#" aria-expanded="false" > <i class="far fa-lightbulb fa-2x"></i>Pensamiento </a>
              
            </li>
            <li><a href="#" aria-expanded="false" > <i class="fas fa-dumbbell"></i>Fortalecimiento </a>
              
            </li>
            <li><a href="#" aria-expanded="false" > <i class="fas fa-book"></i>Material de Lectura </a>
              
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
                  
                  <!--Migas de pan identificación-->
                  
                  <div class="col align-self-start">
                    <ol class="breadcrumb" style="background: none; color: white; width: auto; height: 30px; font-family: lato; ">
                        <li class="active">
                            <a style="font-size: 20px;font-family:lato">
                                <u>Actualización de contraseña</u>
                            </a>
                        </li>
                    </ol>
                </div> 
                  
                  
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                
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
            <a class="nav-link dropdown-toggle" id="notifications" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>
              <img class="img-xs rounded-circle" src="../../img/avatar-1.jpg" alt="Profile image" width="37px;" height="37px" style="margin-top: -8px">
            </a>
            <div class="dropdown-menu shadow p-3 mb-5 rounded dropdown-menu-right navbar-dropdown animated bounceInDown" aria-labelledby="UserDropdown">
                <a class="dropdown-item" href="#" >
                <i class="fas fa-user"></i><span>Perfil</span>
              </a>
         
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
      
      
       <div>
          
          <script>
          
          function comparar(){

                  var a = document.getElementById('pass').value;
                  var b = document.getElementById('newpass').value;
                  var ca = a.length;
                  var cb = a.length;
                  
                  if(a != b){
                      document.changepass.Cambiar.disabled=true;
                      document.getElementById('log').innerHTML = '<div class="alert alert-danger wow pulse" role="alert">Las contraseñas no coinciden!</div>';;
                  }else{
                      if(ca >= 8) {
                      document.changepass.Cambiar.disabled=false;
                      document.getElementById('log').innerHTML = '<div class="alert alert-success wow fadeInDown" role="alert">Listo!</div>';;
                      }else{
                      document.changepass.Cambiar.disabled=true;
                      document.getElementById('log').innerHTML = '<div class="alert alert-warning wow pulse" role="alert">Contraseña corta</div>';;
                      }
                  }
                }  
          
          
      </script>
         
         
          
          <form method="POST" action="consultas/update-seguridad.php" id="changepass" name="changepass">
              <?php while($datosconsulta2 = mysqli_fetch_array($consultas2)) { ?>
                <textarea name="IDUsuario" hidden=""><?php echo $datosconsulta2['IDUsuario']; ?></textarea>
              <?php } ?>
              <div class="row " id="step-1">
            <div class="col-md-12">
            <div class="col-xs-12">
            
                
                  <div class="container">
                <div class=" d-flex justify-content-center  ">
               
             <div class="fondo-card container">
               
              
               
                <h1 class="titulo-cambio">Por favor, Actualiza tu contraseña</h1>
          <p class="caracteres-cambio">Mínimo 8 caracteres, incluir minúsculas, mayúsculas y números.</p>
          
          
          <br>
          
          <div class="form-group d-flex justify-content-center ">
                
            <div class="controls">
              <input type="text" id="nickname"  class="floatLabel"  name="nickname" title="Apodo o nickname" required>
              <label for="pass" class="active">Apodo o nickname</label>
            </div>
            </div>
          
          
                <br>           

             <div class="form-group d-flex justify-content-center ">
                
            <div class="controls">
              <input type="password" id="pass"  class="floatLabel"  oninput="comparar()" name="pass" pattern=".{8,}" title="Mínimo 8 caracteres" required>
              <label for="pass" class="active">Nueva Contraseña</label>
            </div>
            </div>
                
          <br>
          
           <div class="form-group d-flex justify-content-center ">

            <div class="controls">
              <input type="password" id="newpass"  class="floatLabel"  oninput="comparar()" name="newpass" pattern=".{8,}" title="Mínimo 8 caracteres" required>
              <label for="pass" class="active">Confirmar Contraseña</label>
            </div>
            </div>
          <br>
          
          
          <div id="log"></div>

          <input type="submit" id="Cambiar" class="btn-cambiar" oninput="comparar()" value="Actualizar" disabled>
            </div>
          
                   
                    
  
                </div>
                </div>
         
                
            </div>
            
        </div>
       
    </div>
              
            
          </form>
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
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="../../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../../js/wow.min.js"></script>
    <script src="../../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
    <script src="../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../js/indexdash.js"></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
    <script src="../../js/indexdash.js"></script>
    <script src="../../js/inputform.js"></script>
    
    <script>
      new WOW().init();
      </script>
    <!-- Main File-->
    <script src="../../js/front.js"></script>
  </body>
</html>