<?php 
require_once("includes/config.php");
//code check email
if(!empty($_POST["booknu"])) {
$booknu=$_POST["booknu"];
$sql ="SELECT id FROM tblbooks WHERE BookNu=:booknu";
$query= $dbh -> prepare($sql);
$query-> bindParam(':booknu', $booknu, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
 
if($query -> rowCount() > 0){
echo "<span style='color:red'> Book Number already exists with another book. .</span>"; 
echo "<script>$('#add').prop('disabled',true);</script>";
} else { echo "<script>$('#add').prop('disabled',false);</script>";}
}