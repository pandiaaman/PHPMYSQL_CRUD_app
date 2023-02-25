<?php
//this is the registration page for the user
//this will contain a form with email address, DOB, gender, username, password
//when submitting, we must check that username and email should not be present already in the database
//if existing, then ask the user in a flash message to change the username, or tell them that they are already existing
//we will also use the regex to check the format of the username and email gender age and password
//you should have a calendar dropdown for the DOB option, once selected the age should automatically populate as the current age
//format checking
//username -> should contain only alphanumerics, no special chars, can not start with a number
//userfirstname
//userlastname
//userimage
//userdob
//userregistereddate
//email -> must contain @ and .com at the end
//gender -> this will be a radio button with options of M(male), F(female), Q(queer), O(other)
//password -> has to be atleast 8 chars and atmost 12 chars -> must contain a smallcase letter, an uppercase letter and a number and a special char
//generate a php alert confirming the age of the user
//once registration is successful, send an OTP that is randomly generated on the backend to the user's email and take them to the 
//OTP confirmation page
//if correctly confirmed then take the user  to the login page, if not then wait for three turns(do this by incrementing session var) and then land back to the registration page (destroy the session in case the otp session var is still goiong on)
//if there is any issue with the registration, provide with the correct flash message and ask the user to correct those details
//

session_start();

require_once('./general/nav.php');
if(isset($_SESSION['flashmessage'])){
  echo $_SESSION['flashmessage'];
  unset($_SESSION['flashmessage']);
}

// print_r ($_POST);
if(isset($_POST['userreg']) && isset($_POST['userfirstname']) && isset($_POST['userlastname']) && isset($_POST['useremail']) && isset($_POST['userpassword'])){
  require_once('./general/pdo.php');

 // $_POST['userage'] = 1;


  $userfirstname = $_POST['userfirstname'];
  $userlastname = $_POST['userlastname'];
  $username = $_POST['username'];
  $userage = $_POST['userage'];
  $userdob = $_POST['userdob'];
  $userimage = $_POST['userimage'];
  $userpassword = $_POST['userpassword'];
  $useremail = $_POST['useremail'];
  $usergender = $_POST['usergender'];


  $sqlcheckusername = "SELECT * FROM `phpcrudappdb`.`usertable` WHERE `username`=?;";
  $datainput = [$_POST['username']];
  $res = $conn->prepare($sqlcheckusername);
  $res->execute($datainput);

  echo $userdob . "<br>";//2023-02-09
  $date = date("Y-m-d");
  echo "Today is " . date("Y-m-d") . "<br>";
  $ageuser = abs($date - $userdob);

  if($ageuser<4){
    $message = "your age is less than 4";
    $_SESSION['flashmessage'] = $message;
    header('Location: ./user/userregister.php');
  }
  if($res->rowCount() == 0){
    $sqlinsert = "INSERT INTO `phpcrudappdb`.`usertable`(`userfirstname`,`userlastname`,`username`,`userage`,`useremail`,`usergender`,`userimage`,`userdob`) VALUES(?,?,?,?,?,?,?,?);";
    $inputdata = [$userfirstname,$userlastname,$username,$userage,$useremail,$usergender,$userimage,$userdob];
    $result = $conn->prepare($sqlinsert);
    $result->execute($inputdata);

    if($result){
      $_SESSION['username'] = $userfirstname;
      if(isset($_SESSION['tempuserfirstname'])){
        unset($_SESSION['tempflashmessage']);
        unset($_SESSION['tempuserfirstname']);
        unset($_SESSION['tempuserlastname']);
        unset($_SESSION['tempusername']);
        unset($_SESSION['tempuserage']);
        unset($_SESSION['tempuserdob']);
        unset($_SESSION['tempuserimage']);
        unset($_SESSION['tempuserpassword']);
        unset($_SESSION['tempuseremail']);
        unset($_SESSION['tempusergender']);
      }

      header('Location: ./user/userlogin.php');
    }
    else{
      $message = "issue with adding the row, contact the server administrator";
      $_SESSION['flashmessage'] = $message;
      header('Location: ./user/userregister.php');
    }
    
  }
  else{
    $message = "username already exists, please change your username... user's dob: " . $userdob . " today is: " . $date . " and user's age is: " . $ageuser;
    $_SESSION['flashmessage'] = $message;
    $_SESSION['tempuserfirstname'] = $_POST['userfirstname'];
    $_SESSION['tempuserlastname'] = $_POST['userlastname'];
    $_SESSION['tempusername'] = $_POST['username'];
    $_SESSION['tempuserage'] = $_POST['userage'];
    $_SESSION['tempuserdob'] = $_POST['userdob'];
    $_SESSION['tempuserimage'] = $_POST['userimage'];
    $_SESSION['tempuserpassword'] = $_POST['userpassword'];
    $_SESSION['tempuseremail'] = $_POST['useremail'];
    $_SESSION['tempusergender'] = $_POST['usergender'];
    header('Location: ./user/userregister.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User registration</title>
</head>
<body>
  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <label>username</label> <input type="text" name="username" id="username" value="<?php if(isset($_SESSION['tempusername'])){echo $_SESSION['tempusername'];}else{echo '';} ?>" required></br>
    <label>first name</label> <input type="text" name="userfirstname" id="userfirstname" value="<?php if(isset($_SESSION['tempuserfirstname'])){echo $_SESSION['tempuserfirstname'];}else{echo '';} ?>" required></br>
    <label>last name</label> <input type="text" name="userlastname" id="userlastname" value="<?php if(isset($_SESSION['tempuserlastname'])){echo $_SESSION['tempuserlastname'];}else{echo '';} ?>" required></br>
    <label>email</label> <input type="email" name="useremail" id="user" value="<?php if(isset($_SESSION['tempuser'])){echo $_SESSION['tempuser'];}else{echo '';} ?>" required></br>
    <label>date of birth</label> <input type="date" name="userdob" id="userdob" value="<?php if(isset($_SESSION['tempuserdob'])){echo $_SESSION['tempuserdob'];}else{echo '';} ?>" required></br>
    <label>gender</label> </br>
    Male<input type="radio" name="usergender" value="M">
    Female<input type="radio" name="usergender" value="F">
    Other<input type="radio" name="usergender" value="O"> </br>
    <label>upload image</label> <input type="file" name="userimage" id="user" accept="image/*"></br>
    <label>password</label> <input type="password" name="userpassword" id="userpassword" value="<?php if(isset($_SESSION['tempuserpassword'])){echo $_SESSION['tempuserpassword'];}else{echo '';} ?>" required></br>
    <input type="submit" name="userreg" value="Register">
  </form>
</body>
</html>

