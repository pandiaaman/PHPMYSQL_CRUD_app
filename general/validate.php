<?php
//this is to validate the inputs that user enters in the register page
//same for the enteries put by the admin 

//REGEX in PHP
       /*
          regex in php:
          we have a pattern and a string that is matched with the pattern
          pattern is present inside the / /, we can use i after the / to show the matching should be case insensitive
          we use preg_match($pattern, $str);  : 1 represents match and 0 represents not matched
          // /i is for case insensitive
       */

function validateinputs(array $inputarray){
  $_SESSION['flashmessage']='';
  $firstlastnameflag = 0;
  foreach($inputarray as $key => $value ){
    
    if($key != "userpassword"){
       $inputarray[$key] = trim(htmlentities(htmlspecialchars($value)));
      //  echo "</br>key is :  " . $key . "</br>";
    }
    $value = $inputarray[$key];
       
    if($firstlastnameflag == 0){
      if($key == "userfirstname" || $key =="userlastname"){//validating userfirstname/lastname
        $pattern = "/^[a-z]{2,15}$/i"; //starts with a-z can only have 2 to 15 chars and ends with a-z, no spaces, no digits, no sprecial chars
        $res = preg_match($pattern, $value);
        if($res == 0){
          $firstlastnameflag = 1;
          $message = "firstname and lastname can only be between 2 to 15 letters, no spaces, no digits or special chars, please check";
          $_SESSION['flashmessage']= $_SESSION['flashmessage'] . $message . "</br>";
          
        }
      }
    }
    if($key == "username"){//validating username
     
      $pattern = "/^[^-\s*#@!%$~`|\/.,()+=]*$/i";
      $res = preg_match($pattern, $value);
      if($res == 0){
        $message = "username is not in the correct format, please check";
        // echo $message;
        $_SESSION['flashmessage']= $_SESSION['flashmessage'] . $message . "</br>";
      // header('Location: ../user/userregister.php');
      }
    }
    if($key == "userage"){//validating userage
      $pattern = "/[0-9]{1,2}/";
      $res = preg_match($pattern, $value);
      if($res == 0){
        $message = "userage is not in the correct format, please check";
        $_SESSION['flashmessage']= $_SESSION['flashmessage'] . $message . "</br>";
    //  header('Location: ../user/userregister.php');
      }
    }
    if($key == "userdob"){//validating userdob
      $pattern="/[0-9]{4}-[0-9]{2}-[0-9]{2}/";
      $res = preg_match($pattern, $value);
      if($res == 0){
        $message = "userdob is not in correct format" . $value;
        $_SESSION['flashmessage']= $_SESSION['flashmessage'] . $message . "</br>";
        // header('Location: ../user/userregister.php');
      }
    }
    if($key == "useremail"){//validating useremail
      $pattern = "/^[^\s]+[a-z0-9A-Z-']+@{1}[a-z]+.com{1}$/i";
      $res = preg_match($pattern,$value);
      if($res == 0){
        $message = "please check your email again";
        $_SESSION['flashmessage']= $_SESSION['flashmessage'] . $message . "</br>";
      //  header('Location: ../user/userregister.php');
      }
    }
    if($key == "usergender"){//validating user gender
      $pattern =  "/^[MFO]{1}$/i";
      $res = preg_match($pattern, $value);
      if($res == 0){
        $message = "please check your input for gender";
        $_SESSION['flashmessage']= $_SESSION['flashmessage'] . $message . "</br>";
      //  header('Location: ../user/userregister.php');
      }
    }
    if($key == "userpassword"){//validating userpassword
      $pattern = "/[a-z0-9A-Z-' ]{8,16}/i";
      $res = preg_match($pattern,$value);
      if($res == 0){
        $message = "your password should be 8 to 16 characters";
        $_SESSION['flashmessage']= $_SESSION['flashmessage'] . $message . "</br>";
      //  header('Location: ../user/userregister.php');
      }
    }
 }
 //echo $_SESSION['flashmessage'];
  return $inputarray;
}

?>