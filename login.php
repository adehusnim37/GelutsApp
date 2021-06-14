<?php
session_start();
if(isset($_SESSION['unique_id'])){
    header("location: users.php");
}
?>

<?php
include_once "header.php"
?>

<body>
<div class="wrapper">
    <section class="form login">
        <header>Realtime Chat App</header>
        <form action="#">
            <div class="error-txt">Ini adalah pesan error</div>
                <div class="field input">
                    <label>Alamat Email/Userid</label>
                    <input type="text" name="login" placeholder="Email atau gelutid">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Lanjut chat">
                </div>

        </form>
        <div class="link">Belum Punya Akun ? <a href="index.php">Daftar yuks</a></div>
    </section>
    <script src="js/pass-show-hide.js"></script>
    <script src="js/login.js"></script>
</div>
</body>
</html>
