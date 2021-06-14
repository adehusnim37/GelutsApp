<?php
session_start();
include_once "config.php";

$output=array();
$output['group_id']='';
    $group_name = mysqli_real_escape_string($conn, $_POST['group_name']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    
    if(!empty($group_name) && !empty($user_id)){
            $sql = mysqli_query($conn, "SELECT group_name FROM group_master WHERE group_name = '{$group_name}'");
            if(mysqli_num_rows($sql) > 0){
                $output['message']= "$group_name  -  sudah terpakai";
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];

                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);

                    $extensions= ['png', 'jpeg', 'jpg'];
                    if(in_array($img_ext, $extensions) === true){
                        $time = time();
                        $new_img_name = $time."_grp_".$img_name;

                        $sql_row=mysqli_fetch_assoc(mysqli_query($conn, "select * from users where unique_id='".$user_id."'"));

                        if(move_uploaded_file($tmp_name, "images/$new_img_name")){
                             $random_id = rand(time(), 10000000);

                            $sql2 =mysqli_query($conn, "INSERT INTO group_master (group_unique_id, group_name, img) VALUES('{$random_id}', '{$group_name}', '{$new_img_name}' )");
                           
                            $query = "INSERT INTO group_users (group_unique_id, user_id, user_fname, user_lname, admin_role) values ('".$random_id."', '".$user_id."', '".$sql_row['fname']."', '".$sql_row['lname']."' , '1')"; 
                            $sql_group_users=mysqli_query($conn, $query);  //running the query
                            $output['group_id']=$random_id;
                            
                            $output['message'] = "Group Created";

                           
                        }
                    }else{
                        echo "Please select an Image file - jpeg, jpg, png";
                    }

                }else{
                    echo "Please select an Image file";
                }
            }
        
    }else{

    }


    echo json_encode($output);
?>