
<?php
	$mysqli = new mysqli2('lighthousecode.com', 'u118588206_otco', 'xq75fnSiw6Xj', 'u118588206_mind');
	if($mysqli->connect_errno):
		echo "Error al conectarse con MySQL debido al error" .$mysqli->connect_error;
	else:
	    echo "Conexion exitosa";
endif;
?>