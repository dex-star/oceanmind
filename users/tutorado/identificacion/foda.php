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
        $consultas1 = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $consultas2 = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $consultas3 = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $consultas4 = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
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
          <hr class="sidenav-heading  justify-content-center">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="../index.php"> <i class="far fa-user"></i>Identificación</a>
            </li>
            <li><a href="../desarrollo-humano/index.php" aria-expanded="false" > <i class="far fa-smile-wink"></i>Desarrollo Humano </a>
             
            </li>
            <li><a href="../habilidades-pensamiento/index.php" aria-expanded="false" > <i class="far fa-lightbulb fa-2x"></i>Pensamiento </a>
             
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
              <div class="navbar-header "><a id="toggle-btn" href="#" class="menu-btn"><i class="fas fa-bars "> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"></div></a></div>
                  
                  <!--Migas pan FODA-->
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
      
       <div class="row justify-content-center  col-sm-12 ml-1 mr-1">
           <div class="col-md-10 col-sm-12">
              <div class="">
                <div class=" d-flex justify-content-center ">
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
                <div class=" d-flex justify-content-center ">
                 
              <h4 class="animated bounce titulo-form-personal" >Tiempo de reflexión y autodescubrimiento</h4>
                   
                    </div>    
                </div>
         
                <button class="btn btn-inicio nextBtn float-right " type="button" >Continuar</button>
            </div>
        </div>
    </div>              
             
                
        <div class="container-fluid">
			<section class="fd">
      <div class="container ">
        <div class=" setup-content  animated slideInRight " id="step-2">
        <div class="">
       <div class="col-md-12">
        
       <?php

       $consultas5 = mysqli_query($mysqli,"SELECT * FROM tutorado WHERE IDUsuario = '$sesionActual' ");
        $data3=mysqli_fetch_assoc($consultas5);
        $tutorado = $data3['IDTutorado'];
        $tutorado2 = $data3['IDTutorado'];  
        
        $Consulta = mysqli_query($mysqli,"SELECT * FROM foda WHERE IDTutorado = '$tutorado' ");
        $data2=mysqli_fetch_assoc($Consulta);
        $fortaleza1 = $data2['Fortaleza1'];
        $fortaleza2 = $data2['Fortaleza2'];
        $fortaleza3 = $data2['Fortaleza3'];
        $fortaleza4 = $data2['Fortaleza4'];
        $oportunidades1 = $data2['Oportunidad1'];
        $oportunidades2 = $data2['Oportunidad2'];
        $oportunidades3 = $data2['Oportunidad3'];
        $oportunidades4 = $data2['Oportunidad4'];
        $debilidades1 = $data2['Debilidad1'];
        $debilidades2 = $data2['Debilidad2'];
        $debilidades3 = $data2['Debilidad3'];
        $debilidades4 = $data2['Debilidad4'];
        $amenaza1 = $data2['Amenaza1'];
        $amenaza2 = $data2['Amenaza2'];
        $amenaza3 = $data2['Amenaza3'];
        $amenaza4 = $data2['Amenaza4'];

        if(!empty($fortaleza1 != "" && $fortaleza1 != "" && $fortaleza1 != "" && $fortaleza1 != "")){

          echo '
                
                <script language="JavaScript">
                      location = "foda-iniciado.php"
                      </script>
          
                <div class="alert alert-success" id="mensaje">
                  <strong>Felicidades!</strong> has finalizado Fortaleza</a>.
                </div>';
                  if(!empty($oportunidades1 != "" && $oportunidades2 != "" && $oportunidades3 != "" && $oportunidades4 != "")){
                    echo '
                    
                    <script language="JavaScript">
                      location = "foda-iniciado.php"
                      </script>
                    
                    <div class="alert alert-success">
                      <strong>Felicidades!</strong> has finalizado Oportunidades</a>.
                    </div>';
                    
                  }
                    if(!empty($debilidades1 != "" && $debilidades2 != "" && $debilidades3 != "" && $debilidades4 != "")){

                      echo '
                      
                      <script language="JavaScript">
                      location = "foda-iniciado.php"
                      </script>
                      
                      <script language="JavaScript">
                      location = "foda-iniciado.php"
                      </script>
                      
                      <div class="alert alert-success">
                        <strong>Felicidades!</strong> has finalizado Debilidades</a>.
                      </div>';
                      
                    }
                      if(!empty($amenaza1 != "" && $amenaza2 != "" && $amenaza3 != "" && $amenaza4 != "")){

                      echo '
                      <script language="JavaScript">
                      location = "foda-iniciado.php"
                      </script>
                      
                      <div class="alert alert-success">
                        <strong>Felicidades!</strong> has finalizado Amenazas</a>.
                      </div>';
                      
                    }
        }else{
          echo '<div class="alert alert-success">
                  <strong>Vamos a iniciar!</strong> rellena los campos</a>.
                </div>';    
        }

        if(!empty($fortaleza1 != "" && $fortaleza1 != "" && $fortaleza1 != "" && $fortaleza1 != "")){
          echo '<div class="contenedor col-md-6 text-center" id="uno" >
      <a  class=" texto" data-toggle="modal" data-target="" style="visibility: ">
      <i class="fas fa-hands " ></i>
      <p class="texto">Fortalezas</p></a>
    </div>';
        }else{
          echo '<div class="contenedor col-md-6 text-center" id="uno" >
      <a  class=" texto" data-toggle="modal" data-target="#myModal" style="visibility: ">
      <i class="fas fa-hands " ></i>
      <p class="texto">Fortalezas</p></a>
    </div>';    
        }

        if(!empty($oportunidades1 != "" && $oportunidades2 != "" && $oportunidades3 != "" && $oportunidades4 != "")){
          echo '<div class="contenedor col-md-6 text-center" id="dos">
      <a  class="texto " data-toggle="modal" data-target="">
      <i class="fas fa-lightbulb " ></i>
      <p class="texto">Oportunidades</p></a>
    </div>';
        }else{
          echo '<div class="contenedor col-md-6 text-center" id="dos">
      <a  class="texto " data-toggle="modal" data-target="#myModal2">
      <i class="fas fa-lightbulb " ></i>
      <p class="texto">Oportunidades</p></a>
    </div>';    
        }

            

       ?>

            
                 
            
            </div>
        
                
            
        
        
       <div class="col-md-12">
     
      <?php 

      if(!empty($debilidades1 != "" && $debilidades2 != "" && $debilidades3 != "" && $debilidades4 != "")){
          echo '<div class="contenedor col-md-6 text-center" id="tres">
      <a class="texto" data-toggle="modal" data-target="">
      <i class="far fa-sad-cry " ></i>
      <p class="texto">Debilidades</p></a>
    </div>';
        }else{
          echo '<div class="contenedor col-md-6 text-center" id="tres">
      <a class="texto" data-toggle="modal" data-target="#myModal3">
      <i class="far fa-sad-cry " ></i>
      <p class="texto">Debilidades</p></a>
    </div>';    
        }

        if(!empty($amenaza1 != "" && $amenaza2 != "" && $amenaza3 != "" && $amenaza4 != "")){
          echo '<div class="contenedor col-md-6 text-center" id="cuatro">
      <a  class="texto" data-toggle="modal" data-target="">
      <i class="fas fa-exclamation-triangle " ></i>
      <p class="texto">Amenazas</p></a>
    </div>';
        }else{
          echo '<div class="contenedor col-md-6 text-center" id="cuatro">
      <a  class="texto" data-toggle="modal" data-target="#myModal4">
      <i class="fas fa-exclamation-triangle " ></i>
      <p class="texto">Amenazas</p></a>
    </div>';    
        }

        if (!empty($fortaleza1 != "" && $fortaleza1 != "" && $fortaleza1 != "" && $fortaleza1 != "" && $oportunidades1 != "" && $oportunidades2 != "" && $oportunidades3 != "" && $oportunidades4 != "" && $debilidades1 != "" && $debilidades2 != "" && $debilidades3 != "" && $debilidades4 != "" && $amenaza1 != "" && $amenaza2 != "" && $amenaza3 != "" && $amenaza4 != "")) {
            
            $Tecnicas="UPDATE `resultados-parciales` SET FODA='1' WHERE IDTutorado = $tutorado2";
            mysqli_query($mysqli,$Tecnicas) or die (mysqli_error($mysqli));

            echo'<script type="text/javascript">
            alert("Has finalizado tu FODA");
            window.location.href="../consultas/calcular-resultados-finales-foda.php";
            </script>';
          }  

      ?>
             
              
                 
            
            </div>
             <button class="btn btn-salir nextBtn float-right" required  type="submit">Finalizar</button>
             </div>
              
             </div>
             
             </div>
                
	<div class="col-lg-4">
                <?php
      
      ?> 
                <div class="card-body text-center">
                  <!-- Modal-->
                  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal animacion text-left" readonly="">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content modal1">
                        <div class="modal-header ">
                          <h5 id="exampleModalLabel" class=" titulo-modal text-center">Fortalezas</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close cerrar-modal"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          <p>Escribe tus fortalezas en los recuadros</p>
                          
                          <form method="post" action="consultas/insertar-fortaleza.php" >
				<?php while($datosconsultas1 = mysqli_fetch_array($consultas1)) { ?>
          <textarea name="IDTutorado1" hidden=""><?php echo $datosconsultas1['IDTutorado']; ?></textarea>
        <?php } ?> 
					<div class="form-group">
                        <div class="controls">
                         <input type="text" id="Fortaleza1" class="floatLabel" name="Fortaleza1" required>
                          <label for="Fortaleza1">Fortaleza 1</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Fortaleza2" class="floatLabel" name="Fortaleza2" required>
                          <label for="Fortaleza2">Fortaleza 2</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Fortaleza3" class="floatLabel" name="Fortaleza3" required>
                          <label for="Fortaleza3">Fortaleza 3</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Fortaleza4" class="floatLabel" name="Fortaleza4" required>
                          <label for="Fortaleza4">Fortaleza 4</label>
                        </div>
                        <input type="text" id="notificacion" class="floatLabel" name="notificacion" value="Trofeo-FODA desbloqueado" hidden="">
                        <input type="text" id="edo_notificacion" class="floatLabel" name="edo_notificacion" value="0" hidden="">
                    </div>
                        <div class="modal-footer d-flex justify-content-center">
                          
                          <button type="submit" class="btn btn-enviar">Enviar</button>
                        </div>
				
			</form>

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
                          <h5 id="exampleModalLabel" class="titulo-modal">Oportunidades</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close cerrar-modal"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          <p>Escribe tus Oportunidades en los recuadros</p>
                          <p class="text-danger"></p>
                          <form method="post" action="consultas/insertar-oportunidades.php">
				<?php while($datosconsultas2 = mysqli_fetch_array($consultas2)) { ?>
          <textarea name="IDTutorado2" hidden=""><?php echo $datosconsultas2['IDTutorado']; ?></textarea>
        <?php } ?>
					
				<div class="form-group">
                        <div class="controls">
                         <input type="text" id="Oportunidades1" class="floatLabel" name="Oportunidades1" required>
                          <label for="Oportunidades1">Oportunidad 1</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Oportunidades2" class="floatLabel" name="Oportunidades2" required>
                          <label for="Oportunidades2">Oportunidad 2</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Oportunidades3" class="floatLabel" name="Oportunidades3" required>
                          <label for="Oportunidades3">Oportunidad 3</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Oportunidades4" class="floatLabel" name="Oportunidades4" required>
                          <label for="Oportunidades4">Oportunidad 4</label>
                        </div>
                        <input type="text" id="notificacion" class="floatLabel" name="notificacion" value="Trofeo-FODA desbloqueado" hidden="">
                        <input type="text" id="edo_notificacion" class="floatLabel" name="edo_notificacion" value="0" hidden="">
                    </div>


                        <div class="modal-footer d-flex justify-content-center">
                         
                          <button type="submit" class="btn btn-enviar">Enviar</button>
                        </div>
				
			</form>

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
                          <h5 id="exampleModalLabel" class="titulo-modal">Debilidades</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close cerrar-modal"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          <p>Escribe tus Debilidades en los recuadros</p>
                          
                          <form method="post" action="consultas/insertar-debilidades.php">
				<?php while($datosconsultas3 = mysqli_fetch_array($consultas3)) { ?>
          <textarea name="IDTutorado3" hidden=""><?php echo $datosconsultas3['IDTutorado']; ?></textarea>
        <?php } ?>
			<div class="form-group">
                        <div class="controls">
                         <input type="text" id="Debilidades1" class="floatLabel" name="Debilidades1" required>
                          <label for="Debilidades1">Debilidad 1</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Debilidades2" class="floatLabel" name="Debilidades2" required>
                          <label for="Debilidades2">Debilidad 2</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Debilidades3" class="floatLabel" name="Debilidades3" required>
                          <label for="Debilidades3">Debilidad 3</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Debilidades4" class="floatLabel" name="Debilidades4" required>
                          <label for="Debilidades4">Debilidad 4</label>
                        </div>
                        <input type="text" id="notificacion" class="floatLabel" name="notificacion" value="Trofeo-FODA desbloqueado" hidden="">
                        <input type="text" id="edo_notificacion" class="floatLabel" name="edo_notificacion" value="0" hidden="">
                    </div>
                        <div class="modal-footer d-flex justify-content-center">
                         
                          <button type="submit" class="btn btn-enviar">Enviar</button>
                        </div>
			</form>

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
                          <h5 id="exampleModalLabel" class="titulo-modal">Amenazas</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close cerrar-modal"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                         <p>Escribe tus Amenazas en los recuadros</p>
                          
                          <form method="post" action="consultas/insertar-amenazas.php">
				<?php while($datosconsultas4 = mysqli_fetch_array($consultas4)) { ?>
          <textarea name="IDTutorado4" hidden=""><?php echo $datosconsultas4['IDTutorado']; ?></textarea>
        <?php } ?>
				<div class="form-group">
                        <div class="controls">
                         <input type="text" id="Amenazas1" class="floatLabel" name="Amenazas1" required>
                          <label for="Amenazas1">Amenaza 1</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Amenazas2" class="floatLabel" name="Amenazas2" required>
                           <label for="Amenazas2">Amenaza 2</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Amenazas3" class="floatLabel" name="Amenazas3" required>
                          <label for="Amenazas3">Amenaza 3</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                         <input type="text" id="Amenazas4" class="floatLabel" name="Amenazas4" required>
                          <label for="Amenazas4">Amenaza 4</label>
                        </div>
                        <input type="text" id="notificacion" class="floatLabel" name="notificacion" value="Trofeo-FODA desbloqueado" hidden="">
                        <input type="text" id="edo_notificacion" class="floatLabel" name="edo_notificacion" value="0" hidden="">
                    </div>

                        <div class="modal-footer d-flex justify-content-center">
                          
                          <button type="submit" class="btn btn-enviar">Finalizarr</button>
                        </div>				
			</form>

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
  </body>
</html>