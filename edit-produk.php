<?php
require 'function.php';
require 'cek-sesi-login.php';

$id = $_GET['id'];
if(isset ($_POST["UpdateProduk"])) {
    $nama = $_POST["nama"];
    $jenis = $_POST["jenis"];
    $modal = $_POST["modal"];
    $h_jual = $_POST["h_jual"];
    $stok = $_POST["stok"];
    
    //update database
    mysqli_query($dbconnect, "UPDATE produk SET nama_produk = '$nama', jenis_produk = '$jenis', 
        modal_produksi = '$modal', harga_jual = '$h_jual', stok = '$stok' 
        WHERE id_produk = '$id'");
    header("location: tabel-produk.php");
}
$isi_data_produk = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT * FROM produk WHERE id_produk = '$id'"));

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />

		<title>Tabel Produk</title>
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
							<a href="tabel-produk.php" class="active"> <i class="bi bi-circle"></i><span>Produk</span> </a>
						</li>
						<li>
							<a href="tabel-pembeli.php"> <i class="bi bi-circle"></i><span>Pembeli</span> </a>
						</li>
						<li>
							<a href="tabel-penjualan.php" > <i class="bi bi-circle"></i><span>Penjualan</span> </a>
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
						<li class="breadcrumb-item"><a href="tabel-produk.php">Data Produk</a></li>
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
								<h5 class="card-title">Edit Data Produk</h5>
                                <form method="POST" class="needs-validation" novalidate action="">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Produk" value="<?= $isi_data_produk['nama_produk']; ?>" required>
                                        <label for="floatingInput">Nama Produk</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <?php if($isi_data_produk['jenis_produk'] == 'Premium') {?>
                                        <select class="form-select" name="jenis" aria-label="Floating label select example">
                                            <option value="Premium" selected>Premium</option>
                                            <option value="Biasa">Biasa</option>
                                        </select>
                                        <label for="floatingSelect">Jenis Produk</label>
                                        <?php } else {?>
                                        <select class="form-select" name="jenis" aria-label="Floating label select example">
                                            <option value="Premium">Premium</option>
                                            <option value="Biasa" selected>Biasa</option>
                                        </select>
                                        <label for="floatingSelect">Jenis Produk</label>
                                        <?php }?>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="modal" placeholder="Modal Produksi" required value="<?= $isi_data_produk['modal_produksi']; ?>" oninput="validity.valid||(value='');" min="0">
                                        <label for="floatingInput">Modal Produksi</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="h_jual" placeholder="Harga Jual" required value="<?= $isi_data_produk['harga_jual']; ?>" oninput="validity.valid||(value='');" min="0">
                                        <label for="floatingInput">Harga Jual</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="stok" placeholder="Stok" required value="<?= $isi_data_produk['stok']; ?>" oninput="validity.valid||(value='');" min="0">
                                        <label for="floatingInput">Stok</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <button class="btn btn-success" name="UpdateProduk"><i class="bi bi-check-circle"></i> Update</button>
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
