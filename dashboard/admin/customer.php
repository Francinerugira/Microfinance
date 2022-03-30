<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer Account</title>
 
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
  .forms {
    border-radius: 15px;
    position: relative;
    top: 10px;
    width: auto;
    height: auto;
    padding-top: 20px;
    padding-bottom: 5px;
    margin-left: 2%;
    box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
  }
  .forms select {
    color: rgba(44, 44, 44, 0.9);
    background-color: white;
    border: 1px solid white;
    width: 25%;
    margin-left: 50px;
    margin-bottom: 10px;
    font-size: 15px;
    font-weight: bold;
    border-bottom: 1px solid rgba(68, 68, 68, 0.3);
    padding-bottom: 10px;
    margin-top: 10px;
  }
  
  .forms input {
    color: rgba(44, 44, 44, 0.9);
    background-color: white;
    border: 1px solid white;
    width: 25%;
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
    width: auto;
    border-radius: 10px;
    color: black;
  }

  button:hover{
      color: white;
      font-size: 18px;
      background-color: #383332;
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
              
              <li><a href="adminDashboard.php"><i class="icon-dashboard icon-large"></i> Dashboard </a></li>
              <li><a href="change.php"><i class="icon-user icon-large"></i> New Password</a>  </li> 
              <li><a href="staff.php"><i class="icon-plus-sign icon-large"></i> Add Staff</a>  </li>  
              <li class="active"><a href="customer.php"><i class="icon-plus-sign icon-large"></i> Add Customer</a>  </li>  
              <li><a href="listCustomer.php"><i class="icon-group icon-large"></i> All Customer</a> </li>  
              <li><a href="statment.php"><i class="icon-money icon-large"></i> Account Statment</a> </li>       

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
    <?php include('header.php');?>
    
<div class="span10">
	<div class="contentheader">
			<i class="icon-user"></i> Customers
			</div>
			<ul class="breadcrumb">
			<li><a href="adminDashboard.php">Dashboard</a></li> /
			<li class="active">Add New Customer</li>
			</ul>

    <br><br>
        
        <div class="forms">
        <form method="post" action="saveCustomer.php" enctype="multipart/form-data">
             <p style="font-weight:bold; text-align:center; font-size: 22px"> Add New Customer</p><br>
             <input type="hidden" name="id" value = "<?php echo $id;?>">
             <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <select name="gender" required>
                <option value=""> Select Gender </option>
                <option value="Male"> Male </option>
                <option value="Female"> Female </option>
</select>
<input type="text" name="date_of_birth" onfocus="(this.type='date')" placeholder="Date Of birth" required>
            <input type="number" name="national_id" placeholder="National Id" maxlength="16" minlength="16" required>
            <input type="text" name="phone_number" placeholder="Phone Number" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="text" name="address" placeholder="Address" required>
            
            <input type="text" name="branch" placeholder="Branch" required>
            <select name="type" required >
                <option value=""> Select Type of account </option>
                <option value="saving"> Saving </option>
                <option value="current"> current </option>
</select>
<input type="text" name="deposit" placeholder="Initial deposit" required>
<input type="text" name="profile_photo" onfocus="(this.type='file')" placeholder="Profile Photo" required><br><br>
            <button type="submit" name="save" class=""> Add Customer </button>
</form>
    <!-- <form action="saveCustomer.php" method="post">
        
        
        
        
        <button type="submit" name="save" > Save </button>
    </form> -->
    </div>

</body>
</html>

