<?php

session_start();
if(!isset($_SESSION['Email'])){
    header("location:user-login.php");
}

if(isset($_POST['submit']))
{
    header("location:user-login.php");
    
    unset($_SESSION['Email']);  
    session_destroy(); 
}

if(isset($_POST['shop']))
{
    header("location:buying.php");
    
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

    <title>Book Market</title>
	<style>
	body {
    font-family: Arial, Helvetica, sans-serif;
	background: linear-gradient(120deg,#d98d1c, #DFE8F0);
	}
	
	.buttons button{
		border: 2px solid #f59542;
        border-radius: 25px;
        outline: 0;
        padding: 12px;
        color: #f59542;
        background-color: white;
        text-align: center;
        cursor: pointer;
        width: 10%;
        font-size: 17px;
    }
	
	.buttons{
		margin-top: 10%;
		margin-bottom: 20%;
	}
	</style>
</head>
<body>
<center>
<h1>Welcome</h1>

<b><?php echo $_SESSION['Email']; ?></b>

        <form method="post">
		<div class="buttons">
            <button name='shop' type="submit">Go Shopping!</button>
			<br><br>
            <button name='submit' type="submit">Log Out</button>
		</div>
        </form>

</center>


</body>
</html>