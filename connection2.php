<?php
 $host="localhost";
 $user="root";
 $pwd="root123@";
 $db="resort management system";

$conn=mysqli_connect($host,$user,$pwd,$db) or die("unable to connect");
?>

<?php
  if(isset($_POST['reg'])){
       $yourname=$_POST['yourname'];
       $mailid=$_POST['mailid'];
       $mypass=$_POST['mypass'];
       $phn=$_POST['phn'];
       $address=$_POST['address'];

     $query="insert into login(Name,Email,Pass,Mobile,Address) values('$yourname','$mailid','$mypass','$phn','$address')";

    $run=mysqli_query($conn,$query);

    if($run){
       echo "<h1>Data submitted successfully</h1>";
     }

    else{
       echo "<h1>Failed to submit data</h1>";
     }
}
?>
