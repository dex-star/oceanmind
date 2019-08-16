
<?php
	$mysqli = new mysqli('oceanmind.com.mx', 'oceanminduser', 'oceanmindteam', 'oceanmind');
	if($mysqli->connect_errno):
		echo "Error al conectarse con MySQL debido al error" .$mysqli->connect_error;
endif;
?>