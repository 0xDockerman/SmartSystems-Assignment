
<?php include 'db.php';?>
<?php 
//   $host="localhost";
//   $user="root";
//   $password="";
//   $db="iot";
  
//   $data=mysqli_connect($host,$user,$password,$db);


  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "iot";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  
if(isset($_GET['accept'])){
    $id = $_GET['accept'];
    $conn->query("USE iot;") or die($conn->error());
    $conn->query("UPDATE login SET Status='Approved' WHERE username = '". $id . "' ;") or die($conn->error());
    header("Location: adminhome.php");
    echo "done";
}

if(isset($_GET['reject'])){
    $id = $_GET['reject'];
    $conn->query("USE iot;") or die($conn->error());
    $conn->query("UPDATE login SET Status='Declined' WHERE username = '". $id . "' ;") or die($conn->error());
    echo "done";
    header("Location: adminhome.php");
    die();
}



?>