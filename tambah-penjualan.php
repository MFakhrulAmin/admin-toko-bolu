<?php
require 'function.php';
require 'cek-sesi-login.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />

		<title>Tabel Pegawai</title>
		<meta content="" name="description" />
		<meta content="" name="keywords" />

		<!-- Favicons -->
		<link href="assets/img/favicon.png" rel="icon" />
		<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

		<!-- Font Awesome -->
		<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"/>

		<!-- Select picker -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

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
							<a href="tabel-produk.php"> <i class="bi bi-circle"></i><span>Produk</span> </a>
						</li>
						<li>
							<a href="tabel-pembeli.php"> <i class="bi bi-circle"></i><span>Pembeli</span> </a>
						</li>
						<li>
							<a href="tabel-penjualan.php" class="active" > <i class="bi bi-circle"></i><span>Penjualan</span> </a>
						</li>
					</ul>
				</li>
				<!-- End Tables Nav -->
			</ul>
		</aside>
		<!-- End Sidebar-->

		<main id="main" class="main">
			<div class="pagetitle">
				<h1>Tabel Penjualan</h1>
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item">Tables</li>
						<li class="breadcrumb-item"><a href="tabel-penjualan.php">Data Penjualan</a></li>
						<li class="breadcrumb-item active">Tambah</li>
					</ol>
				</nav>
			</div>
			<!-- End Page Title -->

			<section class="section">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Tambah Data Penjualan</h5>
                                <!-- Pills Tabs -->
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Pembeli yang sudah terdaftar</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Pembeli yang belum terdaftar</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2" id="myTabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="home-tab">
                                        <form method="POST" class="needs-validation" novalidate action="tambah/tambah.php">
											<div class="form-floating mb-3">
												<select class="form-select" aria-label="Pegawai" name="pegawai1" required>
													<option value="" disabled="" selected>Pilih Pegawai</option>
													<?php 
													$pegawai = mysqli_query($dbconnect, "SELECT * FROM pegawai");
													while ($row = mysqli_fetch_array($pegawai)) {
													?>
													<option value="<?= $row['id_pegawai'] ?>"><?= $row['nama_pegawai'] ?></option>
													<?php } ?>
												</select>
												<label for="floatingSelect">Pegawai</label>
											</div>
											<div class="form-floating mb-3">
												<select class="form-select" aria-label="Pembeli" name="pembeli1" required>
													<option value="" disabled="" selected>Pilih Pembeli</option>
													<?php 
													$pembeli = mysqli_query($dbconnect, "SELECT * FROM pembeli");
													while ($row = mysqli_fetch_array($pembeli)) {
													?>
													<option value="<?= $row['id_pembeli'] ?>"><?= $row['nama_pembeli'] ?></option>
													<?php } ?>
												</select>
												<label for="floatingSelect">Pembeli</label>
											</div>
											<div class="form-floating mb-3">
												<select class="form-select" aria-label="Produk" name="produk1" required>
													<option value="" disabled="" selected>Pilih Produk</option>
													<?php 
													$produk = mysqli_query($dbconnect, "SELECT * FROM produk");
													while ($row = mysqli_fetch_array($produk)) {
													?>
													<option value="<?= $row['id_produk'] ?>"><?= $row['nama_produk'] ?></option>
													<?php } ?>
												</select>
												<label for="floatingSelect">Produk</label>
											</div>
											<div class="form-floating mb-3">
												<input type="number" class="form-control" name="qty1" placeholder="Jumlah Produk" required oninput="validity.valid||(value='');" min="0">
												<label for="floatingInput">Jumlah Beli</label>
											</div>
											<div class="form-floating mb-3">
												<input type="date" class="form-control" name="date1" placeholder="Jumlah Produk" required>
												<label for="floatingInput">Tanggal</label>
											</div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="TambahPenjualan1">Save</button>
                                                <button type="reset" class="btn btn-secondary" >Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="profile-tab">
										<form method="POST" class="needs-validation" novalidate action="tambah/tambah.php">
											<div class="form-floating mb-3">
												<input type="text" class="form-control" name="nama_pembeli" placeholder="Nama Pembeli" required>
												<label>Nama Pembeli</label>
											</div>
											<fieldset class="row mb-3">
											<legend class="col-form-label col-sm-2 pt-0">&nbsp &nbsp&nbspJenis Kelamin</legend>
												<div class="col-sm-10">
													<div class="form-check">
														<input class="form-check-input" type="radio" name="gender" id="lk" value="Laki-laki" required>
														<label class="form-check-label" for="lk">
															Laki-laki
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="radio" name="gender" id="pr" value="Perempuan">
														<label class="form-check-label" for="pr">
															Perempuan
														</label>
													</div>
												</div>
											</fieldset>
											<div class="form-floating mb-3">
												<select class="form-select" aria-label="Pegawai" name="pegawai2" required>
													<option value="" disabled="" selected>Pilih Pegawai</option>
													<?php 
													$pegawai = mysqli_query($dbconnect, "SELECT * FROM pegawai");
													while ($row = mysqli_fetch_array($pegawai)) {
													?>
													<option value="<?= $row['id_pegawai'] ?>"><?= $row['nama_pegawai'] ?></option>
													<?php } ?>
												</select>
												<label>Pegawai</label>
											</div>
											<div class="form-floating mb-3">
												<select class="form-select" aria-label="Produk" name="produk2" required>
													<option value="" disabled="" selected>Pilih Produk</option>
													<?php 
													$produk = mysqli_query($dbconnect, "SELECT * FROM produk");
													while ($row = mysqli_fetch_array($produk)) {
													?>
													<option value="<?= $row['id_produk'] ?>"><?= $row['nama_produk'] ?></option>
													<?php } ?>
												</select>
												<label>Produk</label>
											</div>
											<div class="form-floating mb-3">
												<input type="number" class="form-control" name="qty2" placeholder="Jumlah Produk" required oninput="validity.valid||(value='');" min="0">
												<label>Jumlah Beli</label>
											</div>
											<div class="form-floating mb-3">
												<input type="date" class="form-control" name="date2" placeholder="Tanggal" required>
												<label>Tanggal</label>
											</div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="TambahPenjualan2">Save</button>
                                                <button type="reset" class="btn btn-secondary" >Reset</button>
                                            </div>
                                        </form>
									</div>
                                </div><!-- End Pills Tabs -->
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
		
		<!-- Select picker -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

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
