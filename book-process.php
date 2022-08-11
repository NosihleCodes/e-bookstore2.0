<?php
session_start();
include 'DBConn.php'; //webpages to communicate with db


$Title = $Image = $Price = $Quantity =  "";
$bookID = 0;

if(isset($_POST['save'])){

$Image = $_POST['Image'];
$Title = $_POST['Title'];
$Price = $_POST['Price'];
$Quantity = $_POST['Quantity'];

echo $Title."<br>".$Image."<br>".$Price."<br>";

		//CR in CRUD
$sql = "INSERT INTO tblbooks (Image, Title, Price, Quantity) VALUES ('$Image', '$Title', '$Price', '$Quantity')";

$storeBook = mysqli_query($conn, $sql);

if($storeBook){
	header("location: manage-books.php");	
		$_SESSION['message'] = "Book stored!";
} else{
	echo "An error occurred! ".mysqli_error($conn);
}
}

$getBooks = "SELECT * FROM tblbooks";
$results = mysqli_query($conn, $getBooks); 


//UPDATE -- CRUD -- stuck here
if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$record = mysqli_query($conn, "SELECT * FROM tblbooks WHERE bookID=$id");

	if (count($record) == 1 ) {
		$n = mysqli_fetch_array($record);
		$Image = $n['Image'];
		$Title = $n['Title'];
		$Price = $n['Price'];
		$Quantity = $n['Quantity'];
	}
	
}

//Delete --CRUD
if (isset($_GET['del'])) {
	$id = $_GET['del'];
	$Delbook = mysqli_query($conn, "DELETE FROM tblbooks WHERE bookID=$id");
	
	if($Delbook){
		header("location: manage-books.php");
		$_SESSION['message'] = "Book deleted!";
	}else{
		echo "An error occurred! ".mysqli_error($conn);
	}
}
?>