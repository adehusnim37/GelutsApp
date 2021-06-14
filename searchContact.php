<?php

include_once "header.php";
?>
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
          
?>


<body>
  <?php 
if(isset($_GET['idGeluts'])){
	$cari = $_GET['idGeluts'];
	
}
?>
<div class="wrapper">
    <section class="users">
        <header>Hasil pencarian ID Geluts : <?= $cari ?>
        <a title="My Contacts" href="contacts.php" class="logout"><i class="fas fa-user"></i></a>
            <a title="My Chat" href="users.php" class="logout"><i class="fas fa-comment"></i></a>
            <a title="create group" href="group_create.php?user_id=<?php echo $row['unique_id'] ?>" class="logout"><i class="fas fa-users"></i></a>
            <a title= "logout" href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout"><i class="fas fa-sign-out-alt"></i><!--Logout--></a>
        </header> 
     <?php
include_once "php/config.php";
$sql = mysqli_query($conn, "select * from users where gelutid = '$cari' AND unique_id != {$_SESSION['unique_id']}");

if(mysqli_num_rows($sql)>0){
  $row = mysqli_fetch_assoc($sql);
  ?>

  <form method="post" action="addContact-aksi.php">
   <div class="content">

            <img src="php/images/<?=$row['img'] ?>" alt="" width="100px" style="display: flex; align-items: center; margin: 15px 0 0 150px"><br>
            <div class="details" style="margin-left: 100px">
                <h3><?= $row['fname'] . " " . $row['lname'] ?></h3>
                
            </div>
            <br>
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
        
        <?php
$contactid = $row['user_id'];
$userid = $_SESSION['unique_id'];

$query = mysqli_query($conn, "SELECT user_id FROM users WHERE unique_id = $userid");

    $result = mysqli_fetch_assoc($query);
   $idUser = implode(',', $result);

$cekTeman = mysqli_query($conn, "SELECT * from contacts WHERE userid = $idUser AND contactid = $contactid");

//cek jika sudah teman
if (mysqli_num_rows($cekTeman)>0) { ?>
  <div class="field button">

		  <a href="chat.php?user_id=<?=$row['unique_id'] ?>" style="color: #fff; font-size: 17px; text-decoration: none; display: flex; justify-content: center;align-items:center; margin: 0px 0 0 100px; background: #333; padding: 10px 7px; border-radius: 5px; width: 200px">Kirim Pesan</a>

    </div> 
    </div>
<?php }else { ?>
  
                <div class="field button">
                    <input type="submit" value="Tambah Teman" style="color: #fff; font-size: 17px; text-decoration: none; display: flex; justify-content: center;align-items:center; margin: 0px 0 0 100px; background: #333; padding: 10px 7px; border-radius: 5px; width: 200px">
                </div> 
                </div>
                </form>
<?php }
?>

<?php	}else{ ?>
		<div class="error-txt" style="display: flex; justify-content: center; margin-top: 15px">ID tidak ditemukan</div>
		
		  <a href="addContacts.php" style="color: #fff; font-size: 17px; text-decoration: none; display: flex; justify-content: center; margin: 10px 0 0 100px; background: #333; padding: 10px 7px; border-radius: 5px; width: 200px">Kembali</a>
    </div> 
    
<?php	}
	
?>
    </section>
</div>
<script src="js/group_create.js"></script>
</body>
</html>

