<?php
//this file will be the landing page of the application,it will be containing the details about the website, like what we are, what we do
//sections : nav menu(reg, login) -> hero page -> what we are -> what we do -> user experience -> our team -> pricing -> register ->  footer
//user will be having the register and login options here
//on registering, the user data should be saved in the DB and user will land back on the login page
//after logging in the user will land at the user's home page with his/her details mentioned there
//in the footer of the landing page we have the admin login option which will be used by the admin to login and see all the users in the database
echo "hello";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHPCrudWebsite</title>
</head>
<body>
  <header class="header">
    <div class="headerdivlogo">
      <img src="" alt="website logo">
    </div>
    <div class="headerdivmenu">
      <nav class="navmenu">
        <li class="navitem">register</li>
        <li class="navitem">login</li>
        <li class="navitem">about us</li>
        <li class="navitem">contact us</li>
      </nav>
    </div>
    <main class="hero">
      <div class="tagline"></div>
      <div class="heroimage"></div>
      <div class="actionbutton">
        <button class="heroactionbutton"></button>
      </div>
    </main>
    <section>
      <form action="" method="post" class="newsletter">
        <label for="">enter your email to receive our newsletter</label>
        <input type="text" name="newsletteremail" placeholder="enter email here" value="">
      </form>
    </section>
    <section></section>
    <aside></aside>
    <footer>
      <div class="footerdiv"></div>
      <div class="footerdiv"></div>
      <div class="footerdiv"></div>
      <div class="footerdiv"></div>
    </footer>
  </header>
</body>
</html>
