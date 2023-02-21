<?php
//this is the main page where we list all the user details present in the database in a table 
//every row has a delete, update option associated with it
//create option where the admin can create new users in the DB
//when admin clicks on the update or delete option for any row, the id is passed along to the next page where a confirmation is
//taken for the deletion and the form is generated again for the updation of the row
//we land back to this page once the deletion and the updation is complete
//we have a logout button in this page that logs out the admin

session_start();
//print_r($_POST);
require_once('./nav.php');

if(isset($_SESSION['adminname'])){
require_once('./pdo.php');
echo "welcome to your home page " . $_SESSION['adminname'];
}
if(isset($_SESSION['adminname'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin index</title>
</head>
<body>
<?php 
    if($_SESSION['user'] == 'admin'){
  ?>
    <h3>all results in DB</h3>
    <button><a href="./adminadduser.php?">add user</a></button>

    <button><a href="./logout.php?">logout</a></button>

    <?php
      $sqlselectquery = 'SELECT * FROM `phpcrudappdb`.`usertable`';
      $res = $conn->prepare($sqlselectquery);
      $res->execute();
      $num_rows = $res->rowCount();
      //echo $num_rows;
      if($num_rows>0){
    ?>
    <table border='1'>
      <tr>
        <th>id</th>
        <th>first name</th>
        <th>last name</th>
        <th>username</th>
        <th>email</th>
        <th>gender</th>
        <th>image</th>
        <th>dob</th>
        <th>age</th>
        <th>password</th>
        <th>registered date</th>
      </tr>
    <?php
      }

      while($row = $res->fetch(PDO::FETCH_ASSOC)){
       
    ?>
      <tr>
        
        <td><?= $row['userid'] ?></td>
        <td><?= $row['userfirstname'] ?></td>
        <td><?= $row['userlastname'] ?></td>
        <td><?= $row['username'] ?></td>
        <td><?= $row['useremail'] ?></td>
        <td><?= $row['usergender'] ?></td>
        <td><?= $row['userimage'] ?></td>
        <td><?= $row['userdob'] ?></td>
        <td><?= $row['userage'] ?></td>
        <td><?= $row['userpassword'] ?></td>
        <td><?= $row['userregistereddate'] ?></td>
        <td>
          <button class="deleterowbutton"><a href="./deleterow.php?userid=<?=$row['userid'] ?>">Delete</a></button>
        </td>
        <td>
          <button class="updaterowbutton"><a href="./updaterow.php?userid=<?=$row['userid'] ?>">Update</a></button>
        </td>
      </tr>

    <?php
      }
    ?>
    </table>

</body>
</html>
<?php
}
}
?>