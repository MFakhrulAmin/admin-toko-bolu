<?php
require 'function.php';
require 'cek-sesi-login.php';

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />

		<title>Laporan Penjualan</title>
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

		<!-- sweet alert -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">


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
				<h1>Tabel Penjualan</h1>
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item">Tables</li>
						<li class="breadcrumb-item"><a href="tabel-penjualan.php">Data Penjualan</a></li>
						<li class="breadcrumb-item active">Laporan</li>
					</ol>
				</nav>
			</div>
			<!-- End Page Title -->

			<section class="section">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Laporan Data Penjualan</h5>
                                <form method="GET" action="" class="row g-3 mb-4">
                                    <div class="col-md-2">
                                        <select class="form-select" name="tahun" required>
                                            <option selected value="" disabled="">Pilih tahun</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select" name="bulan" required>
                                            <option selected value="" disabled="">Pilih bulan</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" name="filter" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </form>

								<!-- Table with stripped rows -->
								<table class="table datatable">
									<thead>
										<tr>
											<th scope="col">Tanggal</th>
											<th scope="col">Pembeli</th>
											<th scope="col">Produk</th>
											<th scope="col">Pegawai</th>
											<th scope="col">Harga</th>
											<th scope="col">Qty</th>
											<th scope="col">Total Bayar</th>
											<th scope="col">Profit</th>
										</tr>
									</thead>
									<tbody>
									<?php
                                    if(isset ($_GET["filter"])) {
                                        $tahun = $_GET['tahun'];
                                        $bulan = $_GET['bulan'];
                                        // update database
                                        $query = "SELECT penjualan.tanggal, pembeli.nama_pembeli,
                                        produk.nama_produk, pegawai.nama_pegawai, produk.harga_jual, penjualan.qty, 
                                        penjualan.total_bayar, penjualan.profit
                                        FROM penjualan INNER JOIN pembeli
                                        ON penjualan.id_pembeli = pembeli.id_pembeli INNER JOIN pegawai
                                        ON penjualan.id_pegawai = pegawai.id_pegawai INNER JOIN produk
                                        ON penjualan.id_produk = produk.id_produk WHERE DATE_FORMAT(penjualan.tanggal,'%Y-%m') = '$tahun-$bulan'";
                                    
									$data = mysqli_query($dbconnect, $query);
									while ($row = mysqli_fetch_array($data)) {
									?>
										<tr>
											<td><?php echo $row['tanggal'] ?></td>
											<td><?php echo $row['nama_pembeli'] ?></td>
											<td><?php echo $row['nama_produk'] ?></td>
											<td><?php echo $row['nama_pegawai'] ?></td>
											<td><?php echo "Rp. " . number_format($row['harga_jual']) ?></td>
											<td><?php echo $row['qty'] ?></td>
											<td><?php echo "Rp. " . number_format($row['total_bayar']) ?></td>
											<td><?php echo "Rp. " . number_format($row['profit']) ?></td>
										</tr>
									<?php }} ?>
									</tbody>
								</table>
								<!-- End Table with stripped rows -->
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

		<!-- sweet alert -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

	</body>
</html>
