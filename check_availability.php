<?php
require_once("includes/config.php");
// code user email availablity
// Check if any POST data was sent
if (!empty($_POST)) {
	// Identify which field was sent (e.g., 'email' or 'nic')
	// We assume the first key in $_POST is our fieldname
	$column = array_key_first($_POST);
	$value = $_POST[$column];

	$sql = "SELECT $column FROM tblstudents WHERE $column = :val";
	$query = $dbh->prepare($sql);
	$query->bindParam(':val', $value, PDO::PARAM_STR);
	$query->execute();

	if ($query->rowCount() > 0) {
		echo "<span style='color:red'> $column already exists.</span>";
		echo "<script>$('#submit').prop('disabled', true);</script>";
	} else {
		if ($value == "") {
			echo "<span style='color:green'> $column value empty.</span>";
			// Note: Be careful enabling the button if other fields might still be invalid
			echo "<script>$('#submit').prop('disabled', false);</script>";
		} else {
			echo "<span style='color:green'> $column available.</span>";
			// Note: Be careful enabling the button if other fields might still be invalid
			echo "<script>$('#submit').prop('disabled', false);</script>";
		}
	}
}
