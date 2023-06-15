<html>
<body>
<?php
$conn = new mysqli('localhost','root','root123@','resort management system');
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "DB Connected successfully";
} 

mysqli_select_db($conn,"resort management system");
echo "\n DB is seleted as Test  successfully"; 
$sql="INSERT INTO customer(user_id,username,password,re-enter password,gender,DOB,address,phone,email) VALUES ('$_POST[user_id]','$_POST[username]','$_POST[password]','$_POST[re-enter password]','$_POST[gender]','$_POST[DOB]','$_POST[address]','$_POST[phone]','$_POST[email]')";
 
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
?>
</body>
</html>