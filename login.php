<?php
	/*
	require 'conexion.php';

	$credenciales = $mysqli->query("SELECT nicknameUsuario, tipoUsuario FROM usuarios WHERE nicknameUsuario = '".$_POST['usuariolg']."' AND passUsuario = '".$_POST['passlg']."'");

	if($credenciales->num_rows == 1):
	    $datos = $credenciales->fetch_assoc();
	    echo json_encode(array('error' => false, 'tipo' => $datos['tipoUsuario']));
	else:
	    echo json_encode(array('error' => true));
	endif;

	$mysqli->close();
	*/

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    require 'php/conexion.php';
    sleep(2);
    session_start();
    
    $mysqli->set_charset('utf8');
    
    $usuario = $mysqli->real_escape_string($_POST['email']);
    $pass = $mysqli->real_escape_string(md5($_POST['password']));
    
    if($consulta_nueva = $mysqli->prepare("SELECT * FROM usuarios WHERE Correo = ? AND  Password = ?")){
        
        $consulta_nueva->bind_param('ss', $usuario, $pass);
        
        $consulta_nueva->execute();
        
        $resultado = $consulta_nueva->get_result();
        
        if($resultado->num_rows == 1){
            $datos = $resultado->fetch_assoc();
            $_SESSION['usuario'] = $datos;
            echo json_encode(array('error' => false, 'tipo' => $datos['UsuarioTipo']));
        }else {
            echo json_encode(array('error' => true));
        }
        $consulta_nueva->close();
    }

}
$mysqli->close();
?>