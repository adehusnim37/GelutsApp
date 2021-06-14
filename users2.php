<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php"); //parameter untuk user harus login dulu
}
?>


<?php
include_once "header.php";

?>

<body>

<div class="wrapper">
    <section class="users">
        <header>
            <?php
            include_once "php/config.php";
            $sql = mysqli_query($conn, "SELECT * FROM users where unique_id = {$_SESSION['unique_id']} ");
            if(mysqli_num_rows($sql)>0){
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <!-- user profile -->
            <div class="content">
                <img src="php/images/<?php echo $row['img']?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname'] . " " . $row['lname']?> </span>
                    <p><?php echo $row['status']?></p>
                </div>
            </div>
            
            <a title="My Contacts" href="contacts.php" class="logout"><i class="fas fa-user"></i></a>
            <a title="My Chat" href="users.php" class="logout"><i class="fas fa-comment"></i></a>
            <a title="create group" href="group_create.php?user_id=<?php echo $row['unique_id'] ?>" class="logout"><i class="fas fa-users"></i></a>
            <a title= "logout" href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout"><i class="fas fa-sign-out-alt"></i><!--Logout--></a>
        </header>
        <div class="search">
            <span class="text">Cari Pesan</span>
            <input type="text" placeholder="Cari orang untuk bergelut">
            <button><i class="fas fa-search"></i></button>
        </div>
        <!-- User chat detail -->
        <div class="users-list">
          <?php
$outgoing_id= $_SESSION['unique_id'];

$sql = mysqli_query($conn, "SELECT * FROM messages WHERE outgoing_msg_id = $outgoing_id");
//var_dump($sql); die;
while($row = mysqli_fetch_assoc($sql)){
      $income_msg[] = $row['incoming_msg_id'];
    }
      print_r($income_msg) ;
    
    $list_msg = mysqli_query($conn, "SELECT * FROM users u JOIN messages m ON u.unique_id = m.incoming_msg_id WHERE unique_id IN (".implode(',', $income_msg).") ORDER BY m.msg_id DESC");

$sql2 = mysqli_query($conn, "SELECT * FROM messages m JOIN users u ON m.outgoing_msg_id = u.unique_id WHERE m.outgoing_msg_id = $outgoing_id");



if(mysqli_num_rows($sql) > 0){
  while($row = mysqli_fetch_assoc($list_msg)){
            $message=$row['msg'];
                  (strlen($message)>28) ? $msg= substr($message, 0 ,28) : $msg = $message;
                 ?>
       <a href="chat.php?user_id=<?= $row['unique_id'] ?>">
        <div class="content">
            <img src="php/images/<?=$row['img'] ?>" alt="">
            <div class="details">
                <span><?= $row['fname'] . " " . $row['lname'] ?> </span>
                <p><?= $msg ?></p>
            </div>
        </div>
        <div class="status-dot <?= $offline ?>"><i class="fas fa-circle"></i></div>
    </a>
        
     <?php }
  
}else{ ?>
        <div class="content">
            <div class="details">
                <span>Belum ada pesan.</span>
            </div>
        </div>
<?php }
?>


        </div>
    </section>
</div>





</body>
</html>