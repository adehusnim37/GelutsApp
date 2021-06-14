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
          Hasil pencarian ID Geluts : <?= $cari ?>
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
     <?php
include_once "php/config.php";
$sql = mysqli_query($conn, "select * from users where gelutid = '$cari' AND unique_id != {$_SESSION['unique_id']}");

if(mysqli_num_rows($sql)>0){
  $row = mysqli_fetch_assoc($sql);
  ?>
  <form method="post" action="addContact-aksi.php">
   <div class="content">

            <img src="php/images/<?=$row['img'] ?>" alt="" width="100px"><br>
            <div class="details">
                <span><?= $row['fname'] . " " . $row['lname'] ?> </span>
                
            </div>
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
        </div>
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

		  <a href="chat.php?user_id=<?=$row['unique_id'] ?>">Kirim Pesan</a>

    </div> 
<?php }else { ?>
  
                <div class="field button">
                    <input type="submit" value="Tambah Teman">
                </div> 
                </form>
<?php }
?>

<?php	}else{ ?>
		<div class="error-txt">ID tidak ditemukan</div>
		<div class="field button">
		  <a href="addContacts.php">Kembali</a>
    </div> 
<?php	}
	
?>
    </section>
</div>
</body>
</html>