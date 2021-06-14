<?php
session_start();
include_once "config.php";
$login = mysqli_real_escape_string($conn, $_POST['login']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($login) && !empty($password)){
    //check user dan password
    $sql = mysqli_query($conn, "SELECT * FROM users where (gelutid = '{$login}' or email='{$login}')");
    
    if (mysqli_num_rows($sql) > 0){
      $row = mysqli_fetch_assoc($sql);
      if (password_verify($password, $row['password'])) {
        $status = "Active Now";
        $sql2 = mysqli_query($conn, "UPDATE users SET STATUS = '{$status}' WHERE unique_id = {$row['unique_id']}");
        if($sql2){
            $_SESSION['unique_id']=$row['unique_id'];
            $_SESSION['gelutid']=$row['gelutid'];
            
            echo "success";
        }
      }else {
        echo "Password tidak sesuai dengan email atau gelutid.";
      }
        
    }else{
        echo "email atau gelutid tidak ada.";
    }
}else{
    echo "Isi semua field yang kosong.";
}

    ?>