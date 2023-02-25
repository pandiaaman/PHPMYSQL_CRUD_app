<?php
$servername = "localhost";
$username = "adminuser";
$dbname = "phpcrudappdb";
$portno = "3306";
$password = "adminpassword";

try{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$portno",$username,$password);

  if(!$conn){
    die("connection failed: " . $conn->connect_error());
    echo "</br>" . "not Connected to DB";
  }
  else{
    echo "</br>" . "Connected to DB successfully";
    //<script> console.log("connected to DB successfully");</script>
  }

  //error modes in PDO : for better understanding of the errors and exceptions that might occur
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
  echo "connection failed" . "</br>";
  echo "error in connecting to DB : " . $e->getMessage();
}


?>