<?php
error_reporting(E_ERROR | E_PARSE);
    session_start();
    include_once "config.php";
    $outgoing_id= $_SESSION['unique_id'];
    $gelutid=$_SESSION['gelutid'];
   
    // checking group of user
    $group_sql = mysqli_query($conn, "SELECT * FROM group_users WHERE user_id = {$outgoing_id}"); //To get user of same glutid
    
    $msg = mysqli_query($conn, "SELECT * FROM messages WHERE outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}");
    while($row_msg = mysqli_fetch_assoc($msg)){
      $listChat1[] = $row_msg['incoming_msg_id'];
      $listChat2[] = $row_msg['outgoing_msg_id'];
    }
    $listChat = array_unique(array_merge($listChat1,$listChat2));
    //print_r($listChat);
    // Getting User details with same gelutid
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id != {$outgoing_id} AND unique_id IN (".implode(',', $listChat).") "); //To get user of same glutid

   
     //$sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ");
    $output = "";
    
    if(mysqli_num_rows($sql) == 0 && mysqli_num_rows($group_sql)==0){
        $output .= "Tidak ada user yang bisa dichat";
    }elseif (mysqli_num_rows($sql) > 0 || mysqli_num_rows($group_sql)>0 ){
        include "data.php";
    }
    echo $output
?>
