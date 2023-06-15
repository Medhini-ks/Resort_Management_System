<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "root123@";
$dbname = "resort management system";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 600px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>

<title>order food</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<style>
  body {
   background-image: url(food.jpg);
   background-repeat: no-repeat;
   background-attachment:fixed;
   background-size:cover;
   background-position:center;
   font-size: 20px;
   color: #000000;
 }

table {
  border-collapse: collapse;
  width: 95%;
  border-left: 20 px
}

td, th {
  border: 1px solid #000000;
  text-align: left;
  padding: 8px;
}

</style>

<script src="jscript.js"></script>
</head>
<body>

<div class="row">
  <div class="column">
    <center>
	
        <h2><strong> Food menu </strong></h2>
	<table align=left style="margin-left: 30px;">
	<th>item_id</th>
	<th>item_name</th>
	<th>price</th>

	<?php
	$sql = mysqli_query($conn, "SELECT item_id,item_name,price FROM restaurant ");
	if (!$sql) {
    		printf("Error: %s\n", mysqli_error($conn));
    		exit();
	}
	while($row=mysqli_fetch_array($sql)) {
		echo "<tr>";
		echo "<td>". $row[0]."</td>"."<td>".$row[1]."</td>"."<td>".$row[2]."</td>";
		echo "</tr>";
	}
	?>
	</table>
	
   </center>
   </div>



  <div class="column">
    <h2>Order now !</h2>
    <center>

<br>
<br>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;background-color:red;">Order</button>

<div id="id01" class="modal1">
  
  <form class="modal-content animate" action="food_order.php" href="bookingsuccessfulmessage.html" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="profile.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="user_id"><b>user id</b></label><br>
      <input type="number" placeholder="Enter User id" name="user_id" onkeydown="func(event)" required>
<br>
<br>
      <label for="book_id"><b>book id</b></label><br>
      <input type="number" placeholder="Enter book id" name="book_id" onkeydown="func(event)" required>
<br>
<br>     
      <label for="item_id"><b>item id</b></label><br>
      <input type="number" placeholder="Enter Item id" name="item_id" onkeydown="func(event)" required>
<br>
<br>
       <label for="item_name"><b>item_name</b></label><br>
      <select name="item_name">
    <option value="-select-">-select-</option>
    <?php
      $sql = mysqli_query($conn, "SELECT item_id,item_name FROM restaurant");
      $row = mysqli_num_rows($sql);
      while($row = mysqli_fetch_array($sql)){
            echo "<option value = '". $row['item_id'] ."'>" . $row['item_name'] . "</option>";
      }
      ?>
      </select>
<br>
<br>
      <label for="quantity"><b>quantity</b></label><br>
      <input type="number" placeholder="Enter Quantity" name="quantity" onkeydown="func(event)" required>
<br>
<br>      
      <button type="submit">Order</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</center>
  </div>
</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
  
</html>