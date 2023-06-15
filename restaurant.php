<?php
$servername = "localhost";
$username = "root";
$password = "root123@";
$dbname = "resort management system";
$conn = new mysqli('localhost','root','root123@','resort management system');
if($conn->connect_error){
die('connection failed : '.$conn->connect_error);
}         
$sql = "SELECT * FROM restaurant";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "item_id: " . $row["item_id"]. " - item_name: " . $row["item_name"]. " -price " . $row["price"] . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>