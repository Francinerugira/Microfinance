<?php
require "../../db_connection.php";

$id = $_GET['id'];

$sql_cr = "SELECT *  FROM transactions WHERE cust_id = '$id'  ";
$result_cre = mysqli_query($conn, $sql_cr);

$sql_cr = "SELECT * FROM transactions WHERE cust_id = ?"; // SQL with parameters
$stmt_cr = $conn->prepare($sql_cr); 
$stmt_cr->bind_param("i", $id);
$stmt_cr->execute();
$result_cre = $stmt_cr->get_result(); // get the mysqli result


// Total credit in this account
$sql_credit = "SELECT SUM(amount) as sum  FROM customers INNER JOIN transactions ON transactions.cust_id = customers.customer_id WHERE customer_id = ? AND action = ? ";
$action = 'credit';
$stmt_credit = $conn->prepare($sql_credit); 
$stmt_credit->bind_param("ss", $id,$action);
$stmt_credit->execute();
$res_credit = $stmt_credit->get_result();
$row = $res_credit->fetch_assoc();
$credit = $row['sum'];
if($credit == ""){
    $credit = 0;
}

// Total debited in this account

$sql_debit = "SELECT SUM(amount) as sum  FROM customers INNER JOIN transactions ON transactions.cust_id = customers.customer_id WHERE customer_id = ? AND action = ?  ";
$debit_action = 'debit';
$stmt_debit = $conn->prepare($sql_debit); 
$stmt_debit->bind_param("ss", $id,$debit_action);
$stmt_debit->execute();
$res_debit = $stmt_debit->get_result();
$row = $res_debit->fetch_assoc();
$debit = $row['sum'];

if($debit == ""){
    $debit = 0;
}

// Total balance in account
$balance = $credit - $debit;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>

    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../fontawesome/css/all.css" media="screen" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <script src="../time.js" type="text/javascript" charset="utf-8"></script>


    <style>
    body {
    background: #ffffff url(../../img/4.png)!important;
    margin: 0px;
    }
    .content{
        border-radius: 15px;
        position: relative;
        width: auto;
        height: auto;
        padding-top: 30px;
        padding-bottom: 5px;
        margin-left: 5%;
        margin-right: 10%;
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);

  }
    .content table{
        width: 85%;
        margin-left: 100px;
      }    
      .sidebar-nav {
    padding: 50px 0;
  }
  </style>

</style>

</head>
<body>
<?php include('header.php');?>
    <div class="container-fluid">
      <div class="row-fluid">
	<div class="span2"> 
          <div class="well sidebar-nav">
         <!-- <center> <img src="../../img/bank.png" alt="bank"class="rounded-circle" width="100"></center><br> -->
              <ul class="nav nav-list">
              
              <li><a href="tellerDashboard.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
              <li><a href="change.php"><i class="icon-user icon-2x"></i>	New Password</a></li>
              <li><a href="balance.php"><i class="icon-money icon-2x"></i>	Balance</a></li>
              <li><a href="flow.php"><i class="icon-money icon-2x"></i>	Request Flow</a></li>
              <li><a href="transaction.php"><i class="icon-money icon-2x"></i>	View transaction</a></li>
              <li><a href="customer.php"><i class="icon-plus-sign icon-2x"></i> Add Customer</a>  </li> 
              <li><a href="credit.php"><i class="icon-money icon-2x"></i> Deposit</a>  </li>  
              <li ><a href="debit.php"><i class="icon-money icon-2x"></i> Withdraw</a>  </li> 
              <li  class="active"><a href="statment.php"><i class="icon-money icon-2x"></i> Statment</a>  </li> 
              <li><a href="listCustomer.php"><i class="icon-group icon-2x"></i> All Customers</a> </li>    

			<br>
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
			<i class="icon-table"></i> Customers
			</div>
			<ul class="breadcrumb">
			<li><a href="adminDashboard.php">Dashboard</a></li> /
			<li class="active">Customer Details</li>
			</ul>
      <div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="statment.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
</div>
<div class="content">
<u><p style="font-weight:bold; text-align:center; font-size: 22px"> Record about Credit</p></u><br>
<table class="table table-bordered" id="resultTable" data-responsive="table">
    <thead>
        <tr>
        <th>Date</th>
        <th> Action</th>
        <th> Amount </th>
        <th> Description</th>
</tr>
</thead>
<tbody>
    <?php 
        while($ro = $result_cre->fetch_assoc()){
            ?>
            <tr>
        <td><?php echo $ro['transaction_date'];?></td>
        <td><?php echo $ro['action'];?></td>
        <td><?php echo $ro['amount'];?></td>
        <td><?php echo $ro['description'];?></td>
</tr>
<?php
        }
        ?>
        </tbody>
</table><hr><br>

  <label style="font-size:19px"> Total Debited : <?php echo $debit;?> RWF</label>
  <label style="font-size:19px"> Total Credited : <?php echo $credit;?> RWF</label><hr>
  <label style="font-size:22px"> Balance: <?php echo $balance;?> RWF</label>
</div>
                         
</body>
</html>