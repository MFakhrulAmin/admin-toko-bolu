<?php
require '../function.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset ($_POST["TambahPegawai"])) {
        $nama = test_input($_POST["nama"]);
        $gender = test_input($_POST["gender"]);
        $no_hp = test_input($_POST["no_hp"]);
        $alamat = test_input($_POST["alamat"]);
        
        //insert database
        mysqli_query($dbconnect, "INSERT INTO pegawai(`nama_pegawai`,`jenis_kelamin`, `no_hp`, `alamat`) VALUES('$nama', '$gender', '$no_hp', '$alamat');");
        header("location:../tabel-pegawai.php");
	}

    if(isset ($_POST["TambahProduk"])) {
        $nama = test_input($_POST["nama"]);
        $jenis = test_input($_POST["jenis"]);
        $modal = test_input($_POST["modal"]);
        $h_jual = test_input($_POST["h_jual"]);
        $stok = test_input($_POST["stok"]);

        // uploadan gambar
        $filename = $_FILES["img"]["name"];
        if($filename != '') {
            $ekstensi = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $ekstensi_valid = array("jpg", "jpeg", "png", "gif");
            if(in_array($ekstensi, $ekstensi_valid)){
                $img_base64 = base64_encode(file_get_contents($_FILES["img"]["tmp_name"]));
                $img = "data::image/".$ekstensi.";base64,".$img_base64;
                
                //insert database
                $query = "INSERT INTO `produk` (`nama_produk`, `jenis_produk`, `modal_produksi`, `harga_jual`, `stok`, `img`) VALUES ('$nama', '$jenis', '$modal', '$h_jual', '$stok', '$img');";
                mysqli_query($dbconnect, $query);
                header("location:../tabel-produk.php");
            }
        }
	}

    if(isset ($_POST["TambahPembeli"])) {
        $nama = test_input($_POST["nama"]);
        $gender = test_input($_POST["gender"]);
        
        //insert database
        mysqli_query($dbconnect, "INSERT INTO `pembeli` (`nama_pembeli`,`jenis_kelamin`) VALUES('$nama', '$gender');");
        header("location:../tabel-pembeli.php");
	}

    if(isset ($_POST["TambahPenjualan1"])) {
        $idpegawai = test_input($_POST["pegawai1"]);
        $idpembeli = test_input($_POST["pembeli1"]);
        $idproduk = test_input($_POST["produk1"]);
        $qty = test_input($_POST["qty1"]);
        $date = date('Y-m-d', strtotime($_POST["date1"]));
        $total_bayar = 0;
        $profit = 0;
        
        // hitung total bayar dan profit
        $produk = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT modal_produksi ,harga_jual FROM produk WHERE id_produk = '$idproduk'"));
        $total_bayar = $produk['harga_jual'] * $qty;
        $profit = ($produk['harga_jual'] - $produk['modal_produksi']) * $qty;
        
        // cek stok
        $stok = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT stok FROM produk WHERE id_produk = '$idproduk'"));
        $stok = $stok['stok'];

        // insert database
        if(!mysqli_query($dbconnect, "INSERT INTO `penjualan` (`tanggal`,`id_pegawai`, `id_pembeli`, `id_produk`, `qty`, `total_bayar`, `profit`) 
                    VALUES('$date', '$idpegawai', '$idpembeli', '$idproduk', '$qty', '$total_bayar', '$profit');")) {
            echo '<script>alert("Stok produk tidak mencukupi. Stok tersedia : '.$stok.'");history.go(-1);</script>';
        } else {
            header("location:../tabel-penjualan.php");
        }
	}

    if(isset ($_POST["TambahPenjualan2"])) {
        // data pembeli baru
        $nama_pembeli = test_input($_POST["nama_pembeli"]);
        $gender = test_input($_POST["gender"]);
        
        //insert pembeli ke database terlebih dahulu
        mysqli_query($dbconnect, "INSERT INTO `pembeli` (`nama_pembeli`,`jenis_kelamin`) VALUES('$nama_pembeli', '$gender');");
        $pembeli = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT id_pembeli FROM pembeli ORDER BY id_pembeli DESC LIMIT 1"));
        $idpembeli = $pembeli['id_pembeli'];
        $idpegawai = test_input($_POST["pegawai2"]);
        $idproduk = test_input($_POST["produk2"]);
        $qty = test_input($_POST["qty2"]);
        $date = date('Y-m-d', strtotime($_POST["date2"]));
        $total_bayar = 0;
        $profit = 0;
        
        // hitung total bayar dan profit
        $produk = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT modal_produksi ,harga_jual FROM produk WHERE id_produk = '$idproduk'"));
        $total_bayar = $produk['harga_jual'] * $qty;
        $profit = ($produk['harga_jual'] - $produk['modal_produksi']) * $qty;

        // cek stok
        $stok = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT stok FROM produk WHERE id_produk = '$idproduk'"));
        $stok = $stok['stok'];

        // insert database
        if(!mysqli_query($dbconnect, "INSERT INTO `penjualan` (`tanggal`,`id_pegawai`, `id_pembeli`, `id_produk`, `qty`, `total_bayar`, `profit`) 
                    VALUES('$date', '$idpegawai', '$idpembeli', '$idproduk', '$qty', '$total_bayar', '$profit');")) {
            echo '<script>alert("Stok produk tidak mencukupi. Stok tersedia : '.$stok.'");history.go(-1);</script>';
        } else {
            header("location:../tabel-penjualan.php");
        }
	}
}
?>
