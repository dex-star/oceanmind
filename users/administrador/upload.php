<?php
  session_start();

    if(isset($_SESSION['usuario'])){
       /*if($_SESSION['usuario']['UsuarioTipo'] == 2 ){
            header('Location: ../coordinador/');
        }else if($_SESSION['usuario']['UsuarioTipo'] == 3 ){
            header('Location: ../tutor/');
        }else if($_SESSION['usuario']['UsuarioTipo'] == 1 ){
            header('Location: ../administrador/');
        }*/
    }else{
            /*header('location: ../../../');*/
        }  

        $sesionActual = $_SESSION['usuario']['IDUsuario'];
        require_once("../../php/conexion.php"); //enlazar el archivo de conexion
        $ConsultaAdmin = mysqli_query($mysqli,"SELECT * FROM administrador WHERE IDUsuario = '$sesionActual' ");
        $data=mysqli_fetch_assoc($ConsultaAdmin);
        $admin = $data['IDAdmin'];        
        
        
?>
<?php
//echo count($_FILES["file0"]["name"]);exit;
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES["fileToUpload"]["type"])){
$target_dir = "../upload/";
$carpeta=$target_dir;
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}

$target_file = $carpeta . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $errors[]= "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $errors[]= "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $errors[]="Lo sentimos, archivo ya existe.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 524288) {
    $errors[]= "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 0.5 MB";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType == "jpg" && $imageFileType == "png" && $imageFileType == "jpeg"
&& $imageFileType != "gif" ) {
    $errors[]= "Lo sentimos, sólo archivos JPG, JPEG, PNG & GIF  son permitidos.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $errors[]= "Lo sentimos, tu archivo no fue subido.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       $messages[]= "Complete los campos .";
    
       echo "<br>";        
       echo "
       
       <form role='form' id='form' action='consultas/insertar-material.php' method='post' id='pgar'>
            <div class='form-controlGroup'>
				<input class='form-input' name='Link' hidden='' type='text' onclick='on' id='link' value='$target_file' required readonly/>
			</div>
            <div class='form-controlGroup'>
				<input class='form-input' name='IDAdmin' hidden='' type='text' onclick='on' id='correo' value='1' required readonly/>
			</div>
                
            <div class='form-controlGroup'>
				<input class='form-input' name='NombreArchivo' type='text' id='nombre' required/>
				<label class='form-label' for='nombre'>Nombre</label>
				<i class='form-inputBar'></i>
			</div>
            
            <div class='form-controlGroup'>
				<input class='form-input' name='Descripcion' type='text' id='descripcion' required/>
				<label class='form-label' for='descripcion'>Descripicion de archivo</label>
				<i class='form-inputBar'></i>
			</div>
                
            <div class='form-controlGroup'>
                <input class='form-input' name='Tipo' type='text' id='link' required/>
				<label class='form-label' for='link'>Link</label>
				<i class='form-inputBar'></i>
			</div>
                
                 <input type='submit' name='pgar' value='Registrar' class='btn btn-success'>
                 
                 
            </form>";   
	   
    } else {
       $errors[]= "Lo sentimos, hubo un error subiendo el archivo.";
        
    }
}

if (isset($errors)){
	?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Error!</strong> 
	  <?php
	  foreach ($errors as $error){
		  echo"<p>$error</p>";
	  }
	  ?>
	</div>
	<?php
}

if (isset($messages)){
	?>
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Aviso!</strong> 
	  <?php
	  foreach ($messages as $message){
		  echo"<p>$message</p>";
	  }
	  ?>
	</div>
	<?php
}
}



?>