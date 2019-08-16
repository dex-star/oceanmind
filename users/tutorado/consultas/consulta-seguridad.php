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

       
    try{
        require_once("../../../php/conexion.php"); //enlazar el archivo de conexion        
        }catch(Exception $e){
            $error = $e->getMessage(); //usar funcion de mysqli para capturar el error e imprimirlo
        }

//CONSULTA PARA OBTENER IDTUTORADO
        $sesionActual = $_SESSION['usuario']['IDUsuario'];
        $ConsultaTutorado= mysqli_query($mysqli,"SELECT * FROM usuarios WHERE IDUsuario = '$sesionActual' ");
        $data3=mysqli_fetch_assoc($ConsultaTutorado);
        $password = $data3['Password'];

if ( $password == MD5('12345') ) {
	header('Location: ../password.php');
} else {
  header('Location: insertar-resultados.php');
}

?>