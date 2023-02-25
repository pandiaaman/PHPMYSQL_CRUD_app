<?php
//this page is the user addition page which contains the simple form for the admin to add the user in the db
//page contains the username, email, firstname, age, gender, password
//on submitting, it should check all the fields with the regex checker and then if all good, we land back to the adminhomepage
//if anything is wrong, we get a flash message with all the details intact

session_start();
require_once('./general/pdo.php');


if(isset($_SESSION['flashmessage'])){
  echo $_SESSION['flashmessage'] . "</br>";

  unset($_SESSION['flashmessage']);
}
if(isset($_SESSION['tempuserfirstname'])){
  echo $_SESSION['tempuserfirstname'];
}
if(isset($_POST["addrow"]) && isset($_SESSION["adminname"]) && isset($_POST['userfirstname']) && isset($_POST['userlastname']) && isset($_POST['username']) && isset($_POST['useremail']) && isset($_POST['usergender']) && isset($_POST['userage']) && isset($_POST['userpassword']) ){


  $sqlifusernameexists = "SELECT * FROM `phpcrudappdb`.`usertable` WHERE `username`=? ;";
  $inputusername = [$_POST["username"]];
  $resultifexists = $conn->prepare($sqlifusernameexists);
  $resultifexists->execute($inputusername);

  if($resultifexists->rowCount() > 0){
      $flashmessage = "username already exists, please enter another username";
      $_SESSION['flashmessage'] = $flashmessage;
      
      $_SESSION['tempuserfirstname'] = $_POST['userfirstname'];
      $_SESSION['tempuserlastname'] = $_POST['userlastname'];
      $_SESSION['tempusername'] = $_POST['username'];
      $_SESSION['tempuseremail'] = $_POST['useremail'];
      $_SESSION['tempusergender'] = $_POST['usergender'];
      $_SESSION['tempuserage'] = $_POST['userage'];
      $_SESSION['tempuserpassword'] = $_POST['userpassword'];
      $_SESSION['tempuserregistereddate'] = $_POST['userregistereddate'];

      header('Location: ./admin/adminadduser.php');
  }
  else{
  $sqlinsert = "INSERT INTO `phpcrudappdb`.`usertable`(`userfirstname`,`userlastname`,`username`,`useremail`,`usergender`,`userage`,`userpassword`,`userregistereddate`) 
  VALUES(?,?,?,?,?,?,?,?)";
  $dataset = [$_POST['userfirstname'],$_POST['userlastname'],$_POST['username'],$_POST['useremail'],$_POST['usergender'],$_POST['userage'],$_POST['userpassword'],$_POST['userregistereddate']];
  $res = $conn->prepare($sqlinsert);
  $res->execute($dataset);
    if($res){
       if(isset($_SESSION['tempuserfirstname'])){
          unset($_SESSION['tempuserfirstname']);
          unset($_SESSION['tempuserlastname']);
          unset($_SESSION['tempusername']);
          unset($_SESSION['tempuseremail']); 
          unset($_SESSION['tempusergender']);
          unset($_SESSION['tempuserage']);
          unset($_SESSION['tempuserpassword']);
          unset($_SESSION['tempuserregistereddate']);
        }
      header('Location: ./admin/adminindex.php');
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin add user</title>
</head>
<body>
  <?php 
    if($_SESSION['user'] == 'admin'){
  ?>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

    <label>userfirstname</label><input type="text" name="userfirstname" id="" value="<?php if(isset($_SESSION['tempuserfirstname'])){echo($_SESSION['tempuserfirstname']);} ?>" required></br>
    <label>userlastname</label><input type="text" name="userlastname" id="" value="<?php if(isset($_SESSION['tempuserlastname'])){echo($_SESSION['tempuserlastname']);} ?>" required></br>
    <label>username</label><input type="text" name="username" id="" value="<?php if(isset($_SESSION['tempusername'])){echo($_SESSION['tempusername']);} ?>" required></br>
    <label>useremail</label><input type="text" name="useremail" id="" value="<?php if(isset($_SESSION['tempuseremail'])){echo($_SESSION['tempuseremail']);} ?>" required></br>
    <label>usergender</label><input type="text" name="usergender" id="" value="<?php if(isset($_SESSION['tempusergender'])){echo($_SESSION['tempusergender']);} ?>" required></br>
    <label>userage</label><input type="text" name="userage" id="" value="<?php if(isset($_SESSION['tempuserage'])){echo($_SESSION['tempuserage']);} ?>" required></br>
    <label>userpassword</label><input type="text" name="userpassword" id="" value="<?php if(isset($_SESSION['tempuserpassword'])){echo($_SESSION['tempuserpassword']);} ?>" required></br>
    <label>userregistereddate</label><input type="text" name="userregistereddate" id="" value="<?php if(isset($_SESSION['tempuserregistereddate'])){echo($_SESSION['tempuserregistereddate']);} ?>"></br>
    <input type="submit" value="add row" name="addrow">
  </form>
  <?php
    }
  ?>
</body>
</html>
