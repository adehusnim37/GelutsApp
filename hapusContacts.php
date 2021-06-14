<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php"); //parameter untuk user harus login dulu
}

include_once "header.php";

 
$id = $_GET['id'];
include_once "php/config.php";
$query = mysqli_query($conn, "SELECT user_id FROM users WHERE unique_id = {$_SESSION['unique_id']}");

    while($result = mysqli_fetch_assoc($query)){
      $userid = $result['user_id']; }
 
mysqli_query($conn, "DELETE FROM contacts WHERE contactid='$id' AND userid = $userid")or die(mysql_error());
 
header("location:contacts.php");
?>