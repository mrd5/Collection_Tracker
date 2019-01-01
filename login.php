<?php
session_start();

include('connection.php');

$validateL = true;//for validating the username and password
$reg_PswdL = "/^(\S*)?\d+(\S*)?$/";//Validates password
$reg_uname = "/^[A-Za-z]+$/"; //Makes sure username is proper format - letters ONLY


if (isset($_POST["LOGIN"])){
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);

	//validate username
	$usernameMatch = preg_match($reg_uname, $username);
	if ($username == null || $username == "" || $usernameMatch == false){
		$validateL = false;
	}

	$passwordLength = strlen($password);
	$passwordMatch = preg_match($reg_PswdL, $password);
	if ($password == null || $password == "" || $passwordLength < 8 || $passwordMatch == false ){
		$validateL = false;
	}

	if ($validateL == false){
		$_SESSION["error"] = "Username or password was entered incorrectly. Turn on Javascript to see what their requirements!";
		$db->close();
	}
	else{
		$getUserQuery = "SELECT * FROM users WHERE username = '$username'";
		$getUser = $db->query($getUserQuery);

		if ($getUser->num_rows == 0){
			$_SESSION["error"] = "That username is not in use. Please try again or create an account!";
			$db->close();
		}
		else {
			while ($userRow = $getUser->fetch_assoc()){
				if ($userRow["password"] != $password){
					$_SESSION["error"] = "Password entered incorrectly. Please try again!";
					$db->close();
				}
				else{
					$_SESSION["username"] = $userRow["username"];
					$_SESSION["email"] = $userRow["email"];
					header("Location: home");
					$db->close();
					exit();
				}
			}
		}
	}	

}









?>


<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- web font -->
<link rel="stylesheet" type="text/css" href="css/register.css" />
<!-- //web font -->

<script type="text/javascript" src="/javascript/login/login.js"></script>

</head>
<body>
<?php
if (isset($_SESSION["error"])){
	echo $_SESSION["error"];
	unset($_SESSION["error"]);
}
?>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Mathew's Collection Tracker</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="login.php" method="post">
					<label id="uname_msg" class="err_msg"></label>
					<input type="text" name="username" placeholder="Username" id="username"/><br />
					<label id="pswdLogin_msg" class="err_msg"></label>
					<input type="password" name="password" placeholder="Password" id="password"/>
					<input type="submit" value="LOGIN" name="LOGIN" id="LOGIN"/>
				</form>
				<script type="text/javascript" src="/javascript/login/login_r.js"></script>
				<p>Don't have an account? <a href="/register"> Create one!</a></p>
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