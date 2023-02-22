
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
  <nav>
    <a href="./logout.php">logout</a>
    <?php 
    if($_SESSION['user'] == 'user'){
      ?>
      <a href="./userindex.php">go to user home</a>
    <?php
    }else if($_SESSION['user'] == 'admin'){
    ?>
      <a href="./adminindex.php">go to admin home</a>
    <?php
    }
    ?>
  </nav>
</body>
</html>