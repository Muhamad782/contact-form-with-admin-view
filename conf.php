<?php

  
  $servername = "localhost";
  $username = "username";
  $password = "password";
  $dbname = "contact form";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if($conn->$conn_error){
      echo "Error";
  }else{
      echo "";
  }

?>