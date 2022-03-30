<?php
require "../../db_connection.php";
$id = $_GET['id'];

$sql = "SELECT * FROM customers WHERE customer_id = ?"; // SQL with parameters
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$rows = $result->fetch_assoc(); // fetch data  
$image = $rows['profile_photo'];
$scr = "../../Upload/".$image;

// Total credit in this account
$sql_credit = "SELECT SUM(amount) as sum  FROM customers INNER JOIN transactions ON transactions.cust_id = customers.customer_id WHERE customer_id = ? AND action = ? ";
$action = 'credit';
$stmt_credit = $conn->prepare($sql_credit); 
$stmt_credit->bind_param("ss", $id,$action);
$stmt_credit->execute();
$res_credit = $stmt_credit->get_result();
$row = $res_credit->fetch_assoc();
$credit = $row['sum'];

// Total debited in this account

$sql_debit = "SELECT SUM(amount) as sum  FROM customers INNER JOIN transactions ON transactions.cust_id = customers.customer_id WHERE customer_id = ? AND action = ?  ";
$debit_action = 'debit';
$stmt_debit = $conn->prepare($sql_debit); 
$stmt_debit->bind_param("ss", $id,$debit_action);
$stmt_debit->execute();
$res_debit = $stmt_debit->get_result();
$row = $res_debit->fetch_assoc();
$debit = $row['sum'];


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
  </style>

    <style>
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
    .content label{
      padding-top:5px;
      padding-bottom:5px;
      padding-left:50px;
      padding-right:50px;
      margin:0px;
      font-weight: bold;
      color: black;
      font-size:16px;
      display: inline-block;
      width: 265px;
      height: 35px;
      text-align: center;
      margin-bottom: 5px;
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
         <center> <img src="../../img/bank.png" alt="bank"class="rounded-circle" width="100"></center><br>
              <ul class="nav nav-list">
              
              <li><a href="managerDashboard.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li>
              <li><a href="change.php"><i class="icon-user icon-2x"></i> New Password </a></li>
              <li class="active"><a href="listCustomer.php"><i class="icon-group icon-2x"></i> All Customers</a> </li>  
              <li><a href="report.php"><i class="icon-bar-chart icon-2x"></i> Report</a> </li> 

			<br><br><br><br><br><br><br><br><br>
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
<a  href="listCustomer.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
</div>
<div class="content">
  <center><img src="<?php echo $scr;?>" alt="customer"class="rounded-circle" width="200"></center><br>
  <label> Name : <?php echo $rows['first_name']. " ". $rows['last_name'];?></label>
  <label> Customer Id: <?php echo $rows['national_id'];?></label>
  <label> Phone Number : <?php echo $rows['phone_number'];?></label>
  <label> Email : <?php echo $rows['email'];?></label>
  <label> Customer  gender : <?php echo $rows['gender'];?></label>
  <label> Date of Birth : <?php echo $rows['date_of_birth'];?></label>
  <label> Account Number : <?php echo $rows['account_number'];?></label>
  <label> Type of account: <?php echo $rows['type_of_account'];?></label>
  <label> Branch of account: <?php echo $rows['branch'];?></label>
  <label> Account status: <?php echo $rows['status'];?></label>
  <label> Customer address : <?php echo $rows['address'];?></label><br><hr>
  <label style="font-size:22px"> Balance: <?php echo $balance;?> RWF</label>
</div>
                         
</body>
</html>