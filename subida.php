<?php
session_start();
$target_dir = "";
$target_file = $target_dir . basename($_FILES["ficheritoSubida"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["ficheroSubida"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
else
{
    echo "Error de subida";
}


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}



// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["ficheroSubida"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["ficheritoSubida"]["name"])). " has been uploaded.";
    $_SESSION["rutaImagen"] = $target_file;
    header("Location: visualizacion.php"); //Redirección automática a la página de visualización
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>