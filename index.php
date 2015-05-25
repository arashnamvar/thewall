<?php

session_start();

if(isset($_SESSION["errors"]))
{
  foreach ($_SESSION["errors"] as $error) 
  {
    echo $error . "<br>";
  }
  unset($_SESSION["errors"]);
}

if(isset($_SESSION["user_id"]))
{
  session_destroy();
}

?>



<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="author" content="Arash Namvar">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="">

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row"><h4>The Wall</h4> </div class="row">
    <div class="row">
      <div class="six columns">
      <h5>Register</h5>
      <form action="process.php" method="post">
        First Name <input class="u-full-width" type="text" name="first_name">
        Last Name <input class="u-full-width" type="text" name="last_name">
        Email <input class="u-full-width" type="text" name="email">
        Password <input class="u-full-width" type="password" name="password">
        Confirm Password <input class="u-full-width" type="password" name="confirm_password">
        <input type="hidden" name="register" value="yes">
        <input class="button-primary" type="submit" value="Submit"> 
      </form>
     </div>

      <div class="six columns">
        <h5>Login</h5>
        <form action="process.php" method="post">
          Email <input class="u-full-width" type="text" name="email">
          Password <input class="u-full-width" type="password" name="password">
          <input type="hidden" name="login" value="yes">
          <input class="button-primary" type="submit" value="Submit"> 
        </form>  
      </div> 
    </div>
  </div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
