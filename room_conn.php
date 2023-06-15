<?php
$room_type = $_POST['room_type'];
$total_no=$_POST['total_no'];
$price=$_POST['price'];
$rooms_available=$_POST['rooms_available'];
$conn = new mysqli('localhost','root','root123@','resort management system');
if($conn->connect_error){
die('connection failed : '.$conn->connect_error);
}
else{
$sql = "INSERT INTO room(room_type,total_no,price,rooms_available)
            VALUES ('$room_type','$total_no','$price','$rooms_available')";
 
            if (mysqli_query($conn, $sql))
            {
                //Getting id of lastly inserted record'.$error.'
                $last_id = mysqli_insert_id($conn);
   
                echo '<script type="text/javascript">alert("You have successfully entered a new room")</script>';
                header("Location: adminpage.html");               
             }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
 
            mysqli_close($conn);


}


?>