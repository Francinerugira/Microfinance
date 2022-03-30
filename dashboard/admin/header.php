<?php
require_once "../../db_connection.php";
session_start();
if( $_SESSION['role'] != 'admin') { 
  unset($_SESSION['email'], $_SESSION['role']);
  $_SESSION['logged_in'] = false;
  header("Location: ../../index.php"); //redirect to index.php
  exit;
}
$email = $_SESSION['email'];

$sql_staff = "SELECT * FROM staffs WHERE email = ?"; // SQL with parameters
$stmt_staff = $conn->prepare($sql_staff); 
$stmt_staff->bind_param("s", $email);
$stmt_staff->execute();
$result_staff = $stmt_staff->get_result(); // get the mysqli result
$row = $result_staff->fetch_assoc(); // fetch data  
$id = $row['staff_id'];
?>

<html>
    <head>
    
    <link rel="stylesheet" type="text/css" href="../../login.css" />

    
	
	</head>
    
<body>
    		
       
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><b>Alpha Microfinance Ltd</b></a>
          <div class="nav-collapse collapse">
            <ul class="nav pull-right">
              <li><a><i class="icon-user icon-large"></i> Welcome:<strong> <?php echo $_SESSION['role'];?></strong></a></li>
			 <li><a> <i class="icon-calendar icon-large"></i>
								<?php
								$Today = date('y:m:d',time());
								$new = date('l, F d, Y', strtotime($Today));
								echo $new;
								?>

				</a></li>
              <li><a href="../../index.php"><font color="red"><i class="fa fa-power-off"></i></font> Log Out</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	

       
    </body>
</html>