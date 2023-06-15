
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
<title>booking-customer</title>
 <link rel="stylesheet" type="text/css" href="css/style.css">
<style>
body {
   background-image: url(booking.jpg);
   background-repeat: no-repeat;
   background-attachment:fixed;
   background-size:cover;
   background-position:center;
   margin-top: 10%;
   font-size: 20px;
   background: linear-gradient(rgba(255,255,255,.40), rgba(255,255,255,.40)), url(booking.jpg);
}

tr:nth-child(even) {
  background-color:  #ccccff;
}

tr:nth-child(odd) {
  background-color:  #ccccff;
}
</style>
<script src="jscript.js"></script>
  <php src="booking_table_conn.php"></php>
</head>

<body>

<center>
<fieldset>
<strong><h2><center> Room Availability </strong></h2></center><br>
<table align=center style="margin-left: 370px;">
<th>room_type</th>
<th>total_no</th>
<th>price</th>
<th>rooms_available</th>

<?php
$sql = mysqli_query($conn, "SELECT room_type,total_no,price,rooms_available FROM room ");
if (!$sql) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
while($row=mysqli_fetch_array($sql)) {
echo "<tr>";
echo "<td>". $row[0]."</td>"."<td>".$row[1]."</td>"."<td>".$row[2]."</td>"."<td>".$row[3]."</td>";
echo "</tr>";
}
?>
</table>
</fieldset>
</center>

<br>

<h2 style="border: '1 px solid #000000'; margin-left:600px;">Book now</h2>
<br>
<br>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto; margin-left:620px;;">Book now</button>

<div id="id01" class="modal1">
  
  <form class="modal-content animate" action="booking_table_conn.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="profile.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="user_id"><b>user id</b></label><br>
      <input type="number" placeholder="Enter User id" name="user_id" onkeydown="func(event)" required>
<br>
<br>
      <label for="book_date"><b>book_date</b></label><br>
      <input type="date" placeholder="Enter today's date" name="book_date"  min=<?php echo date('Y-m-d');?> required>      
<br>
<br>
      <label for="check_in_date"><b>check_in_date</b></label><br>
      <input type="date" placeholder="Enter today's date" name="check_in_date" min=<?php echo date('Y-m-d');?> required>      
<br>
<br>
      <label for="check_out_date"><b>check_out_date</b></label><br>
      <input type="date" placeholder="Enter Checkout date" name="check_out_date" min=<?php echo date('Y-m-d');?> required>      
<br>
<br>
       <label for="room_type"><b>room_type</b></label><br>
      <select name="room_type">
        <option value="-select-">-select-</option>
    <?php
      $sql = mysqli_query($conn, "SELECT room_type FROM room");
      $row = mysqli_num_rows($sql);
      while($row = mysqli_fetch_array($sql)){
            echo "<option value = '". $row['room_type'] ."'>" . $row['room_type'] . "</option>";
      }
      ?>
      </select>
<br>
<br>
      <label for="no_of_rooms"><b>number of rooms</b></label><br>
      <input type="number" placeholder="Enter number of rooms" name="no_of_rooms" onkeydown="func(event)" required>
<br>
<br>
      <button type="submit">Book now</button>
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
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
</html>