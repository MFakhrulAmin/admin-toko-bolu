<?php
// jika belum login masuk ke menu login
if(isset($_SESSION['login'])){
    // kosongin
} else {
    header('location: pages-login.php');
}
?>