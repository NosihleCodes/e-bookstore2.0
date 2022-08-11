<?php
include 'verify-process.php';

//initialise the variables
$fname = $sname = $stnum = $email = $password = $cpassword = $output = NULL;

//user has pressed the submit button.
if(isset($_POST['submit'])){
	$fname = $_POST['fname'];
	$sname = $_POST['sname'];
	$stnum = $_POST['stnum'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	
//Form validation begins
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if(empty($fname) || empty($sname) || empty($stnum) || empty($email) || empty($password) || empty($cpassword)){
	$output = "No fields can be empty";
} elseif($password != $cpassword){
	$output = "Passwords do not match";
} elseif(strlen($password) <= 8){
	$output = "Password is too short";
} elseif(!$uppercase || !$lowercase || !$number || !$specialChars) {
    $output = "Choose a stronger password";
}else{
    $output = "Password okay.";
}

if ($password == $cpassword){
	$hpass = md5($password);
}else{
	echo "Passwords do not match";
}
	
$sql = "INSERT INTO tblusers(Name, Surname, StudentNum, Email, Password) VALUES ('$fname','$sname','$stnum','$email','$hpass')";
$insert = mysqli_query($conn,$sql);
echo "<br>";
if ($insert){
	echo "User added!!";
	header ('location: manage-all-users.php');
}else{
	echo "An error occurred.";
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All users</title>
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css" >
	<link rel="stylesheet" type="text/css" href="css/style.css" >

	<style>
	body {
    font-family: Arial, Helvetica, sans-serif;
	}
  
.pill-nav a {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px;
    text-decoration: none;
    font-size: 17px;
    border-radius: 5px;
  }
  
.pill-nav a:hover {
    background-color: #ddd;
    color: black;
  }
  
.pill-nav a.active {
    background-color: #ff8533;
    color: white;
  }

  .split {
    float: right;
    background-color: #ff8533;
    color: white;
  }
	</style>

</head>
<body>

<div class="pill-nav">
  <a href="manage-books.php" ><i class="fa fa-book"></i>Manage books</a>
  <a href="manage-users.php"><i class="fa fa-check"></i>User verification</a>
  <a class="active" href="manage-all-users.php"><i class="fa fa-users"></i>All users</a>
  <a class="split" href="logout.php"><i class="fa fa-sign-out"></i>LOG OUT<?php session_destroy();?></a>
</div>

<center>
<h1>All users</h1>
</center>
<br><br>
<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Surname</th>
					<th>Student Number</th>
                    <th>Email</th>
                    <th>User Type</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>	
	<?php while ($row = mysqli_fetch_array($AllUsers)) {?>
		<tr>
			<td><?php echo $row['Name']; ?></td>
			<td><?php echo $row['Surname']; ?></td>
			<td><?php echo $row['StudentNum']; ?></td>
            <td><?php echo $row['Email']; ?></td>
            <td><?php echo $row['Type']; ?></td>
			<td>
				<a href="manage-users.php?change=<?php echo $row['userID']; ?>" class="edit_btn">Change to admin</a>
			</td>
		</tr>
	<?php } ?>
		</table>


    <form action="manage-all-users.php" method="POST">
	
  <!--Displays the form validation error message-->
<?php echo $output ?><br>

<label for="fname">Name</label>
<input type="text" id="fname" name="fname">

<label for="sname">Surname</label>
<input type="text" id="sname" name="sname">

<label for="stnum">Student number</label>
<input type="text" id="stnumber" name="stnum">

<label for="email">Email</label>
<input type="email" id="email" name="email">

<label for="password">Enter your password</label>
<input type="password" id="password" name="password">

<label for="cpassword">Confirm your password</label>
<input type="password" id="cpassword" name="cpassword">
<br>
<button onclick="document.location= 'manage-all-users.php'" type="submit" value="submit" name="submit">Register</button><br>
</form>

</body>
</html>