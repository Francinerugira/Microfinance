<?php 
include "../../db_connection.php";
$id = $_GET['id'];
$teller_id = $_GET['teller_id'];
$date = date('Y-m-d');

  $sql = "SELECT * FROM transactions WHERE teller = $teller_id AND transaction_date = '$date' AND cust_id != 'bank'"; // SQL with parameters
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  $result = $stmt->get_result(); // get the mysqli result
  // $rowcount = $result->num_rows; 
    
    $result_flow = $conn->query("SELECT * FROM flows WHERE flow_id = $id AND flow_date = '$date' AND flow_status = 'active' ");
    $rows = $result_flow->fetch_assoc();
    $rowcount = $result_flow->num_rows;
    if($rowcount >0){

      $balance = $rows['given_balance'];
    }else{
      $balance = 0;
    }

$result_credit = $conn->query("SELECT sum(amount) as sum FROM transactions WHERE teller = $teller_id AND transaction_date = '$date' AND action = 'credit' AND cust_id != 'bank' ");
$result_debit = $conn->query("SELECT sum(amount) as sum FROM transactions WHERE teller = $teller_id AND transaction_date = '$date' AND action = 'debit' AND cust_id != 'bank'");

$row = $result_credit->fetch_assoc();
$rows = $result_debit->fetch_assoc();

$sum_debit = $rows['sum'];
$sum_credit = $row['sum'];
$sum = ($balance + $sum_credit) - $sum_debit;
// echo $sum;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debit Customer</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../fontawesome/css/all.css" media="screen" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <script src="../time.js" type="text/javascript" charset="utf-8"></script>

    <style>
    body {
    background: #ffffff url(../../img/4.png)!important;
    margin: 0px;
  } 

  .forms {
    border-radius: 20px;
    position: relative;
    top: 50px;
    width: 700px;
    height: 250px;
    padding-top: 50px;
    padding-bottom: 5px;
    margin-left: 15%;
    box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
  }

  .forms label{
    font-family: verdana, "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 15px;
    font-weight: bold;
    margin-left: 50px;
    padding-top: 10px;
    color: rgb(20, 19, 19);
  }
  
  .forms input {
    color: rgba(44, 44, 44, 0.9);
    background-color: white;
    border: 1px solid white;
    width: 80%;
    margin-left: 50px;
    margin-bottom: 10px;
    font-size: 15px;
    font-weight: bold;
    border-bottom: 3px solid rgba(68, 68, 68, 0.3);
    padding-bottom: 10px;
    margin-top: 10px;
  }

  button {
    cursor: pointer;
    position: relative;
    padding: 15px;
    margin-left: 300px!important;
    font-size: 15px;
    width: 100px;
    border-radius: 10px;
    color: black;
  }

  button:hover{
      color: white;
      font-size: 18px;
      background-color: #383332;
  }

  .sidebar-nav {
    padding: 50px 0;
    
  }
</style>

</head>
<body>
    <?php include('header.php');?>
    <div class="container-fluid">
      <div class="row-fluid">
	<div class="span2"> 
          <div class="well sidebar-nav">
         <center> <img src="../../img/bank.png" alt="bank"class="rounded-circle" width="100"></center><br>
              <ul class="nav nav-list">
              
              <li><a href="managerDashboard.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li>
              <li><a href="change.php"><i class="icon-user icon-2x"></i> New Password </a></li>
              <li  class="active"><a href="flow.php"><i class="icon-user icon-2x"></i> Requested Flow </a></li>
              <li><a href="listCustomer.php"><i class="icon-group icon-2x"></i> All Customers</a> </li>  
              <li><a href="report.php"><i class="icon-bar-chart icon-2x"></i> Report</a> </li> 

			<br><br>
			<li>
			 <div class="hero-unit-clock">
		
			<form name="clock">
			<font color="white">Time: <br></font>&nbsp;<input style="width:150px;" type="submit" class="trans" name="face" value="">
			</form>
			  </div>
			</li>
				</ul>                               
          </div>
        </div>
        <div class="span10">
	<div class="contentheader">
			<i class="icon-money"></i> Flow
			</div>
			<ul class="breadcrumb">
			<li><a href="tellerDashboard.php">Dashboard</a></li> /
			<li class="active">Returned Flow</li>
			</ul>
      
          <div class="forms">
        <form method="post" action="">
            <p style="font-weight:bold; text-align:center; font-size: 22px"> Return Flow</p><br>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <label> Amount To Return</label>
            <input type="text" name="amount" value="<?php echo $sum;?>" disabled><br><br><br>
            <button type="submit" name="save" class=""> Returned </button>
</form>
    </div>
</body>
</html>

<?php 
require_once "../../db_connection.php";

if(isset($_POST['save'])){
    
       
            $sql = "UPDATE flows SET flow_status = ? WHERE flow_id = ?";
          if($result = mysqli_prepare($conn, $sql)){
              $status = "return checked";
              // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($result, "si", $status, $id);
          

      if(mysqli_stmt_execute($result)){
      
        // Redirect back
        echo '<script>
    alert(" Successfully Checked Return!! ");
window.location.href="flow.php";
</script>';
    } else{
        echo "Something went wrong. Please try again later.";
    }
    
}
    // Close statement
    mysqli_stmt_close($result);
}
 ?>

