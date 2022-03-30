<html>
<head> 
<title> 
Credit and Debit Record 
</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link href="../fontawesome/css/all.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <link href="../css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/DT_bootstrap.css">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<script src="../time.js" type="text/javascript" charset="utf-8"></script>

    <style type="text/css">
      body {
        background: #ffffff url(../../img/4.png)!important;
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 50px 0;
      }
    </style>
    

<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, left=300, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */

$(function(){
	$('#resultTable').DataTable();
      }); 
</script>
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
              <li><a href="listCustomer.php"><i class="icon-group icon-2x"></i> All Customers</a> </li>  
              <li class="active"><a href="report.php"><i class="icon-bar-chart icon-2x"></i> Report</a> </li> 

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
			<i class="icon-bar-chart"></i> Credits && Debits Report
			</div>
			<ul class="breadcrumb">
			<li><a href="managerDasgboard.php">Dashboard</a></li> /
			<li class="active">Credits && Debits Report</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="managerDashboard.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
<button  style="float:right;" class="btn btn-default btn-large"><i class="icon icon-print"></i> <a href="javascript:Clickheretoprint()"> Print</button></a>

</div>

<form action="report.php" method="get">
<center><strong>From : <input type="date" style="width: 223px; padding:14px;" name="date1" class="tcal" value="" /> To: <input type="date" style="width: 223px; padding:14px;" name="date2" class="tcal" value="" />
 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit"><i class="icon icon-search icon-large"></i> Search</button>
 

</strong></center>
</form>


<div class="content" id="content">
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
<?php
if(!isset($_GET['date1']) && !isset($_GET['date2'])){
    ?>
    All Credits and Debits Report 
    <?php
}else{
?>
Credits and Debits Report from&nbsp;<?php echo $_GET['date1'] ?>&nbsp;to&nbsp;<?php echo $_GET['date2'] ?>
<?php 
}
?>
</div>


<table border="1" cellpadding="4" cellspacing="1" style="font-size: 18px; text-align:left; " width="80%">
	
	<thead>
		<tr>
			<th> Credit Date </th>
			<th> Action </th>
			<th> Description </th>
			<th> Amount  </th>
		
		</tr>
	</thead>
	<tbody>
		
			<?php 
				include('../../db_connection.php');
                if(!isset($_GET['date1']) && !isset($_GET['date2'])){
				$result = $conn->query("SELECT * FROM transactions WHERE cust_id = 'bank'");
                }else{
                    $d1=$_GET['date1'];
				    $d2=$_GET['date2'];
				$result = $conn->query("SELECT * FROM transactions WHERE transaction_date BETWEEN '$d1' AND '$d2' AND cust_id = 'bank' ");
                }

				
				for($i=0; $row = $result->fetch_assoc(); $i++){
			?>
			<tr class="record">
			<td><?php echo $row['transaction_date']; ?></td>
			<td><?php echo $row['action']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['amount']; ?></td>
			
			
			 <?php
				}
			?> 
			
			</tr>
	
		
	</tbody>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> Total Credits for bank: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
			<?php
				if(!isset($_GET['date1']) && !isset($_GET['date2'])){
                    $results = $conn->query("SELECT sum(amount) as sum FROM transactions WHERE cust_id = 'bank' AND action = 'credit' ");
                }else{
                    $d1=$_GET['date1'];
                    $d2=$_GET['date2'];
                    $results = $conn->query("SELECT sum(amount) as sum FROM transactions WHERE transaction_date BETWEEN '$d1'AND '$d2' AND cust_id = 'bank' AND action = 'credit'");
                
                }
				for($i=0; $rows = $results->fetch_assoc(); $i++){
				echo $rows['sum'];
				}
				?>
			</th>
		
				</th>
		</tr>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> Total Debits for bank: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
			<?php
				if(!isset($_GET['date1']) && !isset($_GET['date2'])){
                    $results = $conn->query("SELECT sum(amount) as sum FROM transactions WHERE cust_id = 'bank' AND action = 'debit' ");
                }else{
                    $d1=$_GET['date1'];
                    $d2=$_GET['date2'];
                    $results = $conn->query("SELECT sum(amount) as sum FROM transactions WHERE transaction_date BETWEEN '$d1'AND '$d2' AND cust_id = 'bank' AND action = 'debit'");
                
                }
				for($i=0; $rows = $results->fetch_assoc(); $i++){
				echo $rows['sum'];
				}
				?>
			</th>
		
				</th>
		</tr>
	</thead>
</table>


</div>
</div>
</div>
</div>

<script>
	$('#resultTable').tableExport();
</script>


</body>
  
</html>