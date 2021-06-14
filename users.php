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
                    <br><small><?php echo $row['status']?></small>
                </div>
            </div>
            
            <a title="My Contacts" href="contacts.php" class="logout"><i class="fas fa-user"></i></a>
            <a title="My Chat" href="users.php" class="logout"><i class="fas fa-comment"></i></a>
            <a title="create group" href="group_create.php?user_id=<?php echo $row['unique_id'] ?>" class="logout"><i class="fas fa-users"></i></a>
            <a title= "logout" href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout"><i class="fas fa-sign-out-alt"></i><!--Logout--></a>
        </header>
        <div class="search">
            <span class="text">Cari Pesan</span>
            <input type="text" name="s_keyword" id="search" placeholder="Cari orang untuk bergelut">
            <button><i class="fas fa-search"></i></button>
        </div>
        <!-- User chat detail -->
        <div class="users-list" id="tampil">

        </div>
    </section>
</div>
<script src="js/users.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'POST',
                    url: 'searchAJAXMessages.php',
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
    </script>



</body>
</html>