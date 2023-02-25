<?php
//this gives the user option to update the row selected
session_start();

require_once('./general/nav.php');
require_once('./general/pdo.php');
$incominguserid = $_GET['userid'];

if(isset($_POST['updaterow']) && isset($_POST['userfirstname']) && isset($_POST['userlastname']) && isset($_POST['username']) && isset($_POST['useremail']) && isset($_POST['usergender']) && isset($_POST['userage']) && isset($_POST['userpassword'])){
  $sqlupdatequery = "UPDATE `phpcrudappdb`.`usertable` SET `userfirstname`=?,`userlastname`=?,`username`=?,`useremail`=?,`usergender`=?,`userage`=?,`userpassword`=?,`userregistereddate`=? WHERE userid=?;";
  $dataset=[$_POST['userfirstname'],$_POST['userlastname'],$_POST['username'],$_POST['useremail'],$_POST['usergender'],$_POST['userage'],$_POST['userpassword'],$_POST['userregistereddate'],$incominguserid];
  $res = $conn->prepare($sqlupdatequery);
  $res->execute($dataset);

  header('Location: ./admin/adminindex.php');
}

$sqlgetdata = "SELECT * FROM `phpcrudappdb`.`usertable` WHERE `userid`=?;";
$dataset = [$incominguserid];
$res = $conn->prepare($sqlgetdata);
$res->execute($dataset);

if($res->rowCount() == 1){
  $row = $res->fetch(PDO::FETCH_ASSOC);

  $userfirstname=$row['userfirstname'];
  $userlastname=$row['userlastname'];
  $username=$row['username'];
  $useremail=$row['useremail'];
  $usergender=$row['usergender'];
  $userage=$row['userage'];
  $userpassword=$row['userpassword'];
  $userregistereddate=$row['userregistereddate']; 
}
else{
  $message = "no data for selected row id";
  header('Location: ./user/userindex.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>update row</title>
</head>
<body>
  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    
    <label>userfirstname</label><input type="text" name="userfirstname" id="" value="<?= $userfirstname ?>"></br>
    <label>userlastname</label><input type="text" name="userlastname" id="" value="<?= $userlastname ?>"></br>
    <label>username</label><input type="text" name="username" id="" value="<?= $username ?>"></br>
    <label>useremail</label><input type="text" name="useremail" id="" value="<?= $useremail ?>"></br>
    <label>usergender</label><input type="text" name="usergender" id="" value="<?= $usergender ?>"></br>
    <label>userage</label><input type="text" name="userage" id="" value="<?= $userage ?>"></br>
    <label>userpassword</label><input type="text" name="userpassword" id="" value="<?= $userpassword ?>"></br>
    <label>userregistereddate</label><input type="text" name="userregistereddate" id="" value="<?= $userregistereddate ?>"></br>
    <input type="submit" value="updaterow" name="updaterow">
  </form>
</body>
</html>