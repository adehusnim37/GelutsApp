<?php
error_reporting(E_ERROR | E_PARSE);
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
                    <br><small><?php echo $row['status']?></small>
                </div>
            </div>
            
            <a title="My Contacts" href="contacts.php" class="logout"><i class="fas fa-user"></i></a>
            <a title="My Chat" href="users.php" class="logout"><i class="fas fa-comment"></i></a>
            <a title="create group" href="group_create.php?user_id=<?php echo $row['unique_id'] ?>" class="logout"><i class="fas fa-users"></i></a>
            <a title= "logout" href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout"><i class="fas fa-sign-out-alt"></i><!--Logout--></a>
        </header>
        
        
          <br>
           <a title="My Contacts" href="addContacts.php" class="addContacts" style="float:left"><i class="fas fa-user-plus"></i> Tambah Teman</a>
           <br>
        
        
        <div class="search">
            <span class="text">Pilih kontakmu untuk chatting</span>
            <input type="text" name="s_keyword" id="search" placeholder="Cari orang untuk bergelut">
            <button><i class="fas fa-search"></i></button>
        </div>
        <!-- User chat detail -->
        <div class="users-list" id="tampil">
          <?php
//get user id of existing user
$query = mysqli_query($conn, "SELECT user_id FROM users WHERE unique_id = {$_SESSION['unique_id']}");

    while($result = mysqli_fetch_assoc($query)){
      $userid = $result['user_id']; }
    
   
    // checking contact of user
    $contacts = mysqli_query($conn, "SELECT * FROM contacts c JOIN users u ON c.userid = u.user_id WHERE c.userid = $userid ");
    
    while($row = mysqli_fetch_assoc($contacts)){
      $dataContacts[] = $row['contactid'];
    }
    
    $resultContacts = mysqli_query($conn, "SELECT * FROM users WHERE user_id IN (".implode(',', $dataContacts).")");
    
    while($allContacts = mysqli_fetch_assoc($resultContacts)){
      

?>
<a href="chat.php?user_id=<?=$allContacts['unique_id'] ?>">
        <div class="content">
            <img src="php/images/<?=$allContacts['img'] ?>" alt="">
            <div class="details">
                <span><?= $allContacts['fname'] . " " . $allContacts['lname'] ?> 
                </span>
            </div>
        </div>
           <div class="dc">
                <a href="hapusContacts.php?id=<?= $allContacts['user_id']; ?>" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
            </div>
            
      
    </a>
    <?php } ?>
        </div>
    </section>
</div>
<script src="js/contacts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'POST',
                    url: 'searchAJAXContacts.php',
                    data: {
                        search: $(this).val()
                    },
                    cache: false,
                    success: function(data) {
                        $('#tampil').html(data);
                    }
                });
            });
        });
        
    $(document).on('click', '.hapus_data', function(){
    var id = $(this).attr('id');
    $.ajax({
        type: 'POST',
        url: "hapusContacts.php",
        data: {id:id},
        success: function() {
            $('.data').load("data.php");
        }, error: function(response){
            console.log(response.responseText);
        }
    });
});
    </script>   
</body>
</html>