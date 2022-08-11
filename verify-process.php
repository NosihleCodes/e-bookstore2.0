<?php
session_start();
include 'DBConn.php'; //webpages to communicate with db


$StudentNum = $Email = $Verification = "";
$user = 0;

//view all users
$viewAll = "SELECT * FROM tblusers WHERE Verification = 1";
$AllUsers = mysqli_query($conn, $viewAll);

//change to admin
if (isset($_GET['change'])) {
	$id = $_GET['change'];
	$update = true;
    $change = "UPDATE tblusers SET Type = 'admin' WHERE userID=$id";
	$change_query = mysqli_query($conn, $change);

	if($change_query){
		header('location: manage-all-users.php');
		$_SESSION['message'] = "User type changed to admin!";
	}else{
		echo "An error occurred! ".mysqli_error($conn);
	}
}

//Display all unverified users
$unverified = "SELECT * FROM tblusers WHERE Verification = 0";
$results = mysqli_query($conn, $unverified); 

//Verify user
if (isset($_GET['verify'])) {
	$id = $_GET['verify'];
	$update = true;
    $Update = "UPDATE tblusers SET Verification = 1 WHERE userID=$id";
	$ver_query = mysqli_query($conn, $Update);

	if($ver_query){
		header('location: manage-users.php');
		$_SESSION['message'] = "Verification status updated!";
	}else{
		echo "An error occurred! ".mysqli_error($conn);
	}
}


//Ignore user
if (isset($_GET['ignore'])) {
	$id = $_GET['ignore'];
    $Delete = "DELETE FROM tblusers WHERE userID=$id";
	$Delquery = mysqli_query($conn, $Delete);
	
	if($Delquery){
		header('location: manage-users.php');
		$_SESSION['message'] = "User removed!";
	}else{
		echo "An error occurred! ".mysqli_error($conn);
	}
} 
?>