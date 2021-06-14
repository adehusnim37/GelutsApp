<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";

      
        $sql = "select * from messages where incoming_msg_id={$incoming_id}";

       
        $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
      
        while ($row = mysqli_fetch_assoc($query)){
          $time = $row['time'];
            $waktu = date("d M Y, H:i", strtotime($time));
            if($row['outgoing_msg_id'] == $outgoing_id){ //jika sama maka dia adalah pengirim pesan
                $output .=
            '<div class="chat outgoing">
                <div class="details">';
                    if($row['file_shared']==0){
                    $output .='<p>'.$row['msg'].'</p>'; 
                }else{
                    $output .='<label>File Shared</label>';
                    $output .='<a href="php/download.php?id='.$row['msg'].'" ><p>'.$row['msg'].'</p></a>'; 
                }
             $output .='<small>'.$waktu.' </small>
             </div>
            </div>';
            }else{
                $sqluser="select * from users where unique_id='".$row['outgoing_msg_id']."'";
                $user_row=mysqli_fetch_assoc(mysqli_query($conn, $sqluser));
                $output .=  '<div class="chat incoming">
                <div class="details"><label>'.$user_row["fname"].' '.$user_row["lname"];
                if($row['file_shared']==0){
                    $output .='<p>'.$row['msg'].'</p>'; 
                }else{
                    $output .='<label>File Shared</label>';
                    $output .='<a href="php/download.php?id='.$row['msg'].'" ><p>'.$row['msg'].'</p></a>'; 
                }
                $output .='<small>'.$waktu.' </small>
             </div>
            </div>';
            }
        }
        echo $output;
    }
    }else{
        header("../login.php");
    }
?>