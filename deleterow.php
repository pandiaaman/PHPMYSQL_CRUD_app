<?php
  //this page is to delete the row based on the button clicked on adminindex.php
  session_start();
  require_once('./pdo.php');

  $incominguserid = $_GET['userid'];
  $sqldeltequery = "DELETE FROM `phpcrudappdb`.`usertable` WHERE userid=?; ";
  $dataset= [$incominguserid];
  $res = $conn->prepare($sqldeltequery);
  $res->execute($dataset);
  if($res == true){
    header('Location: ./adminindex.php');
  }
?>