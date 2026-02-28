<?php 
require_once("includes/config.php");
if(!empty($_POST["NIC"])) {
  $NIC= strtoupper($_POST["NIC"]);
 
    $sql ="SELECT EmpNo,NIC,FullName,Status,EmailId,MobileNumber FROM tblstudents WHERE NIC=:NIC";
$query= $dbh -> prepare($sql);
$query-> bindParam(':NIC', $NIC, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach ($results as $result) {
if($result->Status==0)
{
echo "<span style='color:red'> NIC Blocked </span>"."<br />";
echo "<b>User Name-</b>" .$result->FullName;
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else {
?>


<?php  
echo htmlentities($result->EmpNo)."<br />";
echo htmlentities($result->FullName)."<br />";
echo htmlentities($result->EmailId)."<br />";
echo htmlentities($result->MobileNumber);
echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
 else{
  
  echo "<span style='color:red'> Invaid User NIC. Please Enter Valid User NIC .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
