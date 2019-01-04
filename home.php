<?php
session_start();
include('connection.php');
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<!-- //web font -->

</head>
<body>

<div class="topnav">
  <?php
  if (isset($_SESSION["username"])){
    echo "<div class='dropdown'>";
    echo "<button class='dropbtn'>Welcome, " . $_SESSION["username"] . " ";
    echo "<i class='fa fa-caret-down'></i>";
    echo "</button>";
    echo "<div class='dropdown-content'>";
    echo "<a href='/settings'>Account Settings</a>";
    echo "<a href='/logout'>Logout</a>";
    echo "</div>";
    echo "</div>";
  }
  else{
    echo "<a href='/login'>Login</a>";
  }  ?>
  <a href="/home" class="active-page">Home</a>
  <a href="/contact">Contact</a>
</div>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Mathew's Collection Tracker</h1>
		<?php
		if (isset($_SESSION["username"])){
			$username = $_SESSION["username"];
			$getCollectionsQuery = "SELECT * FROM collections WHERE owner = '$username'";
			$getCollections = $db->query($getCollectionsQuery);
		}
		else {
			echo "Please login to use the website!";
		}
		?>
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