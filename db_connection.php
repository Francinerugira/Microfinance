<?php 

$conn =  mysqli_connect("localhost", "root", "", "microfinance");
if ($conn) {
	# code...
	//echo "Database connection was successful";
}
else{
	echo "Database was not connected" . mysqli_error($conn);
	die($conn);
}

 ?>