<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../fontawesome/css/all.css" media="screen" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../dashboard.css">
    <script src="../time.js" type="text/javascript" charset="utf-8"></script>

</head>
<body>
    <div class="container-fluid">
      <div class="row-fluid">
	<div class="span2"> 
          <div class="well sidebar-nav">
         <center> <img src="../../img/bank.png" alt="bank"class="rounded-circle" width="100"></center><br>
              <ul class="nav nav-list">
              
              <li class="active"><a href="adminDashboard.php"><i class="icon-dashboard icon-large"></i> Dashboard </a></li>
              <li><a href="change.php"><i class="icon-user icon-large"></i> New Password</a>  </li> 
              <li><a href="staff.php"><i class="icon-plus-sign icon-large"></i> Add Staff</a>  </li>  
              <li><a href="listCustomer.php"><i class="icon-group icon-large"></i> All Staffs</a> </li>   

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

        <div class="span10">
	<div class="contentheader">
			<i class="icon-dashboard"></i> Dashboard
			</div>
			<ul class="breadcrumb">
			<li class="active">Dashboard</li>
			</ul>
    <?php include('header.php');?>
    <br><br><br>
<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:#fff;"><center>AlphaMicrofinanceLtd System</center></font>
<div class="dashboard">
  <a href="change.php"> <span><i class="icon-user icon-2x"></i><br><br> CHANGE PASSWORD </span></a>
  <a href="staff.php"> <span><i class="icon-plus-sign icon-2x"></i><br><br>	ADD NEW STAFF </span></a>
  <a href="listCustomer.php"><span> <i class="icon-group icon-2x"></i><br><br>	ALL STAFFS </span> </a>
  <a href="../../index.php"> <span><font color="red"><i class="fa fa-power-off icon-2x"></i></font>  <br> <br>	LOGOUT </span> </a>
		
			</div>


	
