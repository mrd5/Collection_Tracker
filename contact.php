<?php
session_start();
if (isset($_POST["SUBMIT"])){

  $email = trim($_POST["email"]);
  $message = trim($_POST["message"]) . "\nSent by: " . $email;
  $headers = "From: " . $email . "\r\n";

  $to = "collectiontestemail@gmail.com";
  $subject = "Collection Tracker Contact Message";
  mail($to, $subject, $message, $headers);
  $_SESSION["error"] = "Message sent!";
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Contact</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- web font -->
<link rel="stylesheet" type="text/css" href="css/register.css" />
<!-- //web font -->

<script type="text/javascript" src="/javascript/contact/contact.js"></script>

</head>
<div class="topnav">
  <?php
  if (isset($_SESSION["username"])){
    echo "<p>Welcome, " . $_SESSION["username"] . "</p>";
  }
  else{
    echo "<a href='/login'>Login</a>";
  }
  ?>
  <a href="/home">Home</a>
  <a href="/contact" class="active-page">Contact</a>
  <?php
  if (isset($_SESSION["username"])){
    echo "<a href='/logout'>Logout</a>";
  }
  ?>
</div>
<body>
  <!-- main -->
  <div class="main-w3layouts wrapper">
    <h1>Contact</h1>
    <div class="main-agileinfo">
      <div class="agileits-top">
        <form action="contact.php" method="post">
          <label id="label">
            <?php
            if (isset($_SESSION["error"])){
              echo $_SESSION["error"];
              unset($_SESSION["error"]);
            }
            ?>
          </label>
          <label id="email_msg" class="err_msg"></label>
          <?php 
          if (isset($_SESSION["username"])){
            $email = $_SESSION["email"];
            echo "<input type='text' name='email' id='email' value='$email' /><br />";
          }
          else{
            echo "<input type='text' name='email' placeholder='Email' id='email' /><br />";
          }
          ?>
          <label id="message_msg" class="err_msg"></label>
          <textarea name="message" id="message" placeholder="Enter your message here..."></textarea>
          <p id="charColor"><span id="char_count">0</span> characters entered.</p>
          <input type="submit" value="SUBMIT" name="SUBMIT" id="SUBMIT"/>
          
        </form>
        <script type="text/javascript" src="/javascript/contact/contact_r.js"></script>
      </div>
    </div>
    <ul class="colorlib-bubbles">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
  </div>
  <!-- //main -->
</body>
</html>