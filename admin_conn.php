<?php
session_start();
$username = $_POST['username'];
$password=$_POST['password'];
$message="";
if(count($_POST)>0) {
	$conn = mysqli_connect("localhost","root","root123@","resort management system");
	if("$username"=="Admin" && "$password"=="root")
        {
           header("Location: adminpage.html");
        }
        else
        {
           echo '<script type="text/javascript">alert("Invalid username or password")</script>';
        }
}
?>