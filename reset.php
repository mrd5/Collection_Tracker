<?php
session_start();
include('connection.php');

if (isset($_POST["SUBMIT"])){

  if (isset($_POST["t"])){
    $t = $_POST["t"];
    $checkIfFreshQuery = "SELECT * FROM password_reset_request WHERE date_requested > DATE_SUB(NOW(), INTERVAL 15 MINUTE) AND token = '$t'";
    $checkIfFresh = $db->query($checkIfFreshQuery);

    if ($checkIfFresh->num_rows > 0){
      $password = $_POST["password"];
      $passwordconf = $_POST["passwordconf"];
      $reg_Pswd = "/^(\S*)?\d+(\S*)?$/";//Used to make sure password is in the proper format - letters and must contain at least one number

      if ($password != $passwordconf){//passwords dont match
        $_SESSION["error"] = "Passwords must match!";
        $db->close();
      }
      else {
        $pswdLenS = strlen($password); //validate password
        $pswdMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLenS < 8 || $pswdMatch == false){
          $_SESSION["error"] = "Password was entered incorrectly!";
          $db->close();
        }
        else{
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          while ($userRows = $checkIfFresh->fetch_assoc()){
            $id = $userRows["user_id"];
          }
          $updateQuery = "UPDATE users SET password = '$hashed_password' WHERE id = '$id'";
          $update = $db->query($updateQuery);

          $_SESSION["error"] = "Password updated!";
          header("Location: login");

        }

      }

    }
  }
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- web font -->
<link rel="stylesheet" type="text/css" href="css/register.css" />
<!-- //web font -->

<script type="text/javascript" src="/javascript/reset/reset.js"></script>

</head>
<body>
  <!-- main -->
  <div class="main-w3layouts wrapper">
    <h1>Reset Password</h1>
    <div class="main-agileinfo">
      <div class="agileits-top">
        <form action="reset.php" method="post">
          <?php
          if (isset($_GET["t"])){
            $t = $_GET["t"];
            echo "<input type='hidden' name='t' value='$t'/>";
          }
          ?>
          <label id="label"></label>
          <label id="password_msg" class="err_msg"></label>
          <input type="password" name="password" placeholder="Please enter your new password here" id="password"/><br />
          <label id="passwordconf_msg" class="err_msg"></label>
          <input type="password" name="passwordconf" placeholder="Please enter your new password once more" id="passwordconf"/><br />
          <input type="submit" value="SUBMIT" name="SUBMIT" id="SUBMIT"/>
        </form>
        <script type="text/javascript" src="/javascript/reset/reset_r.js"></script>
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