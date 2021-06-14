<?php
    session_start();
    include_once "config.php";
    $outgoing_id= $_SESSION['unique_id'];
    $gelutid=$_SESSION['gelutid'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $output = "";
    
    $msg = mysqli_query($conn, "SELECT * FROM messages m JOIN users u ON m.outgoing_msg_id = u.unique_id WHERE m.outgoing_msg_id = {$outgoing_id} OR m.incoming_msg_id = {$outgoing_id} AND AND (u.fname LIKE '%{$searchTerm}%' OR u.lname LIKE '%{$searchTerm}%' OR m.msg LIKE '%{$searchTerm}%')");
    
    
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id != {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')");
    
    if(mysqli_num_rows($sql) > 0){
        include "data.php";
    }else{
        $output .= "Pesan tidak ditemukan.";
    }
    echo $output;
?>