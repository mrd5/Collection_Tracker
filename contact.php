<?php

if (isset($_POST["SUBMIT"])){
  $email = trim($_POST["email"]);
  $message = trim($_POST["message"]) . "\n Sent by: " . $email;
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

<script type="text/javascript" src="/javascript/login/login.js"></script>

</head>
<body>
  <!-- main -->
  <div class="main-w3layouts wrapper">
    <h1>Contact</h1>
    <div class="main-agileinfo">
      <div class="agileits-top">
        <form action="contact.php" method="post">
          <label id="uname_msg" class="err_msg"></label>
          <input type="text" name="email" placeholder="Email" id="email"/><br />
          <label id="message_msg" class="err_msg"></label>
          <textarea name="message" id=message" placeholder="Enter your message here..."></textarea>
          <input type="submit" value="SUBMIT" name="SUBMIT" id="SUBMIT"/>
          <label id="label">
            <?php
            if (isset($_SESSION["error"])){
              echo $_SESSION["error"];
              unset($_SESSION["error"]);
            }
            ?>
          </label>
        </form>
        <script type="text/javascript" src="/javascript/login/login_r.js"></script>
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