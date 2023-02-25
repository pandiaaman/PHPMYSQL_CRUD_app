<?php
//this page contains the home page of the user
//show all the details of the user here
//there will be a logout button that logs the user out and lands them back to the index page of the website
session_start();

require_once('../general/pdo.php');
$username = $_SESSION['username'];

$sqlfetch = "SELECT * FROM `phpcrudappdb`.`usertable` WHERE `username`=?;";
$dataset = [$_SESSION['username']];
$res = $conn->prepare($sqlfetch);
$res->execute($dataset);

$rowcount = $res->rowCount();
echo $rowcount;
echo "</br>";
if($rowcount == 1){
  $row = $res->fetch(PDO::FETCH_ASSOC);
  $fetchedusername = $row['username'];
  $fetcheduserfirstname = $row['userfirstname'];
  $fetcheduseremail = $row['useremail'];
  $fetcheduserlastname = $row['userlastname'];
  $fetcheduserregistereddate = $row['userregistereddate'];
  $fetcheduserage = $row['userage'];
  $fetcheduserdob = $row['userdob'];
  $fetchedusergender = $row['usergender'];
}
else{
  session_destroy();
  header('Location: ../general/index.php');
}
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>user index</title>
</head>
<body>
  
  <button><a href="../general/logout.php">logout</a></button>

  <table border=1>
    <tr>
      <td>fetchedusername</td>
      <td>fetcheduserfirstname</td>
      <td>fetcheduseremail</td>
      <td>fetcheduserlastname</td>
      <td>fetcheduserregistereddate</td>
      <td>fetcheduserage</td>
      <td>fetcheduserdob</td>
      <td>fetchedusergender</td>
    </tr>

    <tr>
      <td><?=$fetchedusername?></td>
      <td><?=$fetcheduserfirstname?></td>
      <td><?=$fetcheduseremail?></td>
      <td><?=$fetcheduserlastname?></td>
      <td><?=$fetcheduserregistereddate?></td>
      <td><?=$fetcheduserage?></td>
      <td><?=$fetcheduserdob?></td>
      <td><?=$fetchedusergender?></td>
    </tr>
  </table>

</body>
</html>