<?php

session_start();

$db = new mysqli("localhost", "root", "", "collection");
if ($db->connect_error)
{
	die ("Connection failed: " . $db->connect_error);
}

$getUsersQuery = "SELECT * FROM users";
$getUsers = $db->query($getUsersQuery);

while ($userRows = $getUsers->fetch_assoc()){
	echo $userRows['id'] . " " . $userRows['username'] . " " . $userRows['email'] . " " . $userRows['password'];
}

?>