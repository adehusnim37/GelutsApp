<?php

    session_start();
    if(isset($_SESSION['unique_id'])){
        header("location: users.php");
    }
?>

<?php include_once "header.php"?>
<body>
<div class="wrapper">
    <section class="form signup">
        <header>Gelut Chat App</header>
        <form action="#">
            <div class="error-txt" id="error-txt">Ini adalah pesan error</div>
            <div class="field input">
                <label>IDGlut</label>
                <input type="text" placeholder="IDGluts" name="gelutid" required>
            </div>
            <div class="name-details">
                <div class="field input">
                    <label>Nama Depan</label>
                    <input type="text" placeholder="Nama Depan" name="fname" required>
                </div>
                <div class="field input">
                    <label>Nama Belakang</label>
                    <input type="text" placeholder="Nama Belakang" name="lname" required>
                </div>
            </div>
                <div class="field input">
                    <label>Alamat Email</label>
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" placeholder="Password" name="password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="File" name="image">
                </div>
                <div class="field button">
                    <input type="submit" value="Lanjut chat">
                </div>

        </form>
        <div class="link">Punya Akun ? <a href="login.php">Login yuks</a></div>
    </section>
</div>
<script src="js/pass-show-hide.js"></script>
<script src="js/signup.js"></script>
</body>
</html>

