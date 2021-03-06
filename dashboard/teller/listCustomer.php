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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
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
              <ul class="nav nav-list">
              
              <li><a href="tellerDashboard.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
              <li><a href="change.php"><i class="icon-user icon-2x"></i>	New Password</a></li>
              <li><a href="balance.php"><i class="icon-money icon-2x"></i>	Balance</a></li>
              <li><a href="transaction.php"><i class="icon-money icon-2x"></i>	View transaction</a></li>
              <li><a href="customer.php"><i class="icon-plus-sign icon-2x"></i> Add Customer</a>  </li> 
              <li><a href="credit.php"><i class="icon-money icon-2x"></i> Deposit</a>  </li>  
              <li ><a href="debit.php"><i class="icon-money icon-2x"></i> Withdraw</a>  </li> 
              <li ><a href="statment.php"><i class="icon-money icon-2x"></i> Statment</a>  </li> 
              <li  class="active"><a href="listCustomer.php"><i class="icon-group icon-2x"></i> All Customers</a> </li>  
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
			<li><a href="tellerDashboard.php">Dashboard</a></li> /
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
                <th>Account Status</th>
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
                <td> <?php echo $rows['status'];?></td>
                <td> <a class="btn view" href="viewCustomers.php?id=<?php echo $rows['customer_id'];?>"> View Details</a>
                <?php
                if($rows['status'] == 'active') {
                ?>
                <!-- <a class="btn btn-danger block" href="#" id="<?php echo $rows['customer_id'];?>"> Block </a> -->
                <a href="#" id="<?php echo $rows['customer_id']; ?>" class="block" title="Click To Block"><button class="btn btn-danger btn-mini"><i class="icon-block"></i> Block</button></a></td>

                <?php
                }else {
                ?>
                <a class="btn btn-info active" href="#" id="<?php echo $rows['customer_id'];?>"> Activate </a></td>
                <?php 
                }
                ?>
              </tr>
            <?php
            }
            ?>
            </div></div></div>
</table>


<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn bg-info" href="../../../Logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/jquery.js"></script>
<script type="text/javascript">
$(function() {
$(".block").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var block_id = element.attr("id");

//Built a url to send
var info = 'id=' + block_id;
 if(confirm("Are you sure want to Block this customer?"))
		  {

 $.ajax({
   type: "GET",
   url: "blockcustomer.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

$(".active").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var active_id = element.attr("id");

//Built a url to send
var info = 'id=' + active_id;
 if(confirm("Are you sure want to Activate this customer?"))
		  {

 $.ajax({
   type: "GET",
   url: "activatecustomer.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});


});
</script>
</body>
</html>