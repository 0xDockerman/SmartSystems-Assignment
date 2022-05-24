<?php
session_start();
// UPDATE login
// SET status='3'
// WHERE username= "p17kont1";
// $sql = "UPDATE login SET status='Declined' WHERE username= 'p17kont1';";

// if ($conn->query($sql) === TRUE) {
//   echo "Record updated successfully";
// } else {
//   echo "Error updating record: " . $conn->error;
// }

?><?php include 'header.php';

?>


<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<style>
body {
  background-color: #f4f7fF;
}
</style>
	<title></title>
</head><body>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iot";
$i = $_SESSION["username"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE login SET status='Pending' WHERE username= '$i'";

if ($conn->query($sql) === TRUE) {
  echo "OK";
} else {
  echo "Error updating record: " . $conn->error;
}





$target_dir = "uploads/";
$target_file = $target_dir . basename($_SESSION["username"].".jpg");
$uploadOk = 1;



// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    #echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  // echo '<span class="badge badge-success"> To pistopitiko ananeothike</span>
  // </br>';
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo $_SESSION["username"];
    echo '<div class="alert alert-success" role="alert">Τα πιστοποιητικα σας εχουν καταχωρηθει επιτυχως '. htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])).'</div>';
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>


</body>
</html>
