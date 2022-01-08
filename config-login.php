<?php

// cek login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cekdb = mysqli_query($dbconnect, "SELECT * FROM `login` where username='$username' and password='$password'");
        $count = mysqli_num_rows($cekdb);
        if($count > 0) {
            $_SESSION['login'] = 'true';
            header('location: index.php');
        } else {
            echo '<script>alert("Login Gagal");history.go(-1);</script>';
        }
    }
}
?>