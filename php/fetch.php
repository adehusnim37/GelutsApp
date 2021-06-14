<?php

session_start();
include_once "config.php";

$sql= "select * from group_users where group_users_tbl_id ='".$_POST['id']."'";
$query=mysqli_query($conn, $sql);


 $row=mysqli_fetch_assoc($query);
$output['group_users_tbl_id']=$_POST['id'];
$output['user_id']=$row['user_id'];
$output['user_fname']=$row['user_fname'];
$output['user_lname']=$row['user_lname'];
$output['role']=$row['admin_role'];

echo json_encode($output);

?>
