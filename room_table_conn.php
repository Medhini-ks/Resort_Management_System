<?php
$servername = "localhost";
$username = "root";
$password = "root123@";
$dbname = "resort management system";

$conn = new mysqli('localhost','root','root123@','resort management system');
if($conn->connect_error){
die('connection failed : '.$conn->connect_error);
}
else{
$sql = "SELECT room_type,total_no,price,rooms_available FROM room";
 
if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["room_type"]. " - total_no: " . $row["total_no"]. " -price: " . $row["price"]. " -rooms_available: " . $row["rooms_available"]. "<br><br>;
   }
} 
 else {
    echo "0 results";
}          
 mysqli_close($conn);
?>
