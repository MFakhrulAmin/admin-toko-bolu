<?php
    include 'function.php';
    
    if(!empty($_GET['id_pegawai'])){
        mysqli_query($dbconnect, "DELETE FROM pegawai WHERE id_pegawai = '".$_GET['id_pegawai']."' ");
        echo '<script>window.location="tabel-pegawai.php"</script>';
    }

    if(!empty($_GET['id_produk'])){
        mysqli_query($dbconnect, "DELETE FROM produk WHERE id_produk = '".$_GET['id_produk']."' ");
        echo '<script>window.location="tabel-produk.php"</script>';
    }

    if(!empty($_GET['id_pembeli'])){
        mysqli_query($dbconnect, "DELETE FROM pembeli WHERE id_pembeli = '".$_GET['id_pembeli']."' ");
        echo '<script>window.location="tabel-pembeli.php"</script>';
    }

    if(!empty($_GET['id_jual'])){
        mysqli_query($dbconnect, "DELETE FROM penjualan WHERE id_jual = '".$_GET['id_jual']."' ");
        echo '<script>window.location="tabel-penjualan.php"</script>';
    }
?>