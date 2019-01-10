<?php
session_start();
include('connection.php');

if (!isset($_SESSION["username"])){
	$_SESSION["error"] = "You must be logged in to view this page!";
	header("Location: login");
}
?>




<!DOCTYPE html>
<html>
<head>
<title>Create a Collection</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- web font -->
<link rel="stylesheet" type="text/css" href="css/register.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<!-- //web font -->

<script type="text/javascript" src="/javascript/create/create.js"></script>

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
    echo "<a href='/create' id='active-page'>Create a Collection</a>";
    echo "<a href='/logout'>Logout</a>";
    echo "</div>";
    echo "</div>";
  }
  else{
    echo "<a href='/login'>Login</a>";
  }  ?>
  <a href="/home">Home</a>
  <a href="/contact">Contact</a>
</div>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Mathew's Collection Tracker</h1><br />
		<div class="main-agileinfo">
			<div class="agileits-top" id="parent">
				<form action="create.php" method="post">
					<input type="text" name="name" id="name" placeholder="Name of Collection"/><br />
					<input type="text" name="object" class="objects" placeholder="Item"/>
					<button id="new">Add new item</button>
					<input type="submit" name="SUBMIT" value="SUBMIT" id="SUBMIT"/>
				</form>
				<script type="text/javascript" src="/javascript/create/create_r.js"></script>

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