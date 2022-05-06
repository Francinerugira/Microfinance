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
              <li><a href="statment.php"><i class="icon-money icon-2x"></i> Statment</a> </li>  
              <li><a href="report.php"><i class="icon-bar-chart icon-2x"></i> Report</a> </li> 

			<br><br><br>
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
			<li class="active">Respond Flow</li>
			</ul>
      
          <div class="forms">
        <form method="post" action="">
            <p style="font-weight:bold; text-align:center; font-size: 22px"> Respond Flow</p><br>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <label> Amount</label>
            <input type="number" name="amount" placeholder="Amount Request" required><br><br><br>
            <button type="submit" name="save" class=""> Respond </button>
</form>
    </div>
</body>
</html>

<?php 
require_once "../../db_connection.php";

if(isset($_POST['save'])){
    $id = $_GET['id'];
    $balance = $_GET['balance'];
    $manager = $_POST['id'];
    $amount = $_POST['amount'];
    $date = date('Y-m-d H:i:s');


        $results = $conn->query("SELECT * FROM bank_balances");
        $rows = $results->fetch_assoc();
        $sum = $rows['bank_balance'];

        if($sum < $amount){
            echo '<script>
    alert(" Insufficient fund in the bank!! ");
window.location.href="flow.php";
</script>';

        }else{
            $sql = "UPDATE flows SET manager_id = ?, given_balance = ?, flow_date = ?, flow_status = ? WHERE flow_id = ?";
          if($result = mysqli_prepare($conn, $sql)){
              $status = "active";
              // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($result, "sssssi", $manager, $amount, $date, $status, $id);
          

      if(mysqli_stmt_execute($result)){
        //   $new_balance = $sum - $amount;

        // $results = $conn->prepare("UPDATE bank_balances SET bank_balance = ? WHERE bank_id = ?");
        // $id = 1;
        // $results->bind_param('si', $new_balance, $id);
        // $results->execute();
      
        // Redirect back
        echo '<script>
    alert(" Successfully Requested!! ");
window.location.href="flow.php";
</script>';
    } else{
        echo "Something went wrong. Please try again later.";
    }
    }
}
    // Close statement
    mysqli_stmt_close($result);
}
 ?>

