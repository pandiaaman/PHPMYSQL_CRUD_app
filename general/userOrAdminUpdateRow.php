<?php
//this gives the user option to update the row selected
session_start();

if(isset($_SESSION['adminname'])){
 echo "hi admin " . $_SESSION['adminname'];
}
else if(isset($_SESSION['username'])){
  echo "hi " . $_SESSION['username'];
}
else{
  header('Location: ../general/logout.php');
}

if(isset($_SESSION['flashmessage'])){
  echo $_SESSION['flashmessage'];
  unset($_SESSION['flashmessage']);
}

require_once('../general/nav.php');
require_once('../general/pdo.php');
if(isset($_GET['username'])){
$_SESSION['tempusername'] = $_GET['username'];
}
$incomingusername = $_SESSION['tempusername'];
// echo $incomingusername;

$sqlgetdata = "SELECT * FROM `phpcrudappdb`.`usertable` WHERE `username`=?;";
$dataset = [$incomingusername];
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
  $userdob=$row['userdob'];
  $userpassword=$row['userpassword'];
  $userregistereddate=$row['userregistereddate']; 
}
else if($res->rowCount() == 0){
  $message = "no data for selected username" . $incomingusername . "asdf";
  $_SESSION['flashmessage'] = $message;
  if(isset($_SESSION['adminname'])){
    header('Location: ../admin/adminindex.php');
  }
  else if(isset($_SESSION['username'])){
    header('Location: ../user/userindex.php');
  }
}
    
if(isset($_POST['updaterow']) && isset($_POST['userfirstname']) && isset($_POST['userdob']) && isset($_POST['userlastname']) && isset($_POST['useremail']) && isset($_POST['userpassword'])){
   
  require('../general/validate.php'); //this is to validate the inputs entered by the user
    //we use associative array and pass that array to a different php class containing a function
    $date = date("Y-m-d");
    $userdob =  $_POST['userdob'];
    $userage1 = abs($date - $userdob);
    $inputcheckarray = array( "userfirstname"=>$_POST['userfirstname'],
                              "userlastname"=>$_POST['userlastname'],
                              // "username"=>$_POST['username'],
                              "userage"=>$userage1,
                              "userdob"=>$_POST['userdob'],
                              "userpassword"=>$_POST['userpassword'],
                              "useremail"=>$_POST['useremail']
                              );

    //print_r($inputcheckarray);
    validateinputs($inputcheckarray); 

    if($userage1<4){
      $message = "your age is less than 4";
      $_SESSION['flashmessage'] = $_SESSION['flashmessage'] . $message . "</br>";
      header('Location: ../general/userregisteradminadduser.php');
    }

    if(isset($_SESSION['flashmessage'])){
       header('Location: ../general/userOrAdminUpdateRow.php');
    }
    if($_SESSION['flashmessage'] == ""){ 
        $sqlupdatequery = "UPDATE `phpcrudappdb`.`usertable` SET `userfirstname`=?,`userlastname`=?,`useremail`=?,`usergender`=?,`userage`=?,`userpassword`=?,`userregistereddate`=? WHERE username=?;";
        $dataset=[$_POST['userfirstname'],$_POST['userlastname'],$_POST['useremail'],$usergender,$userage1,$_POST['userpassword'],$userregistereddate,$incomingusername];
        $res = $conn->prepare($sqlupdatequery);
        $res->execute($dataset);
    
        if(isset($_SESSION['adminname'])){
          header('Location: ../admin/adminindex.php');
        }
        else if(isset($_SESSION['username'])){
          header('Location: ../user/userindex.php');
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
  <title>update row</title>
</head>
<body>
  <?php

if(isset($_SESSION['adminname']) || isset($_SESSION['username'])){
?>
  <h3>for username : <?=$username?> </h3>
  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    
    <label>userfirstname</label><input type="text" name="userfirstname" id="" value="<?= $userfirstname ?>"></br>
    <label>userlastname</label><input type="text" name="userlastname" id="" value="<?= $userlastname ?>"></br>
    <label>useremail</label><input type="text" name="useremail" id="" value="<?= $useremail ?>"></br>
    <label>date of birth</label> <input type="date" name="userdob" id="userdob" value="<?= $userdob ?>" required></br>
    <label>userpassword</label><input type="text" name="userpassword" id="" value="<?= $userpassword ?>"></br>
    <input type="submit" value="updaterow" name="updaterow">
  </form>

  <?php
  }
 ?>
</body>
</html>