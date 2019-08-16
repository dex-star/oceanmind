
<?php
	$mysqli = new mysqli('redgeek.online', 'u682599546_om', 'RcelJCUm6lHD', 'u682599546_bd');
	if($mysqli->connect_errno):
		echo "Error al conectarse con MySQL debido al error" .$mysqli->connect_error;
endif;
?>