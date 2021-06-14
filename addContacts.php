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
<div class="wrapper">
    <section class="form" id="group_create_section">
        <header>Tambah Teman Baru</header> 
        <form method="GET" action="searchContact.php">
            <!--<div class="error-txt">Ini adalah pesan error</div>-->
            
                <div class="field input">
                    <label>ID Geluts</label>
                    <input type="text" placeholder="Masukkan ID Geluts" name="idGeluts" autocomplete="off" required>
                </div>
                   
                <div class="field button">
                    <input type="submit" id="submit_form" value="Cari ID Geluts">
                </div> 

        </form>
        
    </section>
</div>
<script src="js/group_create.js"></script>
</body>
</html>

