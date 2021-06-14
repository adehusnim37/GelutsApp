<?php
    session_start();
    include_once "config.php";
    $outgoing_id= $_SESSION['unique_id'];
    $gelutid=$_SESSION['gelutid'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $output = "";
    
    $sql = mysqli_query($conn, "SELECT * FROM contacts c JOIN users u ON c.userid = u.user_id WHERE u.fname LIKE '%{$searchTerm}%' OR u.lname LIKE '%{$searchTerm}%' OR u.gelutid LIKE '%{$searchTerm}%'");
    if(mysqli_num_rows($sql) > 0){
        include "dataContacts.php";
    }else{
        $output .= "Kontak tidak ditemukan";
    }
    echo $output;
?>