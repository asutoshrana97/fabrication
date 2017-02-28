<?php
	include('connection.php');

	$sql = "DELETE FROM status";

	$connect->query($sql);
	
	echo "success";
?>