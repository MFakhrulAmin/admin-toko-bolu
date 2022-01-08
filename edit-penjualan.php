<?php
require 'function.php';
require 'cek-sesi-login.php';


$id = $_GET['id'];
$isi_penjualan = mysqli_fetch_assoc(
    mysqli_query($dbconnect, "SELECT penjualan.id_jual, penjualan.tanggal, pembeli.id_pembeli,
    produk.id_produk, pegawai.id_pegawai, penjualan.qty
    FROM penjualan INNER JOIN pembeli
    ON penjualan.id_pembeli = pembeli.id_pembeli INNER JOIN pegawai
    ON penjualan.id_pegawai = pegawai.id_pegawai INNER JOIN produk
    ON penjualan.id_produk = produk.id_produk WHERE id_jual = '$id';")
    );
    
if(isset ($_POST["UpdatePenjualan"])) {
    $idpembeli = test_input($_POST['pembeli']);
    $idpegawai = test_input($_POST["pegawai"]);
    $idproduk = test_input($_POST["produk"]);
    $qty = test_input($_POST["qty"]);
    $date = date('Y-m-d', strtotime($_POST["date"]));
    $total_bayar = 0;
    $profit = 0;
    
    // hitung total bayar dan profit
    $produk = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT modal_produksi ,harga_jual FROM produk WHERE id_produk = '$idproduk'"));
    $total_bayar = $produk['harga_jual'] * $qty;
    $profit = ($produk['harga_jual'] - $produk['modal_produksi']) * $qty;

    
    // update database
    mysqli_query($dbconnect, "UPDATE penjualan SET id_pegawai = '$idpegawai', id_pembeli = '$idpembeli', 
        id_produk = '$idproduk', qty = '$qty', tanggal = '$date', total_bayar = '$total_bayar', profit = '$profit' 
        WHERE id_jual = '$id'");
    header("location: tabel-penjualan.php");
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />

		<title>Tabel Penjualan</title>
		<meta content="" name="description" />
		<meta content="" name="keywords" />

		<!-- Favicons -->
		<link href="assets/img/favicon.png" rel="icon" />
		<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

		<!-- Font Awesome -->
		<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"/>


		<!-- Google Fonts -->
		<link href="https://fonts.gstatic.com" rel="preconnect" />
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

		<!-- Vendor CSS Files -->
		<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
		<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
		<link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
		<link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
		<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
		<link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

		<!-- Template Main CSS File -->
		<link href="assets/css/style.css" rel="stylesheet" />

		<!-- =======================================================
  * Template Name: NiceAdmin - v2.2.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
    ======================================================== -->
	</head>

	<body>
	
		<!-- ======= Header ======= -->
		<?php include "header.html"?>
		<!-- End Header -->

		<!-- ======= Sidebar ======= -->
		<aside id="sidebar" class="sidebar">
			<ul class="sidebar-nav" id="sidebar-nav">
				<li class="nav-item">
					<a class="nav-link collapsed" href="index.php">
						<i class="bi bi-grid"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<!-- End Dashboard Nav -->

				<li class="nav-item">
					<a class="nav-link" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i> </a>
					<ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
						<li>
							<a href="tabel-pegawai.php"> <i class="bi bi-circle"></i><span>Pegawai</span> </a>
						</li>
						<li>
							<a href="tabel-produk.php" > <i class="bi bi-circle"></i><span>Produk</span> </a>
						</li>
						<li>
							<a href="tabel-pembeli.php"> <i class="bi bi-circle"></i><span>Pembeli</span> </a>
						</li>
						<li>
							<a href="tabel-penjualan.php" class="active"> <i class="bi bi-circle"></i><span>Penjualan</span> </a>
						</li>
					</ul>
				</li>
				<!-- End Tables Nav -->
			</ul>
		</aside>
		<!-- End Sidebar-->

		<main id="main" class="main">
			<div class="pagetitle">
				<h1>Tabel Produk</h1>
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item">Tables</li>
						<li class="breadcrumb-item"><a href="tabel-penjualan.php">Data Penjualan</a></li>
						<li class="breadcrumb-item active">Edit</li>
					</ol>
				</nav>
			</div>
			<!-- End Page Title -->

			<section class="section">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Edit Data Penjualan</h5>
                                <form method="POST" class="needs-validation" novalidate action="">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" aria-label="Pegawai" name="pegawai" required>
                                            <option value="" disabled="" selected>Pilih Pegawai</option>
                                            <?php 
                                            $pegawai = mysqli_query($dbconnect, "SELECT * FROM pegawai");
                                            while ($row = mysqli_fetch_array($pegawai)) {
                                            ?>
                                            <option value="<?= $row['id_pegawai'] ?>" <?php if($row['id_pegawai'] == $isi_penjualan['id_pegawai']) echo 'selected'; ?>><?= $row['nama_pegawai'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="floatingSelect">Pegawai</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" aria-label="Pembeli" name="pembeli" required>
                                            <option value="" disabled="" selected>Pilih Pembeli</option>
                                            <?php 
                                            $pembeli = mysqli_query($dbconnect, "SELECT * FROM pembeli");
                                            while ($row = mysqli_fetch_array($pembeli)) {
                                            ?>
                                            <option value="<?= $row['id_pembeli'] ?>" <?php if($row['id_pembeli'] == $isi_penjualan['id_pembeli']) echo 'selected'; ?>><?= $row['nama_pembeli'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="floatingSelect">Pembeli</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" aria-label="Produk" name="produk" required>
                                            <option value="" disabled="" selected>Pilih Produk</option>
                                            <?php 
                                            $produk = mysqli_query($dbconnect, "SELECT * FROM produk");
                                            while ($row = mysqli_fetch_array($produk)) {
                                            ?>
                                            <option value="<?= $row['id_produk'] ?>" <?php if($row['id_produk'] == $isi_penjualan['id_produk']) echo 'selected'; ?>><?= $row['nama_produk'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="floatingSelect">Produk</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="qty" placeholder="Jumlah Produk" value="<?= $isi_penjualan['qty']; ?>" required oninput="validity.valid||(value='');" min="0">
                                        <label for="floatingInput">Jumlah Beli</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" name="date" value="<?= $isi_penjualan['tanggal']; ?>" placeholder="Jumlah Produk" required>
                                        <label for="floatingInput">Tanggal</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="UpdatePenjualan">Save</button>
                                        <button type="reset" class="btn btn-secondary" >Reset</button>
                                    </div>
                                </form>
                                
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
		<!-- End #main -->

		<!-- ======= Footer ======= -->
		<footer id="footer" class="footer">
			<div class="copyright">
				&copy; Copyright <strong><span>NiceAdmin</span></strong
				>. All Rights Reserved
			</div>
			<div class="credits">
				<!-- All the links in the footer should remain intact. -->
				<!-- You can delete the links only if you purchased the pro version. -->
				<!-- Licensing information: https://bootstrapmade.com/license/ -->
				<!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
				Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
			</div>
		</footer>
		<!-- End Footer -->

		<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

		

		<!-- Vendor JS Files -->
		<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="assets/vendor/chart.js/chart.min.js"></script>
		<script src="assets/vendor/echarts/echarts.min.js"></script>
		<script src="assets/vendor/quill/quill.min.js"></script>
		<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
		<script src="assets/vendor/tinymce/tinymce.min.js"></script>
		<script src="assets/vendor/php-email-form/validate.js"></script>

		
		<!-- Template Main JS File -->
		<script src="assets/js/main.js"></script>
	</body>
	
</html>
