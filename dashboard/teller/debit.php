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
    height: 420px;
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
              <ul class="nav nav-list">
              
              <li><a href="tellerDashboard.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
              <li><a href="change.php"><i class="icon-user icon-2x"></i>	New Password</a></li>
              <li><a href="balance.php"><i class="icon-money icon-2x"></i>	Balance</a></li>
              <li><a href="transaction.php"><i class="icon-money icon-2x"></i>	View transaction</a></li>
              <li><a href="customer.php"><i class="icon-plus-sign icon-2x"></i> Add Customer</a>  </li> 
              <li><a href="credit.php"><i class="icon-money icon-2x"></i> Deposit</a>  </li>  
              <li class="active"><a href="debit.php"><i class="icon-money icon-2x"></i> Withdraw</a>  </li> 
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
			<i class="icon-money"></i> Debit
			</div>
			<ul class="breadcrumb">
			<li><a href="tellerDashboard.php">Dashboard</a></li> /
			<li class="active">Debit Customer</li>
			</ul>
      <form action="debit.php" method="get">
          <strong><input type="text" style="width: 400px; padding:10px;" name="search" placeholder="Search by national id or phone number ....." class="tcal" value="" />
          <button class="btn btn-info"  style="width: 123px; height:35px; margin-top:-8px;margin-left:0px;" type="submit"><i class="icon icon-search icon-large"></i> Search</button>
 
      </strong>
      </form>
      
        <?php 
        require "../../db_connection.php";
        if(isset($_GET['search'])){
          $search = $_GET['search'];
          $sql = "SELECT * FROM customers WHERE phone_number = '$search' OR national_id = '$search'" ; // SQL with parameters
          $stmt = $conn->prepare($sql); 
          $stmt->execute();
          $result = $stmt->get_result(); // get the mysqli result
          $rowcount = $result->num_rows;

          // Total credit in this account
          $sql_credit = "SELECT SUM(amount) as sum  FROM customers INNER JOIN transactions ON transactions.cust_id = customers.customer_id WHERE (phone_number = ? OR national_id = ?) AND action = ? ";
          $action = 'credit';
          $stmt_credit = $conn->prepare($sql_credit); 
          $stmt_credit->bind_param("sss", $search,$search,$action);
          $stmt_credit->execute();
          $res_credit = $stmt_credit->get_result();
          $row = $res_credit->fetch_assoc();
          $credit = $row['sum'];

          // Total debited in this account

          $sql_debit = "SELECT SUM(amount) as sum  FROM customers INNER JOIN transactions ON transactions.cust_id = customers.customer_id WHERE (phone_number = ? OR national_id = ?) AND action = ?  ";
          $debit_action = 'debit';
          $stmt_debit = $conn->prepare($sql_debit); 
          $stmt_debit->bind_param("sss", $search,$search,$debit_action);
          $stmt_debit->execute();
          $res_debit = $stmt_debit->get_result();
          $row = $res_debit->fetch_assoc();
          $debit = $row['sum'];

// Total balance in account
$balance = $credit - $debit;
        
          ?>
          <div class="details">
        <form method="post" action="saveCredit.php">
        <table class="table " id="resultTable" data-responsive="table">
        <tr>
            <thead>
                <th>Customer Name </th>
                <th>Account Number </th>
                <th>Type Of account </th>
                <th>Account Status </th>
                <th> Balance </th>
            </thead>
        </tr>
        <tbody>
            <?php
            while($rows = $result->fetch_assoc()){
                ?>
            <tr>
                <td> <?php echo $rows['first_name']. " ".$rows['last_name'];?></td>
                <td> <?php echo $rows['account_number'];?></td>
                <td> <?php echo $rows['type_of_account'];?></td>
                <td> <?php echo $rows['status'];?></td>
                <td> <?php echo $balance;?></td>
                
            </tr>
            <?php
            }
            ?>
            </div></div></div>
</table>
    </div>
    <div class="forms">
        <form method="post" action="saveDebit.php">
            <p style="font-weight:bold; text-align:center; font-size: 22px"> Debit Details</p><br>
            <label> Account Number</label>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="type" value="debit">
            <input type="number" name="account" placeholder="Account Number" required>
            <label> Amount</label>
            <input type="number" name="amount" placeholder="Amount Credited" required>
            <label> Description</label>
            <textarea  name="description" placeholder="Description" style="margin-left: 50px;width: 80%;" required></textarea><br><br>
            <button type="submit" name="save" class=""> Withdraw </button>
</form>
    </div>
    <?php 
        }else{
          ?>
          <div class="forms">
        <form method="post" action="saveDebit.php">
            <p style="font-weight:bold; text-align:center; font-size: 22px"> Debit Details</p><br>
            <label> Account Number</label>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="type" value="debit">
            <input type="number" name="account" placeholder="Account Number" required>
            <label> Amount</label>
            <input type="number" name="amount" placeholder="Amount Credited" required>
            <label> Description</label>
            <textarea  name="description" placeholder="Description" style="margin-left: 50px;width: 80%;" required></textarea><br><br>
            <button type="submit" name="save" class=""> Withdraw </button>
</form>
    </div>
    <?php
        }
        ?>
</body>
</html>

