<?php
session_start();
include 'DBConn.php';
include 'create-table.php';

if (isset($_POST['addToCart'])){
	if (isset($_SESSION['cart'])){
		$session_array_id = array_column($_SESSION['cart'], "bookID");
		
		if (!in_array($_GET['bookID'], $session_array_id)){
			$session_array = array(
		 'bookID' => $_GET['bookID'],
		 "Title" => $_POST['Title'],
		 "Price" => $_POST['Price'],
		 "Quantity" => $_POST['Quantity']
		);
		
		$_SESSION['cart'][] = $session_array;
		}
	}else{
		$session_array = array(
		 'bookID' => $_GET['bookID'],
		 "Title" => $_POST['Title'],
		 "Price" => $_POST['Price'],
		 "Quantity" => $_POST['Quantity']
		);
		
		$_SESSION['cart'][] = $session_array;
	}
}
		if(isset($_POST['checkout']))
		{
			echo '<script>alert("Thank you for shopping with Book Market. Shopping cart successfully checked out. Proceed to home page and checkout.")</script>';
			echo '<script>window.location="index.php"</script>';
		} 
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="csstyling/styling.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<title>Shopping</title> 

	<style>
	body {
    font-family: Arial, Helvetica, sans-serif;
	background: linear-gradient(120deg,#d98d1c, #DFE8F0);
	}
	
	h1{
	text-align: center;
	padding-top: 15px;
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
  
  		.naviButton button{
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color:#f59542;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 17px;
       }
	</style>
</head>
<center>
<body>
<br>
<div class="pill-nav">
  <a href="index.php" >Home</a>
  <a href="sellBook.php">Sell Books</a>
  <!--<a class="split" href="logout.php"><i class="fa fa-sign-out"></i>LOG OUT<?php// session_destroy();?></a>-->
</div>
<h1>Book Market</h1>
<br>
<div class="container-fluid">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-6">
			<h2 class="text-center">Shopping Cart</h2>
			<div class="col-md-12">
				<div class="row">
				 

			
			<?php 
			
			$query = "SELECT * FROM tblbooks";
			$result = mysqli_query($conn,$query);

			if(mysqli_num_rows($result)>0){

				while ($row = mysqli_fetch_array($result)) {
				
			?>
			 <div class="col-md-4">
				<form method="POST" action="buying.php?bookID=<?=$row['bookID'] ?>" class="buyForm">
					<img src="<?= $row['Image'] ?>" style='height: 250px;'>
					<h5 class="text-center"><?= $row['Title']; ?></h5>
					<h5 class="text-center">R<?= number_format($row['Price'],2); ?></h5>
					<input type="hidden" name="Title" value="<?= $row['Title'] ?>">
					<input type="hidden" name="Price" value="<?= $row['Price'] ?>">
					<input type="number" name="Quantity" value="1" class="form-control">
					<input type="submit" name="addToCart" class="btn btn-warning btn-block my-2" value="Add To Cart">
				</form>
			 </div>
			<?php }	
			}
			?>
				</div>
			</div>
			</div>
			
			<div class="col-md-6">
				<h2 class="text-center">Item Selected</h2>
				
				<?php 
				
				 $total = 0;
				
				 $output = "";
				 
				 $output.= "
				  <table class='table table-bordered table-striped'>
				   <tr>
				    <th>ID</th>
					<th>Book Name</th>
					<th>Book Price</th>
					<th>Book Quantity</th>
					<th>Total Price</th>
					<th>Action</th>
				   </tr>
				  ";
				  
				  if (!empty($_SESSION['cart'])) {
					  
					  foreach ($_SESSION['cart'] as $key => $value) {
						  $output .= "
						   <tr>
							<td>".$value['bookID']."</td>
							<td>".$value['Title']."</td>
							<td>R".$value['Price']."</td>
							<td>".$value['Quantity']."</td>
							<td>R".number_format($value['Price'] * $value['Quantity'],2)."</td>
							<td>
								<a href='buying.php?action=remove&bookID=".$value['bookID']."'>
								 <button class='btn btn-danger btn-block'>Remove</button>
								</a>
							</td>
						   
						   
						  ";
						  
						  $total = $total + $value['Quantity'] * $value['Price'];
					  }
					  $output .= "
						<tr>
						<td colspan='3'></td>
						<td><b>Total Price</b></td>
						<td>R".number_format($total,2)."</td>
						<td>
							<a href='buying.php?action=clearall'>
							<button class='btn btn-warning btn-block'>Clear</button>
						</td>
						
						</tr>
						
					  ";
				  }
				
				echo $output;
				?>
			</div>
		</div>
	</div>
</div>

 <?php 
 
 if (isset($_GET['action'])) {
	 if ($_GET['action'] == "clearall") {
		 unset($_SESSION['cart']);
	 }  
	 
	 if ($_GET['action'] == "remove") {
		 
		 foreach ($_SESSION['cart'] as $key => $value) {
			 if ($value['bookID'] == $_GET['bookID']){
				 unset($_SESSION['cart'][$key]);
			 }
		 }
		 }
	 }
 
 
 ?>
 <div>
<form action="buying.php" method="POST">
<div class="naviButton">
<p><button name='checkout' type="submit">Check Out</button></p>
</form>
    </div>

</div>
</body>
</html>

