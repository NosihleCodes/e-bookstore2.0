<?php
session_start();

include "DBConn.php"; //connect to database
include 'create-table.php'; //create tables

//initialize variables
$email = $pass = $hpass = $output = $verify = NULL;

//submit data to the database
if (isset($_POST['submit'])){
	$email = $_POST['Email'];
	$pass = $_POST['Password'];
	$hpass = md5($pass);
	
	//find the student 
	$checkdb = "SELECT * FROM tblusers WHERE Email = '$email' AND Password = '$hpass'";
	$result = mysqli_query($conn, $checkdb);
	$user = mysqli_fetch_array($result);
	
	//validate the data fields
	if(empty($email) || empty($pass)){
		$output = "Fields cannot be empty!";
	}elseif(($user['Email'] !== $email) && ($user['Password'] !== $hpass)){
		$output = "Invalid credentials!";
	}elseif(($user['Verification'] != '1')){
		$output = "Wait for your account to be verified";
	}else{
		$_SESSION['Email'] = $email;
		header('location: index.php');
		$output = "Logged on ";
	}
}

//if forgot password
if(isset($_POST['forgot'])){
	$output = "Contact your administrator";
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="loginBox">
<h1>Student Login</h1>

<form action="user-login.php" method="POST">
<?php echo $output ?>
  <label for="Email">Email:</label>
  <input type="text" id="Email" name="Email">
  <label for="Password">Password:</label>
  <input type="password" id="Password" name="Password">
<button onclick="document.location= 'index.php'" type="submit" value="submit" name="submit">Login</button><br>

</form>
</div>
  <p class="paraLink">Don't have an account? <a href="user-register.php">Register</a></p>
  <br>
  <button onclick="document.location='admin-login.php'" class="btnAdminLog">Admin</button>
</body>
</html>