<html>
<head>
<link rel="stylesheet" href="css/styles.css">
<title>Sell Book</title>
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
    background-color: white;
    color: #d98d1c;
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
<center>
<div class="pill-nav">
  <a href="index.php">Home</a>
  <a href="buying.php">Buy Book</a>
    <!--<a class="split" href="logout.php"><i class="fa fa-sign-out"></i>LOG OUT<?php// session_destroy();?></a>-->
</div>

<div class="sellBox">

<h1>Sell Book</h1> 
<form action="" method="POST">

	<label for="Name">Title</label>
  <input type="text" id="Name" name="Name">
	
	<label for="Surname">Author</label>
  <input type="text" id="Surname" name="Surname">
  
    <label for="Image">Select Image File:</label>
    <input type="file" id="image" name="image">

<br>
  <button type="submit" value="submit" name="submit" onclick="return confirm('Information sent to admin.')">Submit</button><br>
</form>
</div>
</center>
</body>
</html>