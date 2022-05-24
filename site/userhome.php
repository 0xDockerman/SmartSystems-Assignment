<?php
session_start();


if(!isset($_SESSION["username"]))
{
	header("location:login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<title></title>
  <style>
body {
  background-color: #f4f7fF;
}
</style>
</head>
<body>





<?php include 'header.php';?>
<center>
<br><br><br>

<div style="background-color: #fff; width: 1000px;  padding: 50px 50px 50px 50px ;border-radius: 20px">
		<br>

    <div class="jumbotron">
  <h1 class="display-4">Ανέβασμα Δικαιολογητικών</h1>
  <hr class="my-4">
  <?php 

  $host="localhost";
  $user="root";
  $password="";
  $db="iot";
  $username = $_SESSION["username"];

  $data=mysqli_connect($host,$user,$password,$db);
  $sql = 'SELECT Name FROM login WHERE username="'. $username.'";';
  $result=mysqli_query($data,$sql);
  $name =  mysqli_fetch_array($result);
  $name = $name['0'];
  $sql = 'SELECT Status FROM login WHERE username="'. $username.'";';
  $result=mysqli_query($data,$sql);
  $Status =  mysqli_fetch_array($result);
  $Status = $Status['0'];

  echo '<p class="lead">Καλωσήλθες ' .  $name  . '</br></p>';
  echo '<p class="lead">Η κατασταση σου ειναι: ' .  $Status  . '</br></p>';
  #echo $username;
  ?>
  <hr class="my-4">
  <p>Για οποιαδήποτε απορία μπορείτε να διαβάσετε πρώτα τις συχνές ερωτήσεις.</p>
  <p class="lead">
    <a class="btn btn-dark" href="#" role="button">Συχνές Ερωτήσεις</a>
  </p>
</div>



  <form action="upload.php" method="post" enctype="multipart/form-data">
  
</br> Επιλεξτε το αρχειο:
  <input type="file" name="fileToUpload" id="fileToUpload" required>
  <button type="submit" value="Upload Image" class="btn btn-success">Υποβολή δικαιολογητικών</button>

  
  </form>

  </br> 
<!-- <a href="logout.php">Logout</a> -->
</center>

</body>
</html>
