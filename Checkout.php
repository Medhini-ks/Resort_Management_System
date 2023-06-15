<?php
$user_id = $_POST['user_id'];
$book_id=$_POST['book_id'];
$host='localhost';
$dbname='resort management system';
$username='root';
$password='root123@';
$conn = new mysqli('localhost','root','root123@','resort management system');
if($conn->connect_error){
die('connection failed : '.$conn->connect_error);
}
else{
$sql = "INSERT INTO check_out(user_id,book_id)
            VALUES ('$user_id','$book_id')";
 

 if (mysqli_query($conn, $sql))
            {   
                //Getting id of lastly inserted record'.$error.'
                $last_id = mysqli_insert_id($conn);

                       // calling stored procedure command
                      $sql = mysqli_query($conn,"CALL room_bill($user_id);");
                      $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                      // prepare for execution of the stored procedure
                      $stmt = $pdo->prepare($sql);
 
 
                    



                       // calling stored procedure command
                      $sql = mysqli_query($conn,"CALL food_bill($user_id);");
 
                      // prepare for execution of the stored procedure
                      $stmt = $pdo->prepare($sql);
 
                      



                       // calling stored procedure command
                      $sql = mysqli_query($conn,"CALL total_bill()");
 
                      // prepare for execution of the stored procedure
                      $stmt = $pdo->prepare($sql);
                      $sql="SELECT total from check_out WHERE user_id=$user_id";
		      $result=$conn->query($sql);
		      if ($result->num_rows>0)
		      {
			while($row=$result->fetch_assoc())
			{
			 $total=$row["total"];
			 echo $total;
			}
			}
                echo '<script type="text/javascript">';
	            echo 'alert("You have successfully Checked out and total bill is")';
		echo '</script>';
                            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
 
            mysqli_close($conn);


           


}


?>