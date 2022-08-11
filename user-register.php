<?php
session_start();
include "DBConn.php";

//initialise the variables
$Name = $Surname = $StudentNum = $Email = $Password = $cpassword = $output = NULL;

echo "<br>";
echo "<br>";
//someone has pressed the submit button.
if(isset($_POST['submit'])){
	$Name = $_POST['Name'];
	$Surname = $_POST['Surname'];
	$StudentNum = $_POST['StudentNum'];
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$cpassword = $_POST['cpassword'];
	
//Form validation begins:

$uppercase = preg_match('@[A-Z]@', $Password);
$lowercase = preg_match('@[a-z]@', $Password);
$number    = preg_match('@[0-9]@', $Password);
$specialChars = preg_match('@[^\w]@', $Password);

if(empty($Name) || empty($Surname) || empty($StudentNum) || empty($Email) || empty($Password) || empty($cpassword)){
	$output = "No feilds can be empty";
} elseif($Password != $cpassword){
	$output = "Passwords do not match";
} elseif(strlen($Password) <= 8){
	$output = "Passwords is too short";
} elseif(!$uppercase || !$lowercase || !$number || !$specialChars) {
    $output = "Chose a stronger password";
}else{
    $output = "Password Okay.";
}

//Differetiate between normal and admin user.
//User verfication by administrator 
//logout


if ($Password == $cpassword){
	$hpass = md5($Password);
	
	$sql = "INSERT INTO tblusers(Name, Surname, StudentNum, Email, Password) VALUES ('$Name','$Surname','$StudentNum','$Email','$hpass')";
$insert = mysqli_query($conn, $sql);
echo "<br>";

if ($insert == true){
	echo "Row Inserted!!";
	header ('location: user-login.php');
	$Name = $Surname = $Email = $StudentNum = NULL;
}else{
	echo "Error Not inserted.";
}

}else{
	echo "Passwords do not match";
}
	


}

?>
<!DOCTYPE html>
<html>
<head>
<title>
Register
</title> 
<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="registerBox">

<h1>Register</h1> 
<form action="user-register.php" method="POST">

<?php echo $output ?><br>

	<label for="Name">Name</label>
  <input type="text" id="Name" name="Name">
	
	<label for="Surname">Surname</label>
  <input type="text" id="Surname" name="Surname">
  
	<label for="StudentNum">STNumber</label>
  <input type="text" id="StudentNum" name="StudentNum">

	<label for="Email">Email</label>
  <input type="email" id="Email" name="Email">

	<label for="Password">Enter your Password</label>
  <input type="password" id="Password" name="Password">

	<label for="cpassword">Confirm your password</label>
  <input type="password" id="cpassword" name="cpassword">
<br>
  <button onclick="document.location= 'user-login.php'" type="submit" value="submit" name="submit">Register</button><br>
</form>
</div>

<p class="paraLink">Already have an account? <a href="user-login.php">Log in</a></p>


</body>
</html>