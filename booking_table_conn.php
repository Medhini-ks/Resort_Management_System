<?php
session_start();
$user_id = $_POST['user_id'];
$book_date=$_POST['book_date'];
$check_in_date=$_POST['check_in_date'];
$check_out_date=$_POST['check_out_date'];
$room_type=$_POST['room_type'];
$no_of_rooms=$_POST['no_of_rooms'];



$conn = new mysqli('localhost','root','root123@','resort management system');
if($conn->connect_error){
die('connection failed : '.$conn->connect_error);
}
else { 
        $sql="SELECT rooms_available FROM room 
		WHERE room.room_type='$room_type'";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
	while($row=$result->fetch_assoc())
	{
	$rooms_available=$row["rooms_available"];
	}
	}
	if($rooms_available!=0)
	{
	if($rooms_available-$no_of_rooms>0)
        {
	 $sql1 = "INSERT INTO booking(user_id,room_type,no_of_rooms,check_in_date,check_out_date,book_date)
              	 VALUES ('$user_id','$room_type','$no_of_rooms','$check_in_date','$check_out_date','$book_data')";

	   if (mysqli_query($conn, $sql1))
           {
              //Getting id of lastly inserted record'.$error.'
              $last_id = mysqli_insert_id($conn);
   
   	      echo '<script type="text/javascript">alert("Booking successful!")</script>';
        	     header("Location: booking.php");                
           }

           else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        }
	}
       
       
     }
           mysqli_close($conn); 

?>