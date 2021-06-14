<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php"); //parameter untuk user harus login dulu
}


include_once "header.php";


include 'php/config.php';
$contactid = $_POST['user_id'];
$userid = $_SESSION['unique_id'];

$query = mysqli_query($conn, "SELECT user_id FROM users WHERE unique_id = $userid");

//var_dump($query); die;

    $result = mysqli_fetch_assoc($query);
    //var_dump($result); die;
   $idUser = implode(',', $result);
      
//echo $idUser; 
$sql = mysqli_query($conn, "INSERT INTO contacts VALUES('','$idUser','$contactid')");

//var_dump($sql); die;

if ($sql) {
  // code...
echo '<script>alert("Berhasil menambah teman")</script>'; 

header("location:contacts.php");
}else {
  echo '<script>alert("Gagal menambah teman")</script>'; 
}
 
?>