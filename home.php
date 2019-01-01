<?php
session_start();

if (isset($_SESSION["username"])){
	echo "Welcome, " . $_SESSION["username"] . "!";
	echo "<a href='logout'>Click here to logout</a>"; 
}
else{
	echo "You are not logged in.";
}

?>