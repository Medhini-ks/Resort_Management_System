<?php
$item_name = $_POST['item_name'];
$price=$_POST['price'];

$conn = new mysqli('localhost','root','root123@','resort management system');
if($conn->connect_error){
die('connection failed : '.$conn->connect_error);
}
else{
$sql = "INSERT INTO restaurant(item_name,price)
            VALUES ('$item_name','$price')";
 
            if (mysqli_query($conn, $sql))
            {
                //Getting id of lastly inserted record'.$error.'
                $last_id = mysqli_insert_id($conn);
   
                echo '<script type="text/javascript">alert("You have successfully added a food item!")</script>';
                header("Location:adminpage.html");               
             }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
 
            mysqli_close($conn);


}


?>