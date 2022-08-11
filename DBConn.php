<?php

$server = 'localhost';
$name = 'root';
$password = '';
$DB = 'st10131148_Bookstore';

$conn = mysqli_connect($server, $name, $password);

if(!$conn){
    die('Could not connect: ' .mysqli_error());
} else {
	//echo "You have successfully connected!";
}
//select the db
$selectDB = mysqli_select_db($conn, $DB);

if(!$selectDB){
	
	$sql = "CREATE DATABASE ".$DB. ""; 
	$createDB = mysqli_query($conn, $sql); 
	//echo "<br>";
	//echo "$DB created successfully!";
	
} else {
//	echo "<br>";
	//echo "$DB already exists!";
}

$conn = mysqli_connect ($server, $name, $password, $DB);

?>