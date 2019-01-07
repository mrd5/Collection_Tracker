<?php
session_start();
include ('connection.php');
if (!isset($_SESSION["username"])){
	$_SESSION["error"] = "You must be logged in to view your account information!";
	header("Location: login");
}
if (isset($_POST["SUBMIT"])){
  $oldusername = $_SESSION["username"];
  $username = trim($_POST["username"]);
  $email = trim($_POST["email"]);
  $newpassword = trim($_POST["newpassword"]);
  $newpasswordconf = trim($_POST["newpasswordconf"]);
  $password = trim($_POST["password"]);

  $getUserQuery = "SELECT * FROM users WHERE username = '$oldusername'";
  $getUser = $db->query($getUserQuery);
  while ($userRows = $getUser->fetch_assoc()){
    $oldpassword = $userRows["password"];
    $id = $userRows["id"];
  }
  if (!password_verify($password, $oldpassword)){
    $_SESSION["error"] = "Old password entered incorrectly. Please try again!";

  }
  else{
    $validateL = true;//for validating the username and password
    $reg_PswdL = "/^(\S*)?\d+(\S*)?$/";//Validates password
    $reg_uname = "/^[A-Za-z]+$/"; //Makes sure username is proper format - letters ONLY
    $reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/"; //Makes sure email is in proper format : something@somewhere.adr

    //validate username
    $usernameMatch = preg_match($reg_uname, $username);
    if ($username == null || $username == "" || $usernameMatch == false){
      $validateL = false;
    }

    //validate email
    $emailMatch = preg_match($reg_Email, $email);
    if ($email == null || $email == "" || $emailMatch == false){
      $validateL = false;
    }

    //validate new password
    $passwordLength = strlen($newpassword);
    $passwordMatch = preg_match($reg_PswdL, $newpassword);
    if (($newpassword == null && $newpasswordconf != null) || ($newpassword == "" && $newpasswordconf != "" ) || ($passwordLength < 8 && $passwordLength > 0) || ($passwordMatch == false && $newpassword != "") || $newpassword != $newpasswordconf ){
    $validateL = false;
    }

    if ($validateL == false){
      $_SESSION["error"] = "One or more values were entered incorrectly. Please turn on javascript to see their requirements!";
      $db->close();
    }
    else{
      if ($newpassword == ""){
        $updateQuery = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$id'";
      }
      else{
        $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE users SET username = '$username', email = '$email', password = '$hashed_password' WHERE id = '$id'";
      }
      $update = $db->query($updateQuery);
      $_SESSION["username"] = $username;
      $_SESSION["email"] = $email;
    }
  }


}
?>


<!DOCTYPE html>
<html>
<head>
<title>Account Settings</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- web font -->
<link rel="stylesheet" type="text/css" href="css/register.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- //web font -->

<script type="text/javascript" src="/javascript/settings/settings.js"></script>

</head>
<div class="topnav">
  <?php
  if (isset($_SESSION["username"])){
    echo "<div class='dropdown'>";
    echo "<button class='dropbtn'>Welcome, " . $_SESSION["username"] . " ";
    echo "<i class='fa fa-caret-down'></i>";
    echo "</button>";
    echo "<div class='dropdown-content'>";
    echo "<a href='/settings' id='active-page'>Account Settings</a>";
    echo "<a href='/logout'>Logout</a>";
    echo "</div>";
    echo "</div>";
  }
  else{
    echo "<a href='/login'>Login</a>";
  }
  ?>
  <a href="/home">Home</a>
  <a href="/contact">Contact</a>
</div>
<body>
  <!-- main -->
  <div class="main-w3layouts wrapper">
    <h1>Account Settings</h1>
    <div class="main-agileinfo">
      <div class="agileits-top">
        <form action="settings.php" method="post">
          <label id="label">
            <?php
            if (isset($_SESSION["error"])){
              echo $_SESSION["error"];
              unset($_SESSION["error"]);
            }
            ?>
          </label>
          <label id="username_msg" class="err_msg"></label>
          <?php 
          $email = $_SESSION["email"];
          $username = $_SESSION["username"];

          echo "<input type='text' name='username' id='username' value='$username' /><br />";
          echo "<label id='email_msg' class='err_msg'></label>";
          echo "<input type='text' name='email' id='email' value='$email' /><br />";
          
          ?>
          <label id='newpassword_msg' class='err_msg'></label>
          <input type='password' name='newpassword' id='newpassword' placeholder='Enter a new password or leave blank'/><br />
          <label id='newpasswordconf_msg' class='err_msg'></label>
          <input type='password' name='newpasswordconf' id='newpasswordconf' placeholder='Confirm new password or leave blank'/><br />
          <label id='password_msg' class='err_msg'></label>
          <input type='password' name='password' id='password' placeholder='Enter your current password to confirm changes'/>
          <input type="submit" value="SUBMIT" name="SUBMIT" id="SUBMIT"/>
          
        </form>
        <script type="text/javascript" src="/javascript/settings/settings_r.js"></script>
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
