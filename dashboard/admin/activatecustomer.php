<?php
	include('../../db_connection.php');
	$id=$_GET['id'];
	$result = $conn->prepare("UPDATE customers SET status = 'active' WHERE customer_id = :id");
	$result->bindParam(':id', $id);
	$result->execute();
?>