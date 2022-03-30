<?php 
session_start();
require_once "../../db_connection.php";

if(isset($_POST['save'])){

    $teller = $_POST['id'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $account = $_POST['account'];
    $description = $_POST['description'];
    $date = date('Y-m-d');

    $bank = 'bank';
    $bank_type = 'debit';
    
    $sql_account = "SELECT * FROM customers WHERE account_number = ".$_POST['account']."  ";
    $res_account = mysqli_query($conn, $sql_account);
    
    $rows = mysqli_fetch_array($res_account);
    $id = $rows['customer_id'];

    $sql = "INSERT INTO transactions (cust_id, amount, transaction_date, action, teller, description) VALUES (?,?,?,?,?,?)";
    if($result = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($result, "ssssss", $id, $amount, $date, $type, $teller, $description);
        
      
      if(mysqli_stmt_execute($result)){

          // Close statement
          mysqli_stmt_close($result);

    $sql1 = "INSERT INTO transactions (cust_id, amount, transaction_date, action, teller, description) VALUES (?,?,?,?,?,?)";
    if($result1 = mysqli_prepare($conn, $sql1)){
        // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($result1, "ssssss", $bank, $amount, $date, $bank_type, $teller, $description);
        

      if(mysqli_stmt_execute($result1)){
      
        // Redirect back
        echo '<script>
    alert(" Successfully credit customer!! ");
window.location.href="credit.php";
</script>';
    } else{
        echo "Something went wrong. Please try again later.";
    }
    }
    // Close statement
    mysqli_stmt_close($result1);
}
}
    
}
 ?>