<?php
require 'function.php';
require 'cek-sesi-login.php';
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
		<?php include "sidebar.php"?>
		<!-- End Sidebar-->

		<main id="main" class="main">
			<div class="pagetitle">
				<h1>Tabel Penjualan</h1>
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item">Tables</li>
						<li class="breadcrumb-item active">Data Penjualan</li>
					</ol>
				</nav>
			</div>
			<!-- End Page Title -->

			<section class="section">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Tabel Data Penjualan</h5>

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
											<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$penjualan = mysqli_query($dbconnect, "SELECT penjualan.id_jual, penjualan.tanggal, pembeli.nama_pembeli,
                                                    produk.nama_produk, pegawai.nama_pegawai, produk.harga_jual, penjualan.qty, 
                                                    penjualan.total_bayar, penjualan.profit
                                                    FROM penjualan INNER JOIN pembeli
                                                    ON penjualan.id_pembeli = pembeli.id_pembeli INNER JOIN pegawai
                                                    ON penjualan.id_pegawai = pegawai.id_pegawai INNER JOIN produk
                                                    ON penjualan.id_produk = produk.id_produk ORDER BY id_jual DESC;");
									while ($row = mysqli_fetch_array($penjualan)) {
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
											<td>
												<a type="button" href="edit-penjualan.php?id=<?php echo $row['id_jual'] ?>" class="btn btn-info btn-icon-split">
													<span class="icon text-white">
														<i class="fas fa-pen"></i>
													</span>
												</a>
												<a type="button" href="javascript:remove('hapus.php?id_jual=<?php echo $row['id_jual'] ?>')" class="btn btn-danger btn-icon-split">
													<span class="icon text-white">
														<i class="fas fa-times"></i>
													</span>
												</a>
											</td>
										</tr>
									<?php } ?>
										<tr>
											<?php $output = mysqli_fetch_assoc(mysqli_query($dbconnect,"SELECT SUM(total_bayar) AS total, SUM(profit) AS profit FROM penjualan")) ?>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th>Jumlah</th>
											<th><?php echo "Rp. " . number_format($output['total'])?></th>
											<th><?php echo "Rp. " . number_format($output['profit'])?></th>
											<th></th>
										</tr>
									</tbody>
								</table>
								<!-- End Table with stripped rows -->
								<a href="tambah-penjualan.php" class="btn btn-primary">
									<i class="bi bi-plus-square"></i>
									<span class="text">Tambah Penjualan</span>
								</a>
								<a href="laporan-penjualan.php" class="btn btn-success">
									<i class="bi bi-folder"></i>
									<span class="text">Laporan Penjualan</span>
								</a>
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

		<!-- script delete  -->
		<script>
			function remove(URL) {
				Swal.fire({
					title: 'Apa kamu yakin?',
					text: "Data yang sudah dihapus tidak dapat dikembalikan!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes'
				}).then((result) => {
					if (result.value) {
						window.location.href = URL
					}
				})
			}
		</script>


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
