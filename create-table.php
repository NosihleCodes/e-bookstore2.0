<?php
include 'DBConn.php';
$tblUsers = "CREATE TABLE `tblusers` (
  `userID` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `StudentNum` int(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Type` varchar(10) NOT NULL DEFAULT 'student',
  `Verification` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$createUsers = mysqli_query($conn, $tblUsers);

$tblBooks = "CREATE TABLE `tblbooks` (
  `bookID` int(10) NOT NULL AUTO_INCREMENT,
  `Image` varchar(50) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Quantity` int(10) NOT NULL,
  PRIMARY KEY (`bookID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$createBooks = mysqli_query($conn, $tblBooks);

$tblOrders = "CREATE TABLE `tblorders` (
  `orderID` int(10) NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `Orderdate` date NOT NULL,
  PRIMARY KEY (`orderID`),
  CONSTRAINT `tblorders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tblusers` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$createOrders = mysqli_query($conn, $tblOrders);

$tblorderbooks = "CREATE TABLE `tblorderbooks` (
  `orderID` int(10) NOT NULL,
  `bookID` int(10) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Quantity` int(10) NOT NULL,
  PRIMARY KEY (`orderID`, `bookID`),
CONSTRAINT `tblorderbooks_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `tblbooks` (`bookID`),
CONSTRAINT `tblorderbooks_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `tblorders` (`orderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$createOrdersBooks = mysqli_query($conn, $tblorderbooks);

if($createBooks && $createOrders && $createOrdersBooks) {
	//echo "<br>Tables created successfully!";
	loadBooks();
}else{
	//echo "<br>Table already exists!";
  loadBooks();
}

if($createUsers) {
	//echo "<br>Tables created successfully!";
	$drop = "DROP TABLE `tblusers`";
	$alterDrop = "ALTER TABLE `tblorders` DROP FOREIGN KEY `tblorders_ibfk_1`;";
	$delete = mysqli_query($conn, $drop);
	$deleteAlter = mysqli_query($conn, $alterDrop);
	createUser();
	addUsers(); 

	echo "<br>Tables created successfully!";
}else{
	//echo "<br>Table already exists!";
}

//function to add users from users.txt file
function addUsers(){
	$conn = new mysqli('localhost', 'root','','st10131148_Bookstore');
	$file = fopen("users.txt","rw");
	
	while (!feof($file)) {
		$content = fgets($file);
		$carray = explode(",", $content);
		list($fname,$sname,$stnum,$email,$password) = $carray;
			$hpass = md5($password);
		$sql = "INSERT INTO `tblusers`(`Name`, `Surname`, `StudentNum`, `Email`, `Password`) VALUES ('$fname','$sname','$stnum','$email','$hpass')";
		$conn->query($sql);
}
fclose($file);
}

/* $query = "SELECT * FROM tblusers";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result) != 0) {		
  loadBooks();
} */

function loadBooks(){
	$conn = new mysqli('localhost', 'root','','st10131148_Bookstore');
  //global $conn;
  // Open the file for read access
  $open = fopen("books.txt","r");

  while (!feof($open)) // Loop thru file until the end
    
    {
      $getTextLine = fgets($open); //Get each line
      $explodeLine = explode(",",$getTextLine);

      list($Image,$Title,$Price,$Quantity) = $explodeLine;

      $insertBooks = "INSERT INTO `tblbooks` (`Image`, `Title`, `Price`,`Quantity`) VALUES ('$Image','$Title','$Price','$Quantity')";
      mysqli_query($conn,$insertBooks);
    }

  fclose($open);  
  }

function createUser(){
	$conn = new mysqli('localhost', 'root','','st10131148_Bookstore');
		
	$tblUsers = "CREATE TABLE `tblusers` (
  `userID` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `StudentNum` int(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Type` varchar(10) NOT NULL DEFAULT 'student',
  `Verification` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$createUsers = mysqli_query($conn, $tblUsers);
}
?>

