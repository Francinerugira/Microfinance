<?php 
require_once "../../db_connection.php";
include('header.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<title>Customers Lists</title>

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
              <ul class="nav nav-list">
              
              <li><a href="tellerDashboard.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
              <li><a href="change.php"><i class="icon-user icon-2x"></i>	New Password</a></li>
              <li><a href="balance.php"><i class="icon-money icon-2x"></i>	Balance</a></li>
              <li class="active"><a href="transaction.php"><i class="icon-money icon-2x"></i>	View transaction</a></li>
              <li><a href="customer.php"><i class="icon-plus-sign icon-2x"></i> Add Customer</a>  </li> 
              <li><a href="credit.php"><i class="icon-money icon-2x"></i> Deposit</a>  </li>  
              <li ><a href="debit.php"><i class="icon-money icon-2x"></i> Withdraw</a>  </li> 
              <li ><a href="statment.php"><i class="icon-money icon-2x"></i> Statment</a>  </li> 
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
			<i class="icon-money"></i> Transactions
			</div>
			<ul class="breadcrumb">
			<li><a href="tellerDashboard.php">Dashboard</a></li> /
			<li class="active">All Transactions</li>
			</ul>

      
<div style="text-align:center;">
			<!-- Total Number of Transactions:  <font color="green" style="font-weight:bold ;">[<?php echo $rowcount;?>]</font> -->
			</div>
      <br>
      <form action="transaction.php" method="POST">
<!-- <center><strong>From : <input type="date" style="width: 223px; padding:14px;" name="date1" class="tcal" value="" /> To: <input type="date" style="width: 223px; padding:14px;" name="date2" class="tcal" value="" />
 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit"><i class="icon icon-search icon-large"></i> Search</button> -->
 

</strong></center>
</form>

<div class="content" id="content">
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
<?php
// if(!isset($_POST['date1']) && !isset($_POST['date2'])){
    ?>
    <!-- All Transactions  -->
    <?php
// }else{
?>
<!-- Transactions from&nbsp;<?php echo $_POST['date1'] ?>&nbsp;to&nbsp;<?php echo $_POST['date2'] ?> -->
<?php 
// }
?>
</div>
<input type="text" style="padding:10px; width: 50%" name="filter"  id="filter" placeholder="Search transaction..." autocomplete="off" />

    <table class="table table-bordered" id="resultTable" data-responsive="table">
        <tr>
            <thead>
                <th> SNo </th>
                <th>Date </th>
                <th>Action Done </th>
                <th>Description </th>
                <th>Amount </th>
            </thead>
        </tr>
        <tbody>
        <?php 
        $date = date('Y-m-d');
        

				            $result = $conn->query("SELECT * FROM transactions WHERE teller = $id AND cust_id != 'bank' AND transaction_date = '$date' ");
                    
                    $result_flow = $conn->query("SELECT * FROM flows WHERE teller_id = $id AND flow_date = '$date' AND flow_status = 'active' ");
                    $rows = $result_flow->fetch_assoc();
                    $rowcount = $result_flow->num_rows;
                    if($rowcount >0){

                      $balance = $rows['given_balance'];
                    }else{
                      $balance = 0;
                    }
                  

				
				for($i=1; $rows = $result->fetch_assoc(); $i++){
			?>
            
            <tr>
                <td> <?php echo $i;?> </td>
                <td> <?php echo $rows['transaction_date'];?></td>
                <td> <?php echo $rows['action'];?></td>
                <td> <?php echo $rows['description'];?></td>
                <td> <?php echo $rows['amount'];?></td>
                
            </tr>
            <?php
            }
            ?>
            <thead>
            <tr>
            
                <th colspan="3" style="border-top:1px solid #999999"> Given cash flow Balance: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
			<?php
                    $result_flow = $conn->query("SELECT sum(given_balance) as sum FROM flows WHERE teller_id = $id AND flow_date = '$date' AND flow_status = 'active' ");

                    $row = $result_flow->fetch_assoc();

                    $sum_flow = $row['sum'];
                    echo "starting cash flow";
                    echo '<td>'.$sum_flow;'</td>'

				?>
			</th>
		
				</th>
		</tr>
		<tr>
			<th colspan="4" style="border-top:1px solid #999999"> My Balance: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
			<?php
                    $result_credit = $conn->query("SELECT sum(amount) as sum FROM transactions WHERE teller = $id AND transaction_date = '$date' AND action = 'credit' AND cust_id != 'bank' ");
                    $result_debit = $conn->query("SELECT sum(amount) as sum FROM transactions WHERE teller = $id AND transaction_date = '$date' AND action = 'debit' AND cust_id != 'bank'");

                    $row = $result_credit->fetch_assoc();
                    $rows = $result_debit->fetch_assoc();

                    $sum_debit = $rows['sum'];
                    $sum_credit = $row['sum'];
                    $sum = $balance + $sum_credit - $sum_debit;
				echo $sum;
				?>
			</th>
		
				</th>
		</tr>
			

    
            </div></div></div>
</table>
</body>
</html>