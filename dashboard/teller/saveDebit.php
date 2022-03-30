<?php 
session_start();
require_once "../../db_connection.php";

if(isset($_POST['save'])){
    
    // Get values from form
    $amount = trim($_POST['amount']);
    $account = trim($_POST['account']);
    $description = trim($_POST['description']);
    $date = date('Y-m-d');
    $teller = trim($_POST['id']);
    $type = trim($_POST['type']);

    $bank = 'bank';
    $bank_type = 'credit';

// Verfy the account number if it exist and get customer id
    $sql_account = "SELECT * FROM customers WHERE account_number = '$account'  ";
    $res_account = mysqli_query($conn, $sql_account);

    if($res_account->num_rows > 0){

        // Check if this account is active
        $sql_status = "SELECT * FROM customers WHERE status = 'active' AND account_number = '$account'  ";
        $res_status = mysqli_query($conn, $sql_status);

        if($res_status->num_rows > 0){

        $rows = mysqli_fetch_array($res_account);
        $id = $rows['customer_id'];

    // Total Credit in this account

        $sql_credit = "SELECT SUM(amount) as sum  FROM customers INNER JOIN transactions ON transactions.cust_id = customers.customer_id WHERE customer_id = '$id' AND action = 'credit' ";
        $res_credit = mysqli_query($conn, $sql_credit);
        $row = mysqli_fetch_array($res_credit);
        $credit = $row['sum'];

        // Total debited in this account

        $sql_debit = "SELECT SUM(amount) as sum  FROM customers INNER JOIN transactions ON transactions.cust_id = customers.customer_id WHERE customer_id = '$id' AND action = 'debit'  ";
        $res_debit = mysqli_query($conn, $sql_debit);
        $row = mysqli_fetch_array($res_debit);
        $debit = $row['sum'];
 
    // Total balance in account
        $balance = $credit - $debit;

    // Check if there is enough funds to debit

            if($balance < $amount){
                echo '<script>
                alert(" Sorry Insufficience funds in this account ");
                window.location.href="debit.php";
            </script>';
        }else{
    
        // Record the debit have done
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
    }else{
        echo '<script>
         alert(" Sorry this account is not allowed to borrow its broke ");
        window.location.href="debit.php";
      </script>';
    }
    }else{
        echo '<script>
         alert(" Sorry wrong account number ");
        window.location.href="debit.php";
      </script>';
    }
    
}
 ?>