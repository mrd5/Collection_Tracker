<?php
session_start();

include('connection.php');

$validateS = true;//false if any values are entered incorrectly 
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/"; //Makes sure email is in proper format : something@somewhere.adr
$reg_uname = "/^[A-Za-z]+$/"; //Makes sure username is proper format - letters ONLY
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";//Used to make sure password is in the proper format - letters and must contain at least one number

if (isset($_POST["SIGNUP"])){
	//Store user submitted values
	$email = trim($_POST["email"]);
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$passwordconf = trim($_POST["passwordconf"]);

	if ($password != $passwordconf){//passwords dont match
		$_SESSION["error"] = "Passwords must match!";
		$db->close();
	}

	else{//passwords match
		$checkEmailQuery = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
		$checkEmail = $db->query($checkEmailQuery);

		if ($checkEmail->num_rows > 0){//username or email will already be in use
			while ($rows = $checkEmail->fetch_assoc()){
				if ($rows["username"] == $username && $rows["email"] == $email){//both email and password are in use
					$_SESSION["error"] = "Username and email are both already in use. Please use different credentials!";
				}
				else if ($rows["username"] != $username){//email is in use
					$_SESSION["error"] = "Email is already in use. Please try again with a different email!";
				}
				else {//username is in use
					$_SESSION["error"] = "Username is already in use. Please try again with a different username!";
				}
				$db->close();
			}
		}
		else{//both username and email are free. perform backend validation
			$emailMatch = preg_match($reg_Email, $email); //validate email
    		if($email == null || $email == "" || $emailMatch == false){
    			$validateS = false;
    		}
    
    		$pswdLenS = strlen($password); //validate password
    		$pswdMatch = preg_match($reg_Pswd, $password);
    		if($password == null || $password == "" || $pswdLenS < 8 || $pswdMatch == false){
    			$validateS = false;
    		}

    		$unameMatch = preg_match($reg_uname, $username); //validate uname
    		if ($username == null || $username == "" || $unameMatch = false){
    			$validateS = false;
    		}
		}
		if (!$validateS){//if a value has been entered incorrectly
			$_SESSION["error"] = "You've entered one or more values incorrectly. Please turn Javascript on to see what is required!";
			$db->close();
		}
		else{
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			$createUserQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
			$createUser = $db->query($createUserQuery);
			header("Location: login");
			$db->close();
			exit();
		}
	}
}

?>


<!DOCTYPE html>
<html>
<head>
<title>Create an Account</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- web font -->
<link rel="stylesheet" type="text/css" href="css/register.css" />
<!-- //web font -->

<script type="text/javascript" src="/javascript/register/register.js"></script>
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
				<form action="register.php" method="post">
					<label id="uname_msg" class="err_msg"></label>
					<input type="text" name="username" id="username" placeholder="Username"/><br />
					<label id="emailLogin_msg" class="err_msg"></label>
					<input type="email" name="email" id="email" placeholder="Email"/><br />
					<label id="pswdLogin_msg" class="err_msg"></label>
					<input type="password" name="password" id="password" placeholder="Password"/><br />
					<label id="pswdrLogin_msg" class="err_msg"></label>
					<input type="password" name="passwordconf" id="passwordconf" placeholder="Confirm Password"/>
					<input type="submit" value="SIGNUP" name="SIGNUP" id="SIGNUP">
				</form>
				<script type="text/javascript" src="/javascript/register/register_r.js"></script>
				<p>Already have an account? <a href="/login"> Login Now!</a></p>
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