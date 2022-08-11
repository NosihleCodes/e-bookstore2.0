<?php
session_start(); //starting session to pass data between pages
include "DBConn.php" ; //make sure the database exists and is connected. 
include "create-table.php";

//initializing the variables
$email = $pwd = $hashPwd = $error = $uType = $verify = NULL;

//once the LOGIN button is clicked
if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
	$uType = $_POST['utype'];
    $hashPwd = md5($pwd);
	
	//fetching user from database
    $findUser = "SELECT * FROM tblusers WHERE Email = '$email' AND Password = '$pwd'";
    $results = mysqli_query($conn, $findUser);
    $user = mysqli_fetch_assoc($results);
	
	//validating all fields
	/*
    if(empty($email) || empty($pwd)){
        $error = "Fields cannot be empty!";
    }elseif(($user['Email'] !== $email) || ($user['Password'] !== $hashPwd)){
        $error = "Invalid credentials. Please try again.";
    }elseif(($user['Type'] !== 'admin')){
		$error = "You do not have administrative rights.";
	}else{
        $_SESSION['Email'] == $email;
        header('location: manage-books.php');
    }*/
	
			if($email == "admin@admin.com" && $pwd == "admin") {
	  
			  $_SESSION['emailx'] = $email;
			  header('location: manage-books.php');
			  
		    } 
}
//if forgot password is clicked
if(isset($_POST['forgot'])){
    $error = "Contact your administrator.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
  
<div class="loginBox">
<h1>Administrator Login</h1>

<form method="post" action="admin-login.php">
<p>Username: admin@admin.com||Password: admin</p>
<?php echo $error ?>

<label for="Uname"><b>Username:</b></label>
<input type="text" placeholder="Username/Email" id="email" name="email" required> 

<label for="psw"><b>Password:</b></label>
<input type="password" placeholder="Password" id="pwd" name="pwd" required> 

<button onclick="document.location= 'manage-books.php'" type="submit" value="submit" name="submit">Login</button>
</form>
</div>
<button onclick="document.location='user-login.php'" class="btnAdminLog">Student</button>
</body>
</html>
