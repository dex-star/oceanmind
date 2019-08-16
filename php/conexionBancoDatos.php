
<?php
	$mysqli = new mysqli('localhost', 'u463454571_banco', 'oceanmind', 'u463454571_banco');
	if($mysqli->connect_errno):
		echo "Error al conectarse con MySQL debido al error" .$mysqli->connect_error;
	else:
	    echo "Conexion exitosa";
endif;
?>