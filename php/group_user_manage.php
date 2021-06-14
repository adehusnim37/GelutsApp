<?php 

session_start();
include_once "config.php";
$action= $_POST['action'];
if($action == 'add'){
    $user_details=explode('-',$_POST['user_select']);
    $query = "INSERT INTO group_users (group_unique_id, user_id,user_fname,user_lname, admin_role) values ('".$_POST['group_id']."', '".$user_details[0]."' ,'".$user_details[1]."','".$user_details[2]."' , '".$_POST['role']."')"; 
    $sql_group_users=mysqli_query($conn, $query);  //running the query
    echo 'Data Inserted';
}else if($action == 'delete'){
    $query = "DELETE FROM group_users where group_users_tbl_id='".$_POST['id']."'"; 
    $sql_group_users=mysqli_query($conn, $query);  //running the query
    echo 'Data Deleted';
}

?> 