<?php 
require_once "../../db_connection.php";

$sql = "SELECT * FROM customers"; // SQL with parameters
$stmt = $conn->prepare($sql); 
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$rowcount = $result->num_rows;

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
<?php include('header.php');?>
    <div class="container-fluid">
      <div class="row-fluid">
	<div class="span2"> 
          <div class="well sidebar-nav">
         <center> <img src="../../img/bank.png" alt="bank"class="rounded-circle" width="100"></center><br>
              <ul class="nav nav-list">
              
              <li><a href="managerDashboard.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li>
              <li><a href="change.php"><i class="icon-user icon-2x"></i> New Password </a></li>
              <li><a href="flow.php"><i class="icon-user icon-2x"></i> Requested Flow </a></li>
              <li class="active"><a href="listCustomer.php"><i class="icon-group icon-2x"></i> All Customers</a> </li> 
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
			<i class="icon-table"></i> Customers
			</div>
			<ul class="breadcrumb">
			<li><a href="adminDashboard.php">Dashboard</a></li> /
			<li class="active">All Customers</li>
			</ul>

      
<div style="text-align:center;">
			Total Number of Customers:  <font color="green" style="font-weight:bold ;">[<?php echo $rowcount;?>]</font>
			</div>
      <br>
<input type="text" style="padding:10px; width: 50%" name="filter"  id="filter" placeholder="Search Customer..." autocomplete="off" />

    <table class="table table-bordered" id="resultTable" data-responsive="table">
        <tr>
            <thead>
                <th> SNo </th>
                <th>Customer Name </th>
                <th>Customer Address </th>
                <th>Customer Phone </th>
                <th>Type Of account </th>
                <th>Action </th>
            </thead>
        </tr>
        <tbody>
            <?php
             $i = 0;
            while($rows = $result->fetch_assoc()){
               $i ++;
                ?>
            <tr>
                <td> <?php echo $i;?> </td>
                <td> <?php echo $rows['first_name']. " ".$rows['last_name'];?></td>
                <td> <?php echo $rows['address'];?></td>
                <td> <?php echo $rows['phone_number'];?></td>
                <td> <?php echo $rows['type_of_account'];?></td>
                <td> <a class="btn view" href="viewCustomers.php?id=<?php echo $rows['customer_id'];?>"> View Details</a></td>
            </tr>
            <?php
            }
            ?>
            </div></div></div>
</table>
</body>
</html>