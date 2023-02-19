<?php
//this page is the user addition page which contains the simple form for the admin to add the user in the db
//page contains the username, email, firstname, age, gender, password
//on submitting, it should check all the fields with the regex checker and then if all good, we land back to the adminhomepage
//if anything is wrong, we get a flash message with all the details intact

session_start();
require_once('./pdo.php');

if(isset($_POST["updaterow"]) && isset($_SESSION["adminname"])){
  $sqlinsert = "INSERT INTO `phpcrudappdb`.`usertable`(`userfirstname`,`userlastname`,`username`,`useremail`,`usergender`,`userage`,`userpassword`,`userregistereddate`) 
  VALUES(?,?,?,?,?,?,?,?)";
  $dataset = [$_POST['userfirstname'],$_POST['userlastname'],$_POST['username'],$_POST['useremail'],$_POST['usergender'],$_POST['userage'],$_POST['userpassword'],$_POST['userregistereddate']];
  $res = $conn->prepare($sqlinsert);
  $res->execute($dataset);
  if($res){
    header('Location: ./adminindex.php');
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
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    
    <label>userfirstname</label><input type="text" name="userfirstname" id="" value=""></br>
    <label>userlastname</label><input type="text" name="userlastname" id="" value=""></br>
    <label>username</label><input type="text" name="username" id="" value=""></br>
    <label>useremail</label><input type="text" name="useremail" id="" value=""></br>
    <label>usergender</label><input type="text" name="usergender" id="" value=""></br>
    <label>userage</label><input type="text" name="userage" id="" value=""></br>
    <label>userpassword</label><input type="text" name="userpassword" id="" value=""></br>
    <label>userregistereddate</label><input type="text" name="userregistereddate" id="" value=""></br>
    <input type="submit" value="updaterow" name="updaterow">
  </form>
</body>
</html>