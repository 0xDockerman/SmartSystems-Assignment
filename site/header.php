<?php
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  
if(	$curPageName == "login.php"){

  echo '<ul class=" navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="login.php">
  <img src=""   class="d-inline-block align-top" alt="">
  IonianPass
  </a>
   
    <li class="nav-item">
   <h5> Ακαδημαϊκό έτος 2021-2022<h5>


    </li>
  </ul>';

}else{

  echo '<ul class=" navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="login.php">
  <img src=""   class="d-inline-block align-top" alt="">
  IonianPass
  </a>
   
  <li class="nav-item">
  <h5><a class="exit" href="logout.php">Εξοδος</a></h5>
</li>
  </ul>';

}


?>