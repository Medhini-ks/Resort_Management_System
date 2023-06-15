<?php
session_start();
$message="";
if(count($_POST)>0) {
	$conn = mysqli_connect("localhost","root","root123@","resort management system");
	$result = mysqli_query($conn,"SELECT * FROM customer WHERE user_id='" . $_POST["user_id"] . "' and password = '". $_POST["password"]."'");
	$count  = mysqli_num_rows($result);
	if($count==0) {
		$message = "Invalid Username or Password!";
                echo '<script type="text/javascript">alert("Invalid Username or Password!")</script>';
        }
	 else {
                $user_id=$_SESSION['user_id'];
		$message = "You are successfully logged in!";
                echo '<script type="text/javascript">alert("You are successfully logged in!")</script>';
                header("Location: employee-home.html");
	}
}
?>