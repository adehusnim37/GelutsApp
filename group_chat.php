<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Realtime Chat App</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<?php
session_start();
if(!isset($_SESSION['unique_id'])){
header("location: login.php");
}
            include_once "php/config.php";
            $group_id = mysqli_real_escape_string($conn, $_GET['group_id']);
            $user_id=$_SESSION['unique_id'];
?>
<body>

<div class="wrapper">
    <section class="chat-area">
        <header>

            <!-- Attachment Modal -->
            <div class="modal fade" id="attachmentModal" tabindex="-1" aria-labelledby="attachmentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <form id="file_form" action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                <div class="drag-area">
                    <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                    <header id="file_message">Drag & Drop to Upload File</header>
                    <span>OR</span>
                    <p id="browse_file">Browse File</p>
                    <input name="filename" id="filename" type="file" hidden>
                    <input type="text" name="outgoing_id1" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" name="incoming_id1" value="<?php echo $group_id; ?>" hidden>
           
                    <label id="file_selected" hidden></label>
                </div>
                

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info text-light">Share</button>
                </div>
                </form>
                </div>
            </div>
            </div>


            <?php
            
            $sql = mysqli_query($conn, "SELECT * FROM group_master where group_unique_id = {$group_id}");
            $grp_user_sql=mysqli_fetch_assoc(mysqli_query($conn, "select * from group_users where group_unique_id = {$group_id} and user_id = {$user_id}"));
            if(mysqli_num_rows($sql)>0){
                $row = mysqli_fetch_assoc($sql);
            }else{
                header("location: users.php");
            }
            ?>
            <!-- user profile -->
            <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            <img src="php/images/<?php echo $row['img']?>" alt="">
            <div class="details">
                <span> <?php echo $row['group_name'];?> </span>
                <?php  if ($grp_user_sql['admin_role']==1){?>
                    <a title="Manage Group User" href="group_user_manage.php?group_id=<?php echo $group_id ?>" class="user_manage"><i class="fas fa-users"></i></a>
                <?php } ?>
            </div>
               
                
        </header>
        
        <div class="chat-box">
            <div class="chat outgoing">
                <div class="details">
                    
                </div>
            </div>


        </div>
        <form action="#" class="typing-area" autocomplete="off">
            <input type="text" name="outgoing_id" id="outgoing_id" value="<?php echo $user_id; ?>" hidden>
            <input type="text" name="incoming_id" id="incoming_id"value="<?php echo $group_id; ?>" hidden>
            <input class="input-field" name="message" type="text" placeholder="Type A message here">
            <button id="attachment" data-bs-toggle="modal" data-bs-target="#attachmentModal"><i class="fas fa-paperclip"></i></button>
            <button id="send"><i class="fab fa-telegram-plane"></i></button>
            
        </form>
    </section>
</div>
<script type="text/javascript" language="javascript">

</script>


<script src="js/group_chat.js"></script>





</body>
</html>