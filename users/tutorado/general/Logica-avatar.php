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

        //CONSULTA IDLOGICA
        $ConsultaLogica = mysqli_query($mysqli,"SELECT IDTutorado, IDTestLogica FROM `test-logica` WHERE IDTutorado = '$tutorado'");
        $data2=mysqli_fetch_assoc($ConsultaLogica);
        $logica = $data2['IDTestLogica'];
        
        //CONSULTA NOTIFICACIÓN
        $ConsultaNotificacion = mysqli_query($mysqli,"SELECT * FROM `Notificaciones` WHERE IDTutorado = '$tutorado' AND Descripcion = 'Avatar-3 desbloqueado' ");
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
$data1=mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTestLogica = $logica");
?>

   <?php
$por = "%";
$data1=mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTestLogica = $logica");
        while($info=mysqli_fetch_array($data1))
        $porcentaje1 = $info['ResultadoInterpretacionInformacion']/10 * 100;
       
    ?>
 
 <?php

$data2=mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTestLogica = $logica");
        while($info=mysqli_fetch_array($data2))
        $porcentaje2 = $info['ResultadoInterpretacionRelacionesLogicas']/10 * 100;
       
    ?>
 <?php

$data3=mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTestLogica = $logica");
        while($info=mysqli_fetch_array($data3))
        $porcentaje3 = $info['ResultadoInterpretacionReconocimientoPatrones']/10 * 100;
       
    ?>
    
     <?php

$data4=mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTestLogica = $logica");
        while($info=mysqli_fetch_array($data4))
        $porcentaje4 = $info['ResultadoRepresentacionEspacial']/10 * 100;
       
    ?>

<script>
   
  var var1=[<?php
       $sql1=mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTestLogica = $logica");
                while($info=mysqli_fetch_array($sql1))
        $var1 = $info['ResultadoInterpretacionInformacion']/40 * 100;
      echo round ($var1);
                ?>];
   
  var var2=[<?php
       $sql2=mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTestLogica = $logica");
                while($info=mysqli_fetch_array($sql2))
        $var2 = $info['ResultadoInterpretacionRelacionesLogicas']/40 * 100;
                    echo round ($var2);
               
                ?>];
   
  var var3=[<?php
       $sql3=mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTestLogica = $logica");
                while($info=mysqli_fetch_array($sql3))
         $var3 = $info['ResultadoInterpretacionReconocimientoPatrones']/40 * 100;
                    echo round ($var3);
                    
                ?>];
    
    
  var var4=[<?php
       $sql4=mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTestLogica = $logica");
                while($info=mysqli_fetch_array($sql4))
         $var4 = $info['ResultadoRepresentacionEspacial']/40 * 100;
                    echo round ($var4);
                   
                ?>];
    
    var general=[<?php
       $sql4=mysqli_query($mysqli,"SELECT * FROM `test-logica` WHERE IDTestLogica = $logica");
                while($info=mysqli_fetch_array($sql4))
         $general = $info['ResultadoTestLogica']/40 * 100;
                    echo round ($general);
                   
                ?>];
 var por = "%";
      
    

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
    
     <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
  <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
  </script>
  <style>
    @import 'https://fonts.googleapis.com/css?family=Montserrat';
    @import 'https://fonts.googleapis.com/css?family=Lato:400';
    #myChart a {
      display: none;
    }
    
    .zc-ref {
      display: none;
    }
      .circular{
          justify-content: center;
          margin-top: -10px;
          padding-top: 0px;
        
      }
      .pro{
          margin-top: 80px;
      }
      
  </style>

    
  </head>
  <body >
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
            <li><a href="../habilidades-pensamiento/index.php" aria-expanded="false"> <i class="far fa-lightbulb fa-2x"></i>Pensamiento </a>
            
            </li>
            <li><a href="../fortalecimiento/index.php" aria-expanded="false" > <i class="fas fa-dumbbell"></i>Fortalecimiento </a>
            
            </li>
            <li><a href="../general/normateca-books.php" aria-expanded="false"> <i class="fas fa-book"></i>Material de Lectura </a>
            
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
              <div class="navbar-header "><a id="toggle-btn" href="#" class="menu-btn"><i class="fas fa-bars " style="line-height: inherit";> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"></div></a></div>
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
  
     
    <section class="row col-md-12 bg-white">
   
  <div class="col-md-6 mb-5 mt-3">
   <h1 class="text-center mt-3">Resultado test lógica</h1>
  <div class=" container-fluid mt-5">
  <h6 class="text-center">Interpretación de información</h6>
  <div class="progress">
  <div class="progress-bar bg-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round ($porcentaje1).$por;?>"><?php echo round ($porcentaje1).$por;?></div>
