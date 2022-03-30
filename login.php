<?php  

require_once "db_connection.php";

if (isset($_POST['login'])) {
	$email = trim($_POST['email']);
	$pass = trim($_POST['password']);

	
	$sql = "SELECT * FROM staffs WHERE email =?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$rows = $result->fetch_assoc();

	if(password_verify($pass, $rows['password'])){

		session_start();
		$_SESSION['email'] = $rows['email'];
		$_SESSION['role']     = $rows['role'];
		$email= $_SESSION['email'];
		session_write_close();

		if ($result->num_rows == 1 && $rows['role'] == "admin") {
			header("location: dashboard/admin/adminDashboard.php");
		} 
   
		elseif ($result->num_rows == 1 && $rows['role'] == "manager") {
		   header("location: dashboard/manager/managerDashboard.php");
	   } 
   
	   elseif ($result->num_rows == 1 && $rows['role'] == "teller") {
		   header("location: dashboard/teller/tellerDashboard.php");
	   } 
		else{
   
			echo '<script>
			alert(" Sorry... Email or Password  is incorrect");
		   window.location.href="index.php";
		 </script>';
		}
	}else{
		echo '<script>
			alert(" Sorry... Password is incorrect");
		   window.location.href="index.php";
		 </script>';	
	}

}
?>