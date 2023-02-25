<?php
//this is the page where admin logs in, it is a simple admin id and admin password with otp authentication
//coantins a login button, on click otp is generated and we are taken to the otp page
//if correctly entered then based on the admin enterance, the otp page should lead you to adminindex.php
//if incorrect otp then go to home page
session_start();

if(isset($_SESSION['flashmessage'])){
  echo $_SESSION['flashmessage'] . "</br>";
  unset($_SESSION['flashmessage']);
}

if(isset($_POST["adminlogin"]) && isset($_POST["adminname"]) && isset($_POST["adminpassword"])){
  include_once('./general/pdo.php');
  $sql = "select * from `phpcrudappdb`.`admintable` where adminname=? and adminpassword=?";
  $dataset=[$_POST['adminname'], $_POST['adminpassword']];
  $res = $conn->prepare($sql);
  $res->execute($dataset);

  if($res->rowCount() == 1){
   
    $_SESSION['user'] = 'admin'; 
    $otp = rand(1111,9999);
    $_SESSION['otp'] = $otp;

    // the message
    $msg = "Hello\n Please find your otp to login into the website: " . $otp;

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    $sql1 = "select * from `phpcrudappdb`.`admintable` where adminname=? and adminpassword=?";
    $dataset=[$_POST['adminname'], $_POST['adminpassword']];
    $res = $conn->prepare($sql);
    $res->execute($dataset);
    $adminemail = $res->fetchColumn(2); //since the adminemail is the third column

    $_SESSION['adminemail'] = $adminemail;
    $_SESSION['adminname'] = $_POST['adminname'];
    // send email
    mail($adminemail,"OTP for website login",$msg);

    header('Location: ./general/otp.php');
    // header('Location: ./otp.php');
  }
  else if($res->rowCount() == 0){
    $message =  " please check your id and password";
    $_SESSION['flashmessage']  = $message;
    header('Location: ./admin/adminlogin.php');
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin login</title>

  <link rel="stylesheet" href="./style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@300;400;700&family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

</head>
<body>
  <header></header>
  <section>
    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" class="adminloginform">
      <input type="text" name="adminname" id="adminname" placeholder="enter username here" required>
      <input type="password" name="adminpassword" id="adminpassword" placeholder="enter password here" required>
      <input type="submit" class="admin-login-button" name="adminlogin" value="submit">
    </form>
  </section>
  <footer></footer>
</body>
</html>