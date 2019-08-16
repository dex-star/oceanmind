  <?php
    session_start();

      if(isset($_SESSION['usuario'])){
         if($_SESSION['usuario']['UsuarioTipo'] != 4 ){
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
          
        //AQUI EMPIEZA LO BUENO
        $ConsultaTutoradoNot = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $notific=mysqli_fetch_assoc($ConsultaTutoradoNot);
        $tutoradoNot = $notific['IDTutorado'];
        $notificaciones = mysqli_query($mysqli,"SELECT * FROM Notificaciones WHERE IDTutorado = '$tutoradoNot' OR IDTutorado = 0");
        
        $totalnotificaciones = "SELECT * FROM Notificaciones WHERE IDTutorado = '$tutoradoNot' OR IDTutorado = 0";
        $resultado_contar = $mysqli->query($totalnotificaciones); //ejecutar y almacenar la consulta;
        //AQUI TERMINO LO BUENO  
          
          
  ?>

  <?php
  //consulta tutorado
   $ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
          $data=mysqli_fetch_assoc($ConsultaTutorado);
          $tutorado = $data['IDTutorado']; 
  /* Fetch result set from t_test table */
  $data1=mysqli_query($mysqli,"SELECT * FROM `resultados-generales` WHERE IDTutorado = $tutorado");
  ?>

     <?php

  $data1=mysqli_query($mysqli,"SELECT * FROM `resultados-generales` WHERE IDTutorado = $tutorado");
          while($info=mysqli_fetch_array($data1))
          $porcentaje1 = $info['Identificacion'];
          if ($porcentaje1 == 0) {
             $pocentajeIdentificacion = 0;
          }if ($porcentaje1 == 1) {
             $pocentajeIdentificacion = 25;
          }elseif ($porcentaje1 == 2) {
             $pocentajeIdentificacion = 50;
          }elseif ($porcentaje1 == 3) {
             $pocentajeIdentificacion = 75;
          }elseif ($porcentaje1 == 4) {
             $pocentajeIdentificacion = 100;
          }elseif ($porcentaje1 > 4) {
             $pocentajeIdentificacion = 100;
          }
         
      ?>
   
   <?php

  $data2=mysqli_query($mysqli,"SELECT * FROM `resultados-generales` WHERE IDTutorado = $tutorado");
          while($info=mysqli_fetch_array($data2))
          $porcentaje2 = $info['DesarrolloHumano'];

          if ($porcentaje2 == 0) {
             $porcentajeDesarrollo = 0;
          }elseif ($porcentaje2 == 1) {
             $porcentajeDesarrollo = 33;
          }elseif ($porcentaje2 == 2) {
             $porcentajeDesarrollo = 66;
          }elseif ($porcentaje2 == 3) {
             $porcentajeDesarrollo = 100;
          }elseif ($porcentaje2 > 3) {
             $porcentajeDesarrollo = 100;
          }
         
      ?>
   <?php

  $data3=mysqli_query($mysqli,"SELECT * FROM `resultados-generales` WHERE IDTutorado = $tutorado");
          while($info=mysqli_fetch_array($data3))
          $porcentaje3 = $info['HabilidadesPensamiento'];
          if ($porcentaje3 == 0) {
             $porcentajePensamiento = 0;
          }elseif ($porcentaje3 == 1) {
             $porcentajePensamiento = 100;
          }elseif($porcentaje3 > 1){
             $porcentajePensamiento = 100;
          }
      ?>
      
       <?php

  $data4=mysqli_query($mysqli,"SELECT * FROM `resultados-generales` WHERE IDTutorado = $tutorado");
          while($info=mysqli_fetch_array($data4))
          $porcentaje4 = $info['Fortalecimiento'];
          if ($porcentaje4 == 0) {
             $porcentajeFortalecimiento = 0;
          }elseif ($porcentaje4 == 1) {
             $porcentajeFortalecimiento = 100;
          }elseif ($porcentaje4 > 1) {
             $porcentajeFortalecimiento = 100;
          }
      ?>
      <?php
         $por = "%";
      ?>

  <script>
     
     
      var general=[<?php

         $sql4=mysqli_query($mysqli,"SELECT * FROM `resultados-generales` WHERE IDTutorado = $tutorado");
                  while($info=mysqli_fetch_array($sql4))
           $general = $info['AvanceGeneral'];
           
           if ($general == 0) {
              $resultaGeneral = 0;
           }elseif ($general == 1) {
              $resultaGeneral = 12.5;
           }elseif ($general == 2) {
              $resultaGeneral = 25;
           }elseif ($general == 3) {
              $resultaGeneral = 37.5;
           }elseif ($general == 4) {
              $resultaGeneral = 50;
           }elseif ($general == 5) {
              $resultaGeneral = 62.5;
           }elseif ($general == 6) {
              $resultaGeneral = 75;
           }elseif ($general == 7) {
              $resultaGeneral = 87.5;
           }elseif ($general == 8) {
              $resultaGeneral = 100;
           }elseif ($general > 8) {
              $resultaGeneral = 100;
           }
           echo round ($resultaGeneral);

                  ?>];
      
      var rgeneral=[<?php
           $rg=mysqli_query($mysqli,"SELECT * FROM `resultados-generales` WHERE IDTutorado = $tutorado");
         while($info=mysqli_fetch_array($rg))
                       $rgeneral = $info['AvanceGeneral'];
                       $cien = 100;
                       $result = $cien-$resultaGeneral;
                       echo round ($result);
                     
                  ?>];
  ;
        
      

  </script>


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
      <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
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
      
      <!--css slider normateca-->
      <link rel="stylesheet" href="../../../css/slidernormateca.css">
        <link rel="stylesheet" href="style.css">
     <script src="../../../js/jquery.js"></script>
    <script src="../../../js/jquery.knob.js"></script>
    <script>
      $(document).ready(function() {
        //$(".dial").knob();
        $('.dial').knob({
          'min':0,
          'max':100,
          'width':250,
          'height':250,
          'displayInput':true,
          'fgColor':"#31C6C7",
          
        
          'change': function (v) { console.log(v); },
          draw: function () {
          $(this.i).val(this.cv + '%');},
          'readOnly':true
        });
      });
    </script>
    
   
   
  
    <style>
      .conta{
        margin:0 auto;
        text-align: center
       
      }
      h1{
        font-family: 'lato';
        font-size:20px;
        margin-bottom: 100px;
        font-weight: 600;
      }
      
      h6{
          font-family:lato;
          font-weight: 600;
          
      }
       @media (min-width: 320px) {
   .queri {
     
       
       min-width: 80px;
       max-width: 130px;
    }
  }
  .forta{
        background:#FFF; 
       
   }  
   .in{
          background: #00baf0;
      }
    .container{
      margin:0 auto;
      text-align: center
    }
    h1{
      font-family: 'lato';
      font-size:20px;
      margin-bottom: 100px;
      font-weight: 600;
    }
      @media (min-width: 320px) {
      
 .gris {
    color: 	#6070E4 ;
    font-family: lato;
   
    
     
  }
}
.knob-image {
        position: absolute;
        top: -160px;
        left: 25px;
        width: 150px !important;
        height: 150px !important;
        border-radius: 60%;
        background:#6070E4;
    }
    
    </style>
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
                        echo '<div class="sidenav-header-inner text-center"><img src="../../../img/avatares/avatar-identificacion.png" alt="person" class="img-fluide">';                    
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
                <div class="navbar-header "><a id="toggle-btn" href="#" class="menu-btn"><i class="fas fa-bars " style="line-height: inherit;"> </i></a><a href="index.html" class="navbar-brand">
                    <div class="brand-text d-none d-md-inline-block"></div></a></div>
                    
                      <!--Migas pan Dashboard-->
                      <div class="col align-self-start">
                    <ol class="breadcrumb" style="background: none; color: white; width: auto; height: 30px; font-family: lato; ">
                        <li>
                            <a style="font-size: 20px;" href="../general/general.php">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <div style="font-size: 20px;">&nbsp; > &nbsp;</div>
                        <li class="active">
                            <a style="font-size: 20px;font-family:lato">
                                <u>Fortalecimiento</u>
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
        <!-- Inicia Contenido -->
    
       
      <section class="row col-md-12 bg-white mb-5">
     
    <div class="col-md-6 container-fluid mt-4">
      <h1 class="mb-2 text-center">Progreso General</h1>
     <div class="conta mt-4">
        
   
     <input type="text" value="70%" class="dial queri"  data-width="150"  data-skin="tron"  data-thickness=".2"  data-angleOffset="">
    
    </div>

          </div>
     <div class="col-md-6 mt-4  " >
      <div class=" mt-4">
     <h6 class="text-center">OctoMind</h6>
    <div class="progress">
    <div class="progress-bar  bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 90%"><h4><h5 style="color:#FFF;">90%</h5></h4</div>
  </div>
     </div>
       <div class=" mt-5">
     <h6 class="text-center">TurtleMind</h6>
    <div class="progress">
    <div class="progress-bar bg-warning  progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:45%"><h4><h5 style="color:#FFF;">45%</h5></h4</div>
  </div>
     </div>
      <div class=" mt-5">
      <h6 class="text-center">DolphiMind</h6>
    <div class="progress" >
    <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:62%;"><h4><h5 style="color:#FFF;">70%</h5></h4></div>
  </div>
     </div>
     
     <!-- <div class=" mt-5 mb-5 ">
      <h6 class="text-center">FastMind</h6>
    <div class="progress">
    <div class="progress-bar  bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:75%"><h4><h5 style="color:#FFF;">75%</h5></h4</div>
  </div>
     </div>
     </div>!-->
   
     </section>
     
                  
        <!--Finaliza Contenido Prgreso general y por partes -->
        
          <!--Inicia Contenido Progreso de Apps -->
          <section>
              <h1 class="mt-3 mb-0 text-center">Progreso Apps</h1>
        <div class="col-md-12  container mb-5 ">
      
     
      <div class="row">
          
      <div class=" col-md-4 mt-5">
        <p class="gris"><strong>OctoMind</strong></p>
       <div class="knob " data-width="200" data-height="200" data-thickness=".2" data-displayInput=false data- angleOffset="90" ></div> 
<script>
    $('.knob').knob({
          'fgColor':"#6070E4 ",
          'change': function (v) { console.log(v); },
          draw: function () {
          $(this.i).val(this.cv);},
          'readOnly':true
        });        
    $(".knob").parent('div').css('position', 'relative',).prepend('<img src="octo.jpg" class="knob-image">');        
    $(".knob").val(90).trigger("change"); 
    
    
</script>
   </div> 
     
   <div class=" col-md-4 mt-5">
        <p class="gris"><strong>TurtleMind</strong></p>
       <div class="knob2" data-width="200" data-height="200" data-thickness=".2" data-displayInput=false data- angleOffset="90" ></div> 
<script>
   $('.knob2').knob({
          'fgColor':"#6070E4 ",
          'change': function (v) { console.log(v); },
          draw: function () {
          $(this.i).val(this.cv);},
          'readOnly':true
        });       
    $(".knob2").parent('div').css('position', 'relative').prepend('<img src="pulpy3.jpg" class="knob-image">');        
    $(".knob2").val(45).trigger("change"); 
</script>
   </div>
   
  <div class=" col-md-4 mt-5">
           <p class="gris"><strong>DolphiMind</strong></p>
            <div class="knob3" data-width="200" data-height="200" data-thickness=".2"   data-skin="tron" ></div> 
<script>
    
        
        $('.knob3').knob({
          'fgColor':"#6070E4 ",
          'change': function (v) { console.log(v); },
          draw: function () {
          $(this.i).val(this.cv);},
          'readOnly':true
        });
           
    $(".knob3").parent('div').css('position', 'relative').prepend('<img src="forta.jpg" class="knob-image">');        
    $(".knob3").val(70).trigger("change"); 
</script>
       
  </div>
              
    </div>
   </div>
   </section>
   
    <!--Finaliza Contenido Progreso de Apps -->

        
            <footer class="main-footer  mt-3 col-md-12">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 d-flex justify-content-center">
                 

              </div>
              <div class="col-md-12 d-flex justify-content-center">
                  <i class="fab fa-facebook fa-2x colorfooter"  aria-hidden="true"></i>
                        <i class="fab fa-twitter fa-2x "   aria-hidden="true"></i>
                        <i class="fab fa-youtube fa-2x "    aria-hidden="true"></i>
                        <i class="fab fa-instagram fa-2x"  aria-hidden="true"></i>
              </div>
             
            </div>
          </div>
        </footer>
      </div>
      <!-- JavaScript files-->
     
      <script src="../../../vendor/popper.js/umd/popper.min.js"> </script>
      <script src="../../../vendor/bootstrap/js/bootstrap.min.js"></script>
      <script src="../../../js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
      <script src="../../../vendor/jquery.cookie/jquery.cookie.js"> </script>
      <script src="../../../vendor/chart.js/Chart.min.js"></script>
      <script src="../../../vendor/jquery-validation/jquery.validate.min.js"></script>
      <script src="../../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="../../../js/slidernormateca.js"></script>

      
      <!-- Main File-->
      <script src="../../../js/front.js"></script>
    </body>
  </html>