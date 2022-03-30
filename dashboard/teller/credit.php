

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Customer</title>
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
    border-radius: 15px;
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
    <div class="container-fluid">
      <div class="row-fluid">
	<div class="span2"> 
          <div class="well sidebar-nav">
         <center> <img src="../../img/bank.png" alt="bank"class="rounded-circle" width="100"></center><br>
              <ul class="nav nav-list">
              
              <li><a href="tellerDashboard.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
              <li><a href="change.php"><i class="icon-user icon-2x"></i>	New Password</a></li>
              <li class="active"><a href="credit.php"><i class="icon-money icon-2x"></i> Credit Customer</a>  </li>  
              <li ><a href="debit.php"><i class="icon-money icon-2x"></i> Debit Customer</a>  </li>  
              <li><a href="listCustomer.php"><i class="icon-group icon-2x"></i> All Customers</a> </li> 

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
        </div><!--/span-->
    <?php include('header.php');?>
    <div class="span10">
	<div class="contentheader">
			<i class="icon-money"></i> Credit
			</div>
			<ul class="breadcrumb">
			<li><a href="tellerDashboard.php">Dashboard</a></li> /
			<li class="active">Credit Customer</li>
			</ul>

    <div class="forms">
        <form method="post" action="saveCredit.php">
        <p style="font-weight:bold; text-align:center; font-size: 22px"> Credit Details</p><br>
            <label> Account Number</label>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="type" value="credit">
            <input type="number" name="account" placeholder="Account Number" required>
            <label> Amount</label>
            <input type="number" name="amount" placeholder="Amount Credited" required>
            <label> Description</label>
            <textarea  name="description" placeholder="Description" style="margin-left: 50px; width:80%" required></textarea><br><br>
            <button type="submit" name="save" class=""> Credit </button>
</form>
    </div>
</body>
</html>