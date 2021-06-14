<?php
error_reporting(E_ERROR | E_PARSE);
    while ($group_row = mysqli_fetch_assoc($group_sql)){
        
        $groupsql2= "select * from messages where (incoming_msg_id = '".$group_row['group_unique_id']."' or outgoing_msg_id ='".$group_row['group_unique_id']."') order by msg_id DESC LIMIT 1 "; 
        
        // $groupsql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
        //          OR outgoing_msg_id = {$row['unique_id']}) and (outgoing_msg_id = {$outgoing_id}
        //          OR outgoing_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $group_query2 = mysqli_query($conn, $groupsql2);
        $group_row2= mysqli_fetch_assoc($group_query2);
            if(mysqli_num_rows($group_query2) > 0){
                $group_result=$group_row2['msg'];
                $time = $group_row2['time'];
            }else{
                $group_result = "tidak ada chat yang masuk";
            }
    
            //trimming pesan jika kata lebih dari 28
            (strlen($group_result)>28) ? $group_msg= substr($group_result, 0 ,28) : $group_msg = $group_result;
            
            $waktu = date("d M Y, H:i", strtotime($time));
            //cek user online
            // ($row{'status'} == "Offline now") ? $offline = "offline" : $offline = "";
           // ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            $gr_sql= "select * from group_master where group_unique_id='".$group_row['group_unique_id']."' ";
            $gr_row = mysqli_fetch_assoc(mysqli_query($conn, $gr_sql)); 
            
            $output .= '<a href="group_chat.php?group_id='.$group_row['group_unique_id'].'">
            <div class="content">
                <img src="php/images/'.$gr_row['img'] .'" alt="">
                <div class="details">
                    <span>'. $gr_row['group_name']  .' </span>
                    <p>'.$group_msg.'</p>
                    <small>'. $waktu .'</small>
                </div>
            </div>
           
        </a>';
        }
    
    
    while ($row = mysqli_fetch_assoc($sql)){
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
             OR outgoing_msg_id = {$row['unique_id']}) and (incoming_msg_id = {$outgoing_id}
             OR outgoing_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2= mysqli_fetch_assoc($query2);
        if(mysqli_num_rows($query2) > 0){
            $result=$row2['msg'];
            $time = $row2['time'];
        }else{
            $result = "tidak ada chat yang masuk";
        }

        //trimming pesan jika kata lebih dari 28
        (strlen($result)>28) ? $msg= substr($result, 0 ,28) : $msg = $result;
        //cek user online
        // ($row{'status'} == "Offline now") ? $offline = "offline" : $offline = "";
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        $waktu = date("d M Y, H:i", strtotime($time));
        //$waktu = $time;
        

    $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
        <div class="content">
            <img src="php/images/'.$row['img'] .'" alt="">
            <div class="details">
                <span>'. $row['fname'] . " " . $row['lname'] .' </span>
                <p>'.$msg.'</p>
                <small>'. $waktu .'</small>
            </div>
        </div>
        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
    </a>';
    }
?>