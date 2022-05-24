<?php
$var = @$_POST['username'] ;
$sql = "UPDATE login SET Status='Aprroved' WHERE username=$var;";
$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
//added for testing
echo 'var = '.$var;


// USE iot;
// UPDATE login SET Status='Aprroved' WHERE username="p17kont1";

?>

