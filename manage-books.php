<?php
include 'book-process.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Control</title>
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
  <a class="active" href="manage-books.php"><i class="fa fa-book"></i>Manage books</a>
  <a href="manage-users.php"><i class="fa fa-check"></i>User verification</a>
  <a href="manage-all-users.php"><i class="fa fa-users"></i>All users</a>
  <a class="split" href="admin-login.php"><i class="fa fa-sign-out"></i>LOG OUT</a>


</div>
<center>
<h1>ALL BOOKS</h1>
</center>

<br><br>
<table>
			<thead>
				<tr>
					<th>Book</th>
					<th>Title</th>
					<th>Price</th>
					<th>Quantity</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>	
	<?php while ($row = mysqli_fetch_array($results)) {?>
		<tr>
			<td><?php echo $row['Image']; ?></td>
			<td><?php echo $row['Title']; ?></td>
			<td><?php echo $row['Price']; ?></td>
			<td><?php echo $row['Quantity']; ?></td>
			<td>
				<a href="manage-books.php?del=<?php echo $row['bookID']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
		</table>


		<form method= "POST" action= "book-process.php">
	<input type="hidden"  value="">
	<div class="input-group">
			<label>Image URL</label>
			<input type="text" name="Image" value="">
		</div>
		<div class="input-group">
			<label>Book Title</label>
			<input type="text" name="Title" value="">
		</div>
		<div class="input-group">
			<label>Price</label>
			<input type="text"  name="Price" value="">
		</div>
		<div class="input-group">
			<label>Quantity</label>
			<input type="text"  name="Quantity" value="">
		</div>
		<div class="input-group">
			<button class="btn" type="submit" name="save" >Save</button>
		</div>
	</form>
</body>
</html>