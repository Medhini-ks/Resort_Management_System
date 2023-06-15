<?php
$servername = "localhost";
$username = "root";
$password = "root123@";
$dbname = "resort management system";
$conn = new mysqli('localhost','root','root123@','resort management system');
if($conn->connect_error){
die('connection failed : '.$conn->connect_error);
}         
$sql = "SELECT * FROM room";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "room_type: " . $row["room_type"]. " - total_no: " . $row["total_no"]. " -price " . $row["price"]. " -rooms_available " . $row["rooms_available"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>