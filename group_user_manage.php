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
<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <form id="add_user_form" action="" method="post">
    <div class="modal-header">
        <h5 class="modal-title" >Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <div class="form-group">
        <label for="user">Select User you want to add in group</label>
        <select class="form-control" name="user_select" id="user_select">
            <option value="">Select User</option>
                    <?php 

        include_once "php/config.php";

        $userid = $_SESSION['unique_id'];

        $q = mysqli_query($conn, "SELECT user_id FROM users WHERE unique_id = $userid");
        
        while($result = mysqli_fetch_assoc($q)){
      $idUser = $result['user_id']; }
      
      $contacts = mysqli_query($conn, "SELECT * FROM contacts c JOIN users u ON c.userid = u.user_id WHERE c.userid = $idUser OR u.unique_id != {$_SESSION['unique_id']}");
    
    while($row = mysqli_fetch_assoc($contacts)){
      $dataContacts[] = $row['contactid'];
    }
    
    $resultContacts = mysqli_query($conn, "SELECT * FROM users WHERE user_id IN (".implode(',', $dataContacts).")");
    
    while($allContacts = mysqli_fetch_assoc($resultContacts)){
        echo '<option value="'.$allContacts['unique_id'].'-'.$allContacts['fname'].'-'.$allContacts['lname'].'">'.$allContacts['fname'].' '.$allContacts['lname'].'</option>';
        }
        ?>
        </select>
    </div>
         <div class="form-group">
        <label for="user">Role</label>
        <select class="form-control" id="role" name="role">
            <option value="0">User</option>
            <option value="1">Group Admin</option>
        </select>

   </div>
         <input type="text" id="user_id" name="user_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="group_id" value="<?php echo $group_id; ?>" hidden>
        <input type="text" id="group_users_tbl_id" name="group_users_tbl_id" value="" hidden>
        <input type="text" name="action" id="action" value="add" hidden> <!-- for referring action required in php/group_user_manage page-->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info text-light">Add</button>
        

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
        <button id="add_user" data-bs-toggle="modal" data-bs-target="#userModal" class="user_manage"><i class="fas fa-user-plus"></i></button>
    <?php } ?>
</div>
   
    
</header>
<div class="container-fluid">
                <table id="group_user_data" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th data-column-id="user_name">User Name</th>
                    <th data-column-id="user_name">Admin</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $group_user_sql="select * from group_users where not user_id='".$user_id."' and group_unique_id='".$group_id."'";
                  $group_query=mysqli_query($conn, $group_user_sql);

                  $counter=0;
                    while($group_row=mysqli_fetch_assoc($group_query)){
                      echo '<tr><td>'.$group_row['user_fname'].' '.$group_row['user_lname'].'</td>';
                      echo '<td>';
                      if($group_row['admin_role']==1){
                          echo "Group Admin";
                      }else{
                        echo "User";
                      }
                      echo '</td>';
                      echo "<td><button type='button' title='Delete User' class='btn btn-danger btn-xs delete' onclick='delete_user(".$group_row['group_users_tbl_id'].")'><i class='fas fa-trash'></i></button></td></tr>";
                      $counter++;
                    }
                    if($counter==0){
                      echo '<tr> <td colspan="3"> No User added in the group yet.</td></tr>';
                    }

                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th data-column-id="user_name">User Name</th>
                    <th data-column-id="user_name">Admin</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Action</th>
                  </tr>
                  </tfoot>
                </table></div>

                </section>
</div>



<script src="js/group_user_manage.js"></script>





</body>
</html>