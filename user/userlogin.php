<?php
//this file contains the login page for the user after the registration is done, we can come here either by nav menu option or after the 
//reg is done
//this will contain a form with username or email with password and a login button 
//if login is unsuccessful then we land back on this page again with details already filled in with a flash message about login failed
//if login is successful then we enter the user's home page where we see their details
session_start();

require_once('../general/nav.php');

if(isset($_SESSION['flashmessage'])){
  echo $_SESSION['flashmessage'] . "</br>";
  unset($_SESSION['flashmessage']);
}
//print_r($_POST);
if(isset($_POST['username']) && isset($_POST['userpass']) && isset($_POST['userlogin'])){
  // echo " hello there " . $_POST['username'];

  require_once('../general/pdo.php');

  $username = $_POST['username'];
  $userpass = $_POST['userpass'];
  $sqlcheck = "SELECT * FROM `phpcrudappdb`.`usertable` WHERE `username`=? AND `userpassword`=?;";
  $dataset = [$username,$userpass];

  $res = $conn->prepare($sqlcheck);
  $res->execute($dataset);

  $rowcount = $res->rowCount();
  
  if($rowcount ==1){
    $otp = rand(1111,9999);
    // echo "</br>" . $otp;
    
    $_SESSION['otp'] = $otp;
    $_SESSION['user'] = 'user';

    $_SESSION['username'] = $username;
    $_SESSION['userpass'] = $userpass;
    // echo " </br>" . $_SESSION['user'];
    header('Location: ../general/otp.php');
  }
  else{
    $message = "check your username and password";
    $_SESSION['flashmessage'] = $message;
    header('Location: ../user/userlogin.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>user login</title>
</head>
<body>
  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="text" name="username" id="username" placeholder="enter username">
    <input type="password" name="userpass" id="userpass" placeholder="enter password">
    <input type="submit" name="userlogin" value="submit">
  </form>
</body>
</html>