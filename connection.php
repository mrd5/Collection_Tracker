<?php
//connection to database
$db = new mysqli("localhost", "root", "", "collection");
if ($db->connect_error){
	die ("Connection failed: " . $db->connect_error);
}
?>
