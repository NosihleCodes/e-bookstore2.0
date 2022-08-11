<?php
include 'verify-process.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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
  <a href="manage-books.php"><i class="fa fa-book"></i>Manage books</a>
  <a class="active" href="manage-users.php"><i class="fa fa-check"></i>User verification</a>
  <a  href="manage-all-users.php"><i class="fa fa-users"></i>All users</a>
  <a class="split" href="admin-login.php"><i class="fa fa-sign-out"></i>LOG OUT</a>


</div>
<center>
<h1>Unverified users</h1>
</center>
<br><br>
<table>
			<thead>
				<tr>
					<th>St. Number</th>
					<th>Email</th>
					<th>User type</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>	
	<?php while ($row = mysqli_fetch_array($results)) {?>
		<tr>
			<td><?php echo $row['StudentNum']; ?></td>
			<td><?php echo $row['Email']; ?></td>
			<td><?php echo $row['Type']; ?></td>
			<td>
				<a href="manage-users.php?verify=<?php echo $row['userID']; ?>" class="edit_btn" >Verify</a>
			</td>
			<td>
				<a href="manage-users.php?ignore=<?php echo $row['userID']; ?>" class="del_btn">Ignore</a>
			</td>
		</tr>
	<?php } ?>
		</table>

</body>
</html>