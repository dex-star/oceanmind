
<?php
	$mysqli = new mysqli('oceanmind.com.mx', 'oceanclient', '12345', 'ocean');
	if($mysqli->connect_errno):
		echo "Error al conectarse con MySQL debido al error" .$mysqli->connect_error;
endif;
?>