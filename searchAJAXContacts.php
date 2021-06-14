<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php"); //parameter untuk user harus login dulu
}

include_once "header.php";

    if (isset($_POST['search'])) {
        include_once "php/config.php";

        
        $search = $_POST['search'];
        
//get user id of existing user
$query = mysqli_query($conn, "SELECT user_id FROM users WHERE unique_id = {$_SESSION['unique_id']}");

    while($result = mysqli_fetch_assoc($query)){
      $userid = $result['user_id']; }
    
   
    // checking contact of user
    $contacts = mysqli_query($conn, "SELECT * FROM contacts c JOIN users u ON c.userid = u.user_id WHERE c.userid = $userid ");
    
    while($row = mysqli_fetch_assoc($contacts)){
      $dataContacts[] = $row['contactid'];
    }
    
    $resultContacts = mysqli_query($conn, "SELECT * FROM users WHERE (fname LIKE '%{$search}%' OR lname LIKE '%{$search}%') AND user_id IN (".implode(',', $dataContacts).")");
    if(mysqli_num_rows($resultContacts)>0){
    while($allContacts = mysqli_fetch_assoc($resultContacts)){

?>
<a href="chat.php?user_id=<?=$allContacts['unique_id'] ?>">
        <div class="content">
            <img src="php/images/<?=$allContacts['img'] ?>" alt="">
            <div class="details">
                <span><?= $allContacts['fname'] . " " . $allContacts['lname'] ?> </span>
                
            </div>
        </div>
    </a>
<?php } 
}else { ?>
          <div class="content">
            <div class="details">
                <span>Data kontak tidak ditemukan </span>
                
            </div>
        </div>
 <?php }
} ?>