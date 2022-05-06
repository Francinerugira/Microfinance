<?php 
require_once "../../db_connection.php";
include('header.php');
$date = date('Y-m-d');
$sql = "SELECT * FROM flows WHERE teller_id = '$id' AND flow_date = '$date' "; // SQL with parameters
$stmt = $conn->prepare($sql); 
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$rowcount = $result->num_rows;

if($rowcount > 0){
  $r = $result->fetch_assoc();
  $balance = $r['given_balance'];
}else{
  $balance = 0;
}


$result_credit = $conn->query("SELECT sum(amount) as sum FROM transactions WHERE teller = $id AND transaction_date = '$date' AND action = 'credit' AND cust_id != 'bank' ");
$result_debit = $conn->query("SELECT sum(amount) as sum FROM transactions WHERE teller = $id AND transaction_date = '$date'  AND action = 'debit' AND cust_id != 'bank'");

$row = $result_credit->fetch_assoc();
$rows = $result_debit->fetch_assoc();

$sum_debit = $rows['sum'];
$sum_credit = $row['sum'];
$new_sum = ($balance + $sum_credit) - $sum_debit;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<title>balance</title>

<script src="../js/jeffartagame.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/application.js" type="text/javascript" charset="utf-8"></script>
<script src="../lib/jquery.js" type="text/javascript"></script>
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../fontawesome/css/all.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/font-awesome.min.css">
<script src="../time.js" type="text/javascript" charset="utf-8"></script>

    
    <style>
    body {
    background: #ffffff url(../../img/4.png)!important;
    margin: 0px;
  } 
  .sidebar-nav {
    padding: 50px 0;
  }
  .view{
      background-color: #383332!important;
  }
  th, td{
      text-align: center;
  }
  </style>

</style>
 
</head>
<body>

    <div class="container-fluid">
      <div class="row-fluid">
	<div class="span2"> 
          <div class="well sidebar-nav">
         <!-- <center> <img src="../../img/bank.png" alt="bank"class="rounded-circle" width="100"></center><br> -->
              <ul class="nav nav-list">
              
              <li><a href="tellerDashboard.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
              <li><a href="change.php"><i class="icon-user icon-2x"></i>	New Password</a></li>
              <li  class="active"><a href="balance.php"><i class="icon-money icon-2x"></i>	Balance</a></li>
              <li><a href="transaction.php"><i class="icon-money icon-2x"></i>	View transaction</a></li>
              <li><a href="customer.php"><i class="icon-plus-sign icon-2x"></i> Add Customer</a>  </li> 
              <li><a href="credit.php"><i class="icon-money icon-2x"></i> Deposit</a>  </li>  
              <li ><a href="debit.php"><i class="icon-money icon-2x"></i> Withdraw</a>  </li> 
              <li ><a href="statment.php"><i class="icon-money icon-2x"></i> Statment</a>  </li> 
              <li><a href="listCustomer.php"><i class="icon-group icon-2x"></i> All Customers</a> </li> 

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
			<i class="icon-money"></i> Balance
			</div>
			<ul class="breadcrumb">
			<li><a href="tellerDashboard.php">Dashboard</a></li> /
			<li class="active">Balance</li>
			</ul>

      
<div style="text-align:center;">
			Total Number of Flow:  <font color="green" style="font-weight:bold ;">[<?php echo $rowcount;?>]</font>
			</div>
      <br>
<input type="text" style="padding:10px; width: 50%" name="filter"  id="filter" placeholder="Search flow..." autocomplete="off" />
<a href="flow.php"><button type="button" class="btn btn-info" style="float: right;"> <i class="icon icon-plus icon-large"></i> Request Cash Flow</button></a>
<br><br><br>
    <table class="table table-bordered" id="resultTable" data-responsive="table">
        <tr>
            <thead>
                <th> SNo </th>
                <th>Date</th>
                <th>Given Cash Flow </th>
                <th>Balance </th>
                <th>Status</th>
                <th>Action </th>
            </thead>
        </tr>
        <tbody>
            <?php
             $i = 0;
             $sql = "SELECT * FROM flows WHERE teller_id = '$id' "; // SQL with parameters
             $stmt = $conn->prepare($sql); 
             $stmt->execute();
             $result = $stmt->get_result(); // get the mysqli result
             $rowcount = $result->num_rows;
             $sum = 0;
             
            while($row = $result->fetch_assoc()){
               $i ++;
                ?>
            <tr>
                <td> <?php echo $i;?> </td>
                <td> <?php echo $row['flow_date'];?></td>
                <td> <?php echo $row['given_balance'];?></td>
                <?php
                if($row['flow_status'] == 'active'){
                  ?>
                  <td> <?php echo $new_sum;?></td>
                  <?php
                }else{
                  ?>
                  <td> <?php echo $sum;?></td>
                  <?php
                }
                ?>
                <td> <?php echo $row['flow_status'];?></td>
                <?php 
                if($row['flow_status'] == 'Requested'){
                  ?>
                  <td> Wait For Respond</td>
                  <?php
                }elseif($row['flow_status'] == 'active'){
                  ?>
                  <td> <a class="btn view" href="return.php?id=<?php echo $row['flow_id']?>&teller_id=<?php echo $row['teller_id'];?>"> Check returned cash flow</a></td>
                  <?php
                }else{
                  ?>
                  <td> Already Return Cash flow</td>
                  <?php
                }
                ?>
            </tr>
            <?php
            }
            ?>
            </div></div></div>
</table>
</body>
</html>