<?php
	$conn = new mysqli("localhost", "root", "", "webtask");
	if(!$conn){
		die("Error: Cannot connect to the database");
	}
?>