<?php
session_start();
include_once "config.php";

    $gelutid = mysqli_real_escape_string($conn, $_POST['gelutid']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $pwdHash = password_hash($password, PASSWORD_DEFAULT);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($gelutid)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            $sqlgid = mysqli_query($conn, "SELECT gelutid from users WHERE gelutid = '{$gelutid}'"); //check gid dipakai
            if(mysqli_num_rows($sql) && mysqli_num_rows($sqlgid) > 0){
                echo "email & gelutid sudah terpakai";
            }elseif (mysqli_num_rows($sql)) {
              echo "email sudah terpakai";
            }elseif (mysqli_num_rows($sqlgid)) {
              echo "gelutid sudah terpakai";
            }
            else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];

                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);

                    $extensions= ['png', 'jpeg', 'jpg'];
                    if(in_array($img_ext, $extensions) === true){
                        $time = time();
                        $new_img_name = $time.$img_name;

                        if(move_uploaded_file($tmp_name, "images/$new_img_name")){
                            $status = "Active now";
                            $random_id = rand(time(), 10000000);

                            $sql2 =mysqli_query($conn, "INSERT INTO users (unique_id, gelutid, fname, lname, email, password, img, status)
                                        VALUES('{$random_id}', '{$gelutid}','{$fname}', '{$lname}', '{$email}', '{$pwdHash}' ,'{$new_img_name}','{$status}' )");
                            if($sql2){
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'"); //got to
                                // fix it
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    $_SESSION['gelutid'] = $row['gelutid'];
                                    
                                    echo "success";
                                }else{
                                    echo "Email address tidak terdaftar";
                                }
                            }else{
                                 echo "Something went wrong";
                            }
                        }
                    }else{
                        echo "Please select an Image file - jpeg, jpg, png";
                    }

                }else{
                    echo "Please select an Image file";
                }
            }
        }else{
            echo "$email - This is not a valid email!";
        }
    }else{

    }

?>