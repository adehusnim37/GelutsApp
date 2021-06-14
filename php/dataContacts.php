<?php
    
    while ($row = mysqli_fetch_assoc($sql)){

    $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
        <div class="content">
            <img src="php/images/'.$row['img'] .'" alt="">
            <div class="details">
                <span>'. $row['fname'] . " " . $row['lname'] .' </span>
            </div>
        </div>
    </a>';
    }
?>