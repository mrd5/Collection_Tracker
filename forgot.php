<?php
session_start();
include('connection.php');

if (isset($_POST["SUBMIT"])){
  $_SESSION["error"] = "If an account with that email exists an email has been sent to you with a link to reset your password and it will last 15 minutes.";

  $email = $_POST["email"];

  $getUserQuery = "SELECT id FROM users WHERE email = '$email'";
  $getUser = $db->query($getUserQuery);

  if ($getUser->num_rows > 0){
    while ($userRow = $getUser->fetch_assoc()){
      $id = $userRow["id"];
    }
    
    $token = openssl_random_pseudo_bytes(16);
    $token = bin2hex($token);

    $createRequestQuery = "INSERT INTO password_reset_request (user_id, date_requested, token) VALUES ('$id', NOW(), '$token')";
    $createRequest = $db->query($createRequestQuery);

    $link = "reset.php?t=$token";

    $headers = "From: " . $email . "\r\n";
    $to = "collectiontestemail@gmail.com";
    $subject = "Reset password";
    mail($to, $subject, $link, $headers);
  }
}

?>


<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- web font -->
<link rel="stylesheet" type="text/css" href="css/register.css" />
<!-- //web font -->

<script type="text/javascript" src="/javascript/forgot/forgot.js"></script>

</head>
<body>
  <!-- main -->
  <div class="main-w3layouts wrapper">
    <h1>Forgot Password</h1>
    <div class="main-agileinfo">
      <div class="agileits-top">
        <form action="forgot.php" method="post">
          <label id="label">
            <?php
            if (isset($_SESSION["error"])){
              echo $_SESSION["error"];
              unset($_SESSION["error"]);
            }
            else {
              echo "Please enter your email and we will send you a link to reset your password.";
            }
            ?>
          </label>
          <label id="email_msg" class="err_msg"></label>
          <input type="text" name="email" placeholder="Email" id="email"/><br />
          <input type="submit" value="SUBMIT" name="SUBMIT" id="SUBMIT"/>
          <p class="info">Don't have an account? <a href="/register"><u>Create one here!</u></a></p>
          <p class="info lower"><a href="/forgot"><u>Forgot password?</u></a></p>
        </form>
        <script type="text/javascript" src="/javascript/forgot/forgot_r.js"></script>
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