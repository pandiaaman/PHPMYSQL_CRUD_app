<?php
//this page is only the otp confirmation page
//check how you can get the otp from the backend to here to confirm it with the user's input
//there should be a session var here that increments when user enters the otp
//if user enters incorrectly, we should land back to the samme page
//if the incorrect inputs reach 3 times, then land back the user to the registration page
//there will be a back button with which the user can go back to the registration page with all the details intact from last session

//now, here the admin will also be tested on login, so check if the session variable is having admin as the user or other users are coming in
session_start();
if(isset($_SESSION['user'])){
echo $_SESSION['user'];
echo $_SESSION['otp'];
echo "</br>";
}
//echo $_SESSION['adminemail'];

if(isset($_SESSION['flashmessage'])){
  echo "</br>" . $_SESSION['flashmessage'];
  unset($_SESSION['flashmessage']);
}

if(isset($_POST['getnewotp'])){
  generatenewotp();
  header('Location: ./general/otp.php');
}

if(isset($_POST['otpsubmit']) && isset($_POST['otpinput'])){
  
  if($_SESSION['otp'] == $_POST['otpinput']){
    echo "otp is correct";
    if($_SESSION['user'] == 'admin'){
      header('Location: ./admin/dminindex.php');
    }
    if($_SESSION['user'] == 'user'){
      header('Location: ./user/userindex.php');
    }
  }
  else{
    $incorrectotpmessage =  " otp is incorrect";
    $_SESSION['flashmessage'] = $incorrectotpmessage;
    generatenewotp();
    //mail this to the user instead of printing it in the beginning of the screen
    header('Location: ./general/otp.php');
  }

}

function generatenewotp(){
  $_SESSION['otp'] = rand(1111,9999);
}

if(isset($_SESSION['user'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OTP check</title>
</head>
<body>
  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="text" name="otpinput" placeholder="enter otp here">
    <input type="submit" name="otpsubmit" value="submit">
    <input type="submit" name="getnewotp" value="get new otp">
  </form>
</body>
</html>
<?php
}
?>