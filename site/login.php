<?php

$host="localhost";
$user="root";
$password="";
$db="iot";

session_start();


$data=mysqli_connect($host,$user,$password,$db);



if($data===false)
{
	die("connection error");
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username=$_POST["username"];
	$password=$_POST["password"];


	$sql="select * from login where username='".$username."' AND password='".$password."' ";

	$result=mysqli_query($data,$sql);

	$row=mysqli_fetch_array($result);

	if($row["usertype"]=="student")
	{	

		$_SESSION["username"]=$username;

		header("location:userhome.php");
	}

	elseif($row["usertype"]=="admin")
	{

		$_SESSION["username"]=$username;
		
		header("location:adminhome.php");
	}

	else
	{
		echo "username or password incorrect";
	}

}




?>









<!DOCTYPE html>
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
</head>
<body>
<?php include 'header.php';

?>
<center>

	<br><br><br>
	<div style="background-color: #fff; width: 500px;  padding: 50px 50px 50px 50px ;border-radius: 20px">
		<br>


		<form action="#" method="POST">


		<img src="https://dmc.ionio.gr/wp-content/uploads/2014/10/cropped-ionio.png" class="img-fluid" alt="Logo image"  width="200" height="200">

		<br><br><h3>Σύνδεση στο παρουσιολόγιο</h3>
	<p>Για σύνδεση στο σύστημα συμπληρώστε την παρακάτω φόρμα. Χρησιμοποιείστε τα ιδρυματικά σας στοιχεία.</p>

	<div class="form-group">
    <label for="exampleInputEmail1">Όνομα χρήστη:</label>
    <input type="text" name="username" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">Το όνομα χρήστη σας (χωρίς το @ionio.gr).</small>
  	</div><br>
	<!-- <div>
		<label>Όνομα χρήστη:</label></br>
		<input type="text" name="username" required>
		
	</div> -->
	<div class="form-group">
    	<label for="exampleInputPassword1">Κωδικός πρόσβασης:</label>
  	  	<input type="password" name="password" required class="form-control" id="exampleInputPassword1" placeholder="Password">
		<small id="emailHelp" class="form-text text-muted">Αυτόν που χρησιμοποιείτε και στο Webmail.</small>

 	</div>
	 
	<!-- <div>
		<label>Κωδικός πρόσβασης:</label></br>
		<input type="password" name="password" required>
	</div> -->
	<br>

	<div>
		<!-- <input type="submit" class="btn btn-primary">Sumbit</button> -->
		<button type="submit" class="btn btn-primary">Ταυτοποιήση</button>

	</div>


	</form>


	<br><br>
 </div>



</center>
<!-- <p>Ανάπτυξη εφαρμογής: Αριστείδης Κοντίνης, Μιχαήλ Παναγιωτίδης, Παναγιώτης Πίπης<br>
Μια εργασία για το μάθημα: <a href="av-tech+attendance@ionio.gr">Έξυπνα Περιβάλλοντα και Εφαρμογές</a></p> -->
</div>
</body>
</html>
