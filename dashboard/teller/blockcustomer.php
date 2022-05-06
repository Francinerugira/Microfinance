<?php
require_once "../../db_connection.php";
    $id=$_GET['id'];
	$result = $conn->prepare("UPDATE customers SET status = ? WHERE customer_id = ? ");
	$status = 'broken';
	$result->bind_param('si', $status, $id);
	$result->execute();

?>