</div>
   </div>
   <div class="container-fluid mt-5">
   <h6 class="text-center">Interpretación de relaciones lógicas</h6>
  <div class="progress">
  <div class="progress-bar  bg-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round ($porcentaje2).$por;?>"><?php echo round ($porcentaje2).$por;?></div>
</div>
   </div>
   <div class="container-fluid mt-5">
   <h6 class="text-center">Reconocimiento de patrones</h6>
  <div class="progress">
  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round ($porcentaje3).$por;?>"><?php echo round ($porcentaje3).$por;?></div>
</div>
   </div>
    <div class="container-fluid mt-5">
    <h6 class="text-center">Representación espacial</h6>
  <div class="progress">
  <div class="progress-bar  bg-danger" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round ($porcentaje4).$por;?>"><?php echo round ($porcentaje4).$por;?></div>
</div>
   </div>
   </div>
   
   <div class="col-md-6 mt-0 " >
    
    
    <div class="" id='myChart'>

  <script class="circular">
    var myConfig = {
      backgroundColor: '#FFF',
       
      type: "ring",
        labels : [
          {
            text : '<span>General</span><br>'+general+por,
            x : "50%",
            y : "56%",
            anchor : "c",
            fontSize : "18px",
            fontColor : "#1E5D9E",
            alpha : 0.7
          }],
      title: {
        text: "Resultado general test lógica",
        fontFamily: 'Roboto',
        fontSize: 23,
        // border: "1px solid black",
        padding: "25",
        fontColor: "#1E5D9E",
      },
      /*subtitle: {
      
        fontFamily: 'Lato',
        fontSize: 12,
        fontColor: "#777",
        padding: "5"
      },*/
      plot: {
        slice: '50%',
        borderWidth: 0,
        backgroundColor: '#FBFCFE',
        animation: {
          effect: 2,
          sequence: 3
        },
        valueBox: [{
          type: 'all',
          text: '%t',
          placement: 'out'
        }, {
          type: 'all',
          text: '%npv%',
          placement: 'in'
        },
         
                   
        ]
      },
      
      plotarea: {
        backgroundColor: 'transparent',
        borderWidth: 0,
        borderRadius: "0 0 0 10",
        margin: "70 0 10 0"
      },
      
      scaleR: {
        refAngle: 270
      },
      series: [{
        text: "Información",
        values: var1,
        lineColor: "#00BAF2",
        backgroundColor: "#5bc0de",
        lineWidth: 1,
        marker: {
          backgroundColor: '#5bc0de'
        }
      }, 
               {
        text: "Logica",
        values: var2,
        lineColor: "#00BAF2",
        backgroundColor: "#5cb85c",
        lineWidth: 1,
        marker: {
          backgroundColor: '#5cb85c'
        }
      }, 
               {
        text: "Patrones",
        values: var3,
        lineColor: "#E80C60",
        backgroundColor: "#ffc107",
        lineWidth: 1,
        marker: {
          backgroundColor: '#ffc107'
        }
      }, {
        text: "Espacial",
        values: var4,
        lineColor: "#9B26AF",
        backgroundColor: "#d9534f",
        lineWidth: 1,
        marker: {
          backgroundColor: '#d9534f'
        }
      }]
    };

    zingchart.render({
      id: 'myChart',
      data: {
       
        graphset: [myConfig]
      },
      height: '499',
      width: '99%'
    });
  </script>
    </div>
   </div>
 
   </section>
     
              
   
      <!--Finaliza Contenido -->
      
      
       
      
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
    <script src="../../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../../js/slidernormateca.js"></script>
    
    
    <!-- Main File-->
    <script src="../../../js/front.js"></script>
    
    <!-- Main File-->
    <script src="../../../js/front.js"></script>
    
    <!-- modal -->
    
    <center>
    <div class="modal fade" tabindex="-1" id="mostrarmodal" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">¡Has desbloqueado un avatar!</h5>
          </div>
          <div class="modal-body">
            <img src="../../../img/avatares/avatar-logica.png" >
            
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3"></script>
            <br>
            <p>Comparte tu avatar en facebook</p>
     

            <div class="fb-share-button" data-href="http://oceanmind.com.mx/compartir/avatar-pensamiento.php" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a>
            </div>
            
          </div>
          
          <form action="consultas/update-modal-pensamiento-avatar.php" method="POST">
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