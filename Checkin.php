<?php
$user_id = $_POST['user_id'];
$book_id=$_POST['book_id'];
$adult_count=$_POST['adult_count'];
$children_count=$_POST['children_count'];
$advance_amount=$_POST['advance_amount'];

$conn = new mysqli('localhost','root','root123@','resort management system');
if($conn->connect_error){
die('connection failed : '.$conn->connect_error);
}
else{
$sql = "INSERT INTO check_in(user_id,book_id,adult_count,children_count,advance_amount)
            VALUES ('$user_id','$book_id','$adult_count','$children_count','$advance_amount')";
 

 

 if (mysqli_query($conn, $sql))
            {
       
                $last_id = mysqli_insert_id($conn);
   
                echo '<script type="text/javascript">alert("You have successfully Checked in")</script>';
                            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
 
            mysqli_close($conn);


           


}


?>