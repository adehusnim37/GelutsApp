

<?php
/* To upload file in attachment folder and update the details in sql-message(table) */

include_once "config.php";

if(isset($_FILES['filename'])){
    $file_name = $_FILES['filename']['name'];
    $file_type = $_FILES['filename']['type'];
    $tmp_name = $_FILES['filename']['tmp_name'];

    $time = time();
    $new_file_name = $time.$file_name;
    
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id1']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id1']);
        

   if(move_uploaded_file($tmp_name, "attachment/$new_file_name")){  //Uploading attached file
    
    $query = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id,msg,file_shared) values ('".$incoming_id."', '".$outgoing_id."' ,'".$new_file_name."', '1')"; //query to insert data in message table
    $sql=mysqli_query($conn, $query) or die();  //running the query

    if($sql) 
         {
            echo "File Shared";
        }
        
    }
    

}

?>