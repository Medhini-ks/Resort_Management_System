<?php
$user_id = $_POST['user_id'];
$book_id=$_POST['book_id'];
$item_id=$_POST['item_id'];
$item_name=$_POST['item_name'];
$quantity=$_POST['quantity'];

$conn = new mysqli('localhost','root','root123@','resort management system');
if($conn->connect_error){
die('connection failed : '.$conn->connect_error);
}
else{
$sql = "INSERT INTO food_order(user_id,book_id,item_id,item_name,quantity)
            VALUES ('$user_id','$book_id','$item_id','$item_name','$quantity')";
 

 if (mysqli_query($conn, $sql))
            {
                //Getting id of lastly inserted record'.$error.'
                $last_id = mysqli_insert_id($conn);
   
                echo '<script type="text/javascript">alert("You have successfully Ordered food")</script>';
                            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
 
            mysqli_close($conn);


           


}


?>