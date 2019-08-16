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
        
        
        
        
?>

<?php

$ConsultaTutorado = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $data=mysqli_fetch_assoc($ConsultaTutorado);
        $tutorado = $data['IDTutorado'];

        //CONSULTA IDLINEAVIDA
        $ConsultaEstilos = mysqli_query($mysqli,"SELECT IDTutorado, IDResultado FROM `resultado-estilos-aprendizaje` WHERE IDTutorado = '$tutorado'");
        $data2=mysqli_fetch_assoc($ConsultaEstilos);
        $estilos = $data2['IDResultado'];
        
         //CONSULTA NOTIFICACIÓN
        $ConsultaNotificacion = mysqli_query($mysqli,"SELECT * FROM `Notificaciones` WHERE IDTutorado = '$tutorado' AND Descripcion = 'Avatar-1 desbloqueado' ");
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


/* Fetch result set from t_test table */
$data1=mysqli_query($mysqli,"SELECT * FROM `resultado-estilos-aprendizaje` WHERE IDResultado = $estilos");
?>


  
    <?php

            while($info=mysqli_fetch_array($data1))
            $porcentajeVisual = $info['Visual']/35 * 100;
            $resV = round ($porcentajeVisual);
            $RV=$resV;
        ?>
    


     <?php
$data2=mysqli_query($mysqli,"SELECT * FROM `resultado-estilos-aprendizaje` WHERE IDResultado = $estilos");

                while($info=mysqli_fetch_array($data2))
                     $porcentajeAuditivo = $info['Auditivo']/35 * 100;
                    
                     $resA = round ($porcentajeAuditivo);
                     $RA=$resA;
    ?>
  
 
     
    <?php
               
              $data3=mysqli_query($mysqli,"SELECT * FROM `resultado-estilos-aprendizaje` WHERE IDResultado = $estilos");      
                    while($info=mysqli_fetch_array($data3))
                     $porcentajeKinestesico = $info['Kinestesico']/35 * 100;
                     $resK = round ($porcentajeKinestesico);
                     $RK= $resK;
                    
                ?>
  
    <script>
      <?php 
$data4=mysqli_query($mysqli,"SELECT * FROM `resultado-estilos-aprendizaje` WHERE IDResultado = $estilos");
?>

     var Visu=[<?php
                while($info=mysqli_fetch_array($data4))
                    $visual= $info['Visual'].'';
         
                ?>];
    
      <?php 
$data5=mysqli_query($mysqli,"SELECT * FROM `resultado-estilos-aprendizaje` WHERE IDResultado = $estilos");
?>

     var Audi=[<?php
                while($info=mysqli_fetch_array($data5))
                    $auditivo=$info['Auditivo'].'';
                ?>];
    
     
      <?php 
$data6=mysqli_query($mysqli,"SELECT * FROM `resultado-estilos-aprendizaje` WHERE IDResultado = $estilos");
?>

     var Kines=[<?php
                while($info=mysqli_fetch_array($data6))
                    $kinestesico=$info['Kinestesico'].'';
                ?>];
    
 var por = "%";
   
    
</script>


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
    
    <!--css slider normateca-->
    <link rel="stylesheet" href="../../../css/slidernormateca.css">
    <script src="../../../js/jquery.js"></script>
    <script src="../../../js/jquery.knob.js"></script>
    <script>
    $(document).ready(function() {
        $(this).attr("value", $(this).attr("value") + "%");
      //$(".dial").knob();
      $('.dial').knob({
        'min':0,
        'max':100,
        'width':170,
        'height':170,
          
        'displayInput':true,
        'fgColor':"#4E5258 ",
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
        'width':170,
        'height':170,
          
        'displayInput':true,
        'fgColor':"#31C6C7",
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
        'width':170,
        'height':170,
        
          
        'displayInput':true,
        'fgColor':"#FDC134",
        
        'change': function (v) { console.log(v); },
        draw: function () {
        $(this.i).val(this.cv + '%');},
        'readOnly':true
      });
    });
  </script>
  
  <style>
      .in{
          background: #00baf0;
      }
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
    color: 	#4E5258 ;
   
    
     
  }
}

