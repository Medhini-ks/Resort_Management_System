<?php
$username = $_POST['username'];
$password=$_POST['password'];
$gender=$_POST['gender'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$conn = new mysqli('localhost','root','root123@','resort management system');
if($conn->connect_error){
die('connection failed : '.$conn->connect_error);
}
else{
$sql = "INSERT INTO customer(username,password,gender,address,phone_number,email)
            VALUES ('$username','$password','$gender','$address','$phone','$email')";
 
            if (mysqli_query($conn, $sql))
            {
                //Getting id of lastly inserted record'.$error.'
                $last_id = mysqli_insert_id($conn);
   
                echo '<script type="text/javascript">alert("You have successfully logged in")</script>';
                            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
 
            mysqli_close($conn);


}


?>