<?php 
session_start();
require_once "../../db_connection.php";


if(isset($_POST['save'])){


$allow = array('jpg','JPG','PNG','png','JPEJ', 'jpeg');  
$filename = $_FILES['profile_photo']['name'];
$dest = '../../Upload/'.$filename;
$extens = pathinfo($filename, PATHINFO_EXTENSION);
$file = $_FILES['profile_photo']['tmp_name'];
$size = $_FILES['profile_photo']['size'];
if (!in_array($extens, $allow)) {
    $photo_err = "Please Only jpg,png,jpeg is allowed!!!";
   
}else{
move_uploaded_file($file, $dest);
}

$account_number = mt_rand(1000000000,9999999999);
 
        $teller = $_POST['id'];
        $first_name = trim($_POST["first_name"]);
        $last_name = trim($_POST["last_name"]);
        $date_of_birth = trim($_POST["date_of_birth"]);
        $national_id = trim($_POST["national_id"]);
        $phone_number = trim($_POST["phone_number"]);
        $address = trim($_POST["address"]);
        $type = trim($_POST["type"]);
        $branch = trim($_POST["branch"]);
        $amount = trim($_POST['deposit']);
        $gender = trim($_POST["gender"]);
        $email = trim($_POST['email']);
        $date_credited = date('Y-m-d');

        $bank = 'bank';
        $bank_type = 'debit';
        $cust_type = 'credit';



    $sql_account = "SELECT * FROM customers WHERE account_number = '$account_number'  ";
    $sql_phone = "SELECT * FROM customers WHERE phone_number = ".$_POST['phone_number']."  ";

    $res_account = mysqli_query($conn, $sql_account);
    $res_phone = mysqli_query($conn, $sql_phone);

    if (mysqli_num_rows($res_account) > 0) {

        echo '<script>
        alert(" Sorry acount already taken!! ");
       window.location.href="customer.php";
     </script>';
        
    }if(mysqli_num_rows($res_phone) > 0){

        echo '<script>
        alert(" Sorry phone already exist!! ");
       window.location.href="customer.php";
     </script>';
     
    }

    $sql_cust = "INSERT INTO customers (first_name, last_name, phone_number, date_of_birth, email, gender, national_id, address, type_of_account, account_number, profile_photo, date_created, branch ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    if($res = mysqli_prepare($conn, $sql_cust)){
        mysqli_stmt_bind_param($res, "sssssssssssss", $first_name, $last_name, $phone_number, $date_of_birth, $email, $gender,$national_id,$address,$type,$account_number,$filename,$date_credited,$branch);
        
      
      if(mysqli_stmt_execute($res)){

          // Close statement
          mysqli_stmt_close($res);
    $sql_acc = "SELECT * FROM customers WHERE account_number = '$account_number'  ";

    $res_acc = mysqli_query($conn, $sql_acc);
    $rows = mysqli_fetch_array($res_acc);
    $id = $rows['customer_id'];
    $date1 = $rows['date_created'];

    $sql = "INSERT INTO transactions (cust_id, amount, transaction_date, action, teller) VALUES (?,?,?,?,?)";
    if($result = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($result, "sssss", $id, $amount, $date1, $cust_type, $teller);
        
      
      if(mysqli_stmt_execute($result)){

          // Close statement
          mysqli_stmt_close($result);

    $sql1 = "INSERT INTO transactions (cust_id, amount, transaction_date, action, teller) VALUES (?,?,?,?,?)";
    if($result1 = mysqli_prepare($conn, $sql1)){
        // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($result1, "sssss", $bank, $amount, $date1, $bank_type, $teller);
        

      if(mysqli_stmt_execute($result1)){
      
        // Redirect back
        echo '<script>
    alert(" Successfully saved customer!! ");
window.location.href="customer.php";
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
            
}
}
 ?>