<?php
require 'function.php';
require 'cek-sesi-login.php';

$tahun_ini = date("Y");
$bulan_ini = date("Y-m");
$hari_ini = date("Y-m-d");

$tahunan = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT DATE_FORMAT(tanggal,'%Y') AS tahun_bulan, SUM(total_bayar) AS pend_tahunan, SUM(profit) AS profit_tahunan FROM penjualan WHERE DATE_FORMAT(tanggal,'%Y') = '$tahun_ini';"));
$bulanan = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT DATE_FORMAT(tanggal,'%Y-%m') AS tahun_bulan, SUM(total_bayar) AS pend_bulanan, SUM(profit) AS profit_bulanan FROM penjualan WHERE DATE_FORMAT(tanggal,'%Y-%m') = '$bulan_ini';"));
$harian = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT DATE_FORMAT(tanggal,'%Y-%m-%d') AS harian, SUM(total_bayar) AS pend_harian, SUM(profit) AS profit_harian FROM penjualan WHERE DATE_FORMAT(tanggal,'%Y-%m-%d') = '$hari_ini';"));
// echo "<br><br><br><br><br><br>";
// echo $bulanan['pend_bulanan']."<br>";
// echo $bulanan['profit_bulanan']."<br><br>";

$jml_pegawai = mysqli_num_rows(mysqli_query($dbconnect, "SELECT * FROM pegawai"));
$jml_pembeli = mysqli_num_rows(mysqli_query($dbconnect, "SELECT * FROM pembeli"));


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />

		<title>Dashboard</title>
		<meta content="" name="description" />
		<meta content="" name="keywords" />

		<!-- Favicons -->
		<link href="assets/img/favicon.png" rel="icon" />
		<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

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
		<?php include 'header.html'?>
		<!-- End Header-->

		<!-- ======= Sidebar ======= -->
		<?php include 'sidebar.php'?>
		<!-- End Sidebar-->

		<main id="main" class="main">
			<div class="pagetitle">
				<h1>Dashboard</h1>
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Home</a></li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</nav>
			</div>
			<!-- End Page Title -->

			<section class="section dashboard">
				<div class="row">
					<!-- Left side columns -->
					<div class="col-lg-12">
						<div class="row">
							<!-- Revenue Card -->
							<div class="col-xxl-4 col-md-4">
								<div class="card info-card sales-card">
									<div class="card-body">
										<h5 class="card-title">Pendapatan <span>| Hari ini</span></h5>

										<div class="d-flex align-items-center">
											<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
												<i class="bi bi-currency-dollar"></i>
											</div>
											<div class="ps-3">
												<h6><?php echo "Rp. " . number_format($harian['pend_harian']) ?> </h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xxl-4 col-md-4">
								<div class="card info-card sales-card">
									<div class="card-body">
										<h5 class="card-title">Pendapatan <span>| Bulan ini</span></h5>

										<div class="d-flex align-items-center">
											<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
												<i class="bi bi-currency-dollar"></i>
											</div>
											<div class="ps-3">
												<h6><?php echo "Rp. " . number_format($bulanan['pend_bulanan']) ?></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xxl-4 col-md-4">
								<div class="card info-card sales-card">
									<div class="card-body">
										<h5 class="card-title">Pendapatan <span>| Tahun ini</span></h5>

										<div class="d-flex align-items-center">
											<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
												<i class="bi bi-currency-dollar"></i>
											</div>
											<div class="ps-3">
												<h6><?php echo "Rp. " . number_format($tahunan['pend_tahunan']) ?></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Revenue Card -->

							<!-- Profit Card -->
							<div class="col-xxl-4 col-md-4">
								<div class="card info-card revenue-card">
									<div class="card-body">
										<h5 class="card-title">Keuntungan <span>| Hari ini</span></h5>

										<div class="d-flex align-items-center">
											<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
												<i class="bi bi-currency-dollar"></i>
											</div>
											<div class="ps-3">
												<h6><?php echo "Rp. " . number_format($harian['profit_harian']) ?></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xxl-4 col-md-4">
								<div class="card info-card revenue-card">
									<div class="card-body">
										<h5 class="card-title">Keuntungan <span>| Bulan ini</span></h5>

										<div class="d-flex align-items-center">
											<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
												<i class="bi bi-currency-dollar"></i>
											</div>
											<div class="ps-3">
												<h6><?php echo "Rp. " . number_format($bulanan['profit_bulanan']) ?></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xxl-4 col-md-4">
								<div class="card info-card revenue-card">
									<div class="card-body">
										<h5 class="card-title">Keuntungan <span>| Tahun ini</span></h5>

										<div class="d-flex align-items-center">
											<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
												<i class="bi bi-currency-dollar"></i>
											</div>
											<div class="ps-3">
												<h6><?php echo "Rp. " . number_format($tahunan['profit_tahunan']) ?></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Profit Card -->

							<!-- Employee Card -->
							<div class="col-xxl-6 col-xl-6">
								<div class="card info-card employee-card">
									<div class="card-body">
										<h5 class="card-title">Pegawai</h5>

										<div class="d-flex align-items-center">
											<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
												<i class="bi bi-people"></i>
											</div>
											<div class="ps-3">
												<h6><?php echo $jml_pegawai ?></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Employee Card -->

							<!-- Customer Card -->
							<div class="col-xxl-6 col-xl-6">
								<div class="card info-card employee-card">
									<div class="card-body">
										<h5 class="card-title">Pelanggan</h5>

										<div class="d-flex align-items-center">
											<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
												<i class="bi bi-people"></i>
											</div>
											<div class="ps-3">
												<h6><?php echo $jml_pembeli ?></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Customer Card -->

							<!-- Top Selling -->
							<div class="pagetitle mb-4">
								<h1>Produk Terlaris</h1>
							</div>
							<?php 
							$noUrut = 1;
							$terlaris = mysqli_query($dbconnect, "SELECT SUM(qty) AS total, penjualan.id_produk, produk.nama_produk, produk.img FROM penjualan INNER JOIN produk ON penjualan.id_produk = produk.id_produk GROUP BY penjualan.id_produk ORDER BY total DESC LIMIT 3");
							while($urutan = mysqli_fetch_assoc($terlaris)) { ?>
							<div class="col-4">
								<div class="card">
									<img src="<?php echo $urutan['img'];?>" class="card-img-top" alt="..." height="300px">
									<div class="card-body">
										<h5 class="card-title"><?php echo $urutan['nama_produk'].' #'.$noUrut++;?></h5>
										<p class="card-text">Total penjualan mencapai : <?php echo $urutan['total']?> produk</p>
									</div>
								</div>
							</div>

							<?php }?>
							<!-- End Top Selling -->
						</div>
					</div>
					<!-- End Left side columns -->
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

		<!-- bootstrap -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<!-- Template Main JS File -->
		<script src="assets/js/main.js"></script>
	</body>
</html>
