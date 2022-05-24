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
<head>
<link rel="stylesheet" type="text/css" href="styles.css"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<style>
body {
  background-color: #f4f7fF;
}
</style>
	<title></title>
</head>
<body>
<?php include 'header.php';
?>
<center>

<div style="background-color: #fff; width: 1000px;  padding: 50px 50px 50px 50px ;border-radius: 20px">

<div class="jumbotron">
  <h1 class="display-4">Dashboard Γραμματείας</h1>
  <hr class="my-4">
</div>

<!-- <?php 
  echo "<h3>Γεια " . $_SESSION["username"] . "</h3>";


?> -->
<div class="jumbotron">
  <h1 class="display-6">Κατάσταση Φοιτητών</h1>
  <hr class="my-6">
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


</br>


<?php include 'db.php';?>
<?php require_once 'process.php';
?>
<?php



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
    echo "done";
}

if(isset($_GET['reject'])){
    $id = $_GET['reject'];
    $conn->query("USE iot;") or die($conn->error());
    $conn->query("UPDATE login SET Status='Declined' WHERE username = '". $id . "' ;") or die($conn->error());
    echo "done";
}


$host="localhost";
$user="root";
$password="";
$db="iot";

$data=mysqli_connect($host,$user,$password,$db);
$sql = 'SELECT COUNT(Name) FROM login WHERE usertype="student" && Status="Approved";';
$result=mysqli_query($data,$sql);
$ApprovedStudent =  mysqli_fetch_array($result);
$ApprovedStudent = (int) $ApprovedStudent['0'];

$sql = 'SELECT COUNT(Name) FROM login WHERE usertype="student" && Status="Declined";';
$result=mysqli_query($data,$sql);
$DeclinedStudent =  mysqli_fetch_array($result);
$DeclinedStudent = (int) $DeclinedStudent['0'];
$sql = 'SELECT COUNT(Name) FROM login WHERE usertype="student" && Status="Pending";';
$result=mysqli_query($data,$sql);
$PendingStudent =  mysqli_fetch_array($result);
$PendingStudent = (int) $PendingStudent['0'];

echo '<canvas id="myChart" style="width:100%;max-width:500px"></canvas>
<script>
var xValues = ["Εγκρίθηκαν",  "Σε αναμονή" ,"Απορρίφθηκαν"];
var yValues = ['. $ApprovedStudent .', ' . $PendingStudent. ', '. $DeclinedStudent .'];
var barColors = [
  "green",
  "goldenrod",
  "#C44343",

];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      text: "Στατιστικά Φοιτητών"
    }
  }
});
</script></br>';
try {

  $sql = "SELECT username,Name,Status FROM login where usertype='student' ORDER BY Status;";
  $result = $conn->query($sql);
  if($result !== false) {
    $html_table = '<table  class="table table-striped " border="1" cellspacing="0" cellpadding="2">  <thead class="thead-dark">  
    <tr><th>Όνομα Φοιτητή</th><th>Username</th><th>Κατάσταση</th><th>Αλλαγή Κατάστασης</th></tr>';
    // Parse the result set, and adds each row and colums in HTML table
    foreach($result as $row) {
      $html_table .=  "
      <tr>
      <td><a href='/iot/site/uploads/" .$row['username']. ".jpg'". 'target="_blank"'. ">" .$row['Name']. "</a> </td>
      <td>" .$row['username']. "</td>
      <td class='". $row['Status'] . "'> ". $row['Status']. "</td>
      <td>
      <a href='process.php?accept={$row['username']}' class='btn btn-success'>Αποδοχή</a>
      <a href='process.php?reject={$row['username']}' class='btn btn-danger'>Απόρριψη</a>
      </td>
      </tr>
      ";
      // $html_table .= '<tr><td><a href='/iot/uploads/" .$row['username']. ".jpg". "'>" .$row['Name']. "</a></td><td>' .$row['username']. '</td><td>' .$row['Status']. '</td></tr>';
    }
  }

// USE iot;
// UPDATE login
// SET Status='Aprroved'
// WHERE username=$username;

  $conn = null;        // Disconnect

  $html_table .= '</table></br>';           // ends the HTML table

  echo $html_table;        // display the HTML table
//PAROYSIOLOGIO


echo '<div class="jumbotron">
<h1 class="display-6">Παρουσιολόγιο Φοιτητών</h1>
<hr class="my-6">
</div>';
$conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
$conn->exec("SET CHARACTER SET utf8");  
$sql = "SELECT Name,Time,Classroom 
FROM login,attendance
WHERE login.StudentNum=attendance.StudentNum;";
$result = $conn->query($sql);

// If the SQL query is succesfully performed ($result not false)
if($result !== false) {
  // Create the beginning of HTML table, and the first row with colums title
  $html_table = '<table  class="table table-striped " border="1" cellspacing="0" cellpadding="2"> 
  <tr>
  <th>Όνομα Φοιτητή</th>
  <th>Αίθουσα</th>
  <th>Ώρα Παρουσίας</th>
  </tr>';
  // Parse the result set, and adds each row and colums in HTML table
  foreach($result as $row) {
    $html_table .=  "
    <tr>
    <td>" .$row['Name']. "</td>
    <td>" .$row['Classroom']. "</td>
    <td>" .$row['Time']. "</td>
    </tr>
    ";
    // $html_table .= '<tr><td><a href='/iot/uploads/" .$row['username']. ".jpg". "'>" .$row['Name']. "</a></td><td>' .$row['username']. '</td><td>' .$row['Status']. '</td></tr>';
  }
}



$conn = null;        // Disconnect

$html_table .= '</table></br>';           // ends the HTML table

echo $html_table;  
}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>







<br><br>
</div>
</center>
</body>
</html>