.verde{
    background-color:#31C6C7;
}
.grist{
     background-color:#4E5258;
}
.naranja{
     background-color:#FDC134;
}
.just{
    ALIGN="justify";
}
      
                
      
  </style>
    
  </head>
  <body class="bg-white">
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrappr animated slideInLeft">
       <div class=" logo-principal sidenav-header-inner" style="">
           <a href="general.php"><img src="../../../img/logoweb.png" class="img-fluid" alt=""></a>
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
            <li><a href="../general/normateca-books.php" aria-expanded="false" > <i class="fas fa-book"></i>Material de Lectura</a>
            
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
                        <div style="font-size: 20px;font-family:lato">&nbsp; > &nbsp;</div>
                        <li>
                            <a style="font-size: 20px;font-family:lato" href="../index.php">
                                Identificación
                            </a>
                        </li>
                        <div style="font-size: 20px;font-family:lato">&nbsp; > &nbsp;</div>
                        <li class="active">
                            <a style="font-size: 20px;font-family:lato">
                                <u>Estilos Aprendizaje</u>
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
      <!-- Inicia Contenido -->
      <body class="bg-white">
  <section class=" bg-white">
     <div class="row container col-md-12 text-center">
         
     </div>
      <div class="col-md-12  container">
      
     <h2 class="mt-4 text-center" style="font-family: 'lato';font-size: 32px;font-weight: 300;text-align: center;color: #6070E4;margin-top: 20px;">Estilos de Aprendizaje</h2>
      <div class="row">
     <div class=" col-md-4 mt-5">
       
        <p class="gris"><strong>Visual</strong></p>

        <input type="text" value="<?php  echo $RV;?>" class="dial queri" data-width="150"  data-skin="tron" data-thickness=".3"  data-angleOffset="90">
         <!-- <input type="text" value="55" class="dial" data-width="200" data-thickness=".32" data-fgColor="#008BE8" data-bgColor="#EEEEEE" data-cursor=false data-displayInput="true" data-readOnly=true > -->
  </div>
   <div class=" col-md-4 mt-5">
        <p class="gris"><strong>Auditivo</strong></p>
       <input type="text" value="<?php  echo $RA;?>" class="dial2 queri" data-width="150"  data-skin="tron" data-thickness=".3"  data- angleOffset="90">
        <!-- <input type="text" value="55" class="dial" data-width="200" data-thickness=".32" data-fgColor="#008BE8" data-bgColor="#EEEEEE" data-cursor=false data-displayInput="true" data-readOnly=true > -->
   </div>
   
  <div class=" col-md-4 mt-5">
           <p class="gris"><strong>Kinestésico</strong></p>
       <input type="text" value="<?php  echo $RK;?>" class="dial3 queri" data-width="150"  data-skin="tron" data-thickness=".3"  data-angleOffset="90" >
         <!-- <input type="text" value="55" class="dial" data-width="200" data-thickness=".32" data-fgColor="#008BE8" data-bgColor="#EEEEEE" data-cursor=false data-displayInput="true" data-readOnly=true > -->
  </div>
              
    </div>
   </div>



     <div class="col-md-12  container-fluid tabla mt-5 bg-white">
         <table class="table table-bordered ">
  <thead>
   
  </thead>
  <tbody>
    <tr class="grist">
      <th scope="row " class="text-center text-white">Visual</th>
      <td class="text-center text-white">Puntaje (1 a 5) de un total de 35 puntos
      <br>
     Éste tiende a ser el sistema de representación dominante en la mayoría de las personas. Ocurre cuando uno tiende a pensar en imágenes y a relacionarlas con ideas y conceptos.Este sistema está directamente relacionado con nuestra capacidad de abstracción y planificación 
      </td>
     <td class="text-center text-white">Total Visual: <?php
           echo $visual;
         ?></td>
     
    </tr>
    <tr class="verde">
      <th scope="row " class="text-center text-white">Auditivo</th>
       <td class="text-center text-white just">Puntaje (1 a 5) de un total de 35 puntos
       <br class"just">
       Personas que son más auditivas tienden a recordar mejor la información siguiendo y rememorando una explicación
       oral. Fundamental para el aprendizaje de cosas como la música y los idiomas.
       </td>
     <td class="text-center text-white">Total Auditivo: <?php
           echo $auditivo;
         ?></td>
     
    </tr>
    <tr class="naranja">
      <th scope="row" class="text-center text-white">Kinestésico</th>
      <td class="text-center text-white">Puntaje (1 a 5) de un total de 35 puntos
      <br>
      Aprendizaje relacionado a nuestras sensaciones y movimientos(Practica). En otras palabras, es lo que ocurre cuando aprendemos más fácilmente al movernos y tocar las cosas.
      </td>
      <td class="text-center text-white">Total Kinestésico: <?php
           echo $kinestesico;
         ?></td>
     
    </tr>
  </tbody>
</table>
         
     </div>
    </section>
     <br>
     <br>
              
   
      <!--Finaliza Contenido -->
      
      
       
      
      <footer class="main-footer  mt-3 col-md-12">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
               <p class="text">&copy; OceanMind 2019</p>

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
    
    <!-- modal -->
    <div class="modal fade" tabindex="-1" id="mostrarmodal" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">¡Avatar-1 desbloqueado!</h5>
          </div>
          <div class="modal-body" align="center">
            <img src="../../../img/avatares/avatar-identificacion.png" >
            
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3"></script>
            
            <br>
            
            <p>Comparte tu logro en facebook</p>

            <div class="fb-share-button" data-href="http://oceanmind.com.mx/compartir/avatar-identificacion.php" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a>
            </div>
            
          </div>
          
          <form action="consultas/update-modal-estilosaprendizaje2.php" method="POST">
              <input type="text" name="actualizar_notificacion" id="actualizar_notificacion" value="1" hidden="">
              <input type="text" name="TutoradoN" id="TutoradoN" value="<?php echo $TutoradoN ?>" hidden=""> 
              <div class="modal-footer">
                <input type="submit" class=" rounded btn btn-danger" value="Cerrar">
              </div>
              
              
              
          </form>
          
        </div>
      </div>
    </div>
    
    </body>
    <!-- JavaScript files-->
    
    <?php
    
        if(0 == $edo_notificacion)
            {
                echo'<script>
                $(document).ready(function()
                  {
                    $("#mostrarmodal").modal("show");
                  });
                </script>';        
            }else
            {

            }

    ?>
    
    
    
   
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