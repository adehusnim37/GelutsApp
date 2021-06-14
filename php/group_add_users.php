<?php
session_start();
include_once "config.php";
echo $_POST['user_id'];

$i = 0;
$user_selected_count = count($_POST['user_select']);
//$selectedOption = "";
while ($i < $user_selected_count) {
    $query = "INSERT INTO group_users (group_unique_id, user_id, admin_role) values ('".$_POST['group_id']."', '".$user_id."' , '0')"; 
    $sql_group_users=mysqli_query($conn, $query);  //running the query
   $i ++;
}
if($i>0){
    echo "Total :-".$i." Users added in the group"; 
}else{
    echo"No User added in the group"; 
}


                           

?>