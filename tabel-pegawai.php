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
				<h1>Tabel Pegawai</h1>
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item">Tables</li>
						<li class="breadcrumb-item active">Data Pegawai</li>
					</ol>
				</nav>
			</div>
			<!-- End Page Title -->

			<section class="section">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Tabel Data Pegawai</h5>

								<!-- Table with stripped rows -->
								<table class="table datatable">
									<thead>
										<tr>
											<th scope="col">ID</th>
											<th scope="col">Nama</th>
											<th scope="col">Jenis Kelamin</th>
											<th scope="col">Nomor HP</th>
											<th scope="col">Alamat</th>
											<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$pegawai = mysqli_query($dbconnect, "SELECT * FROM pegawai");
									while ($row = mysqli_fetch_array($pegawai)) {
									?>
										<tr>
											<td><?php echo $row['id_pegawai'] ?></td>
											<td><?php echo $row['nama_pegawai'] ?></td>
											<td><?php echo $row['jenis_kelamin'] ?></td>
											<td><?php echo "0".$row['no_hp'] ?></td>
											<td><?php echo $row['alamat'] ?></td>
											<td>
												<a type="button" href="edit-pegawai.php?id=<?php echo $row['id_pegawai'] ?>" class="btn btn-info btn-icon-split">
													<span class="icon text-white">
														<i class="fas fa-pen"></i>
													</span>
												</a>
												<a type="button" href="javascript:remove('hapus.php?id_pegawai=<?php echo $row['id_pegawai'] ?>')" class="btn btn-danger btn-icon-split">
													<span class="icon text-white">
														<i class="fas fa-times"></i>
													</span>
												</a>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
								<!-- End Table with stripped rows -->
								<button class="btn btn-primary" data-toggle="modal" data-target="#TambahPegawai">
									<i class="bi bi-plus-square"></i>
									<span class="text">Tambah Pegawai</span>
								</button>
							</div>
							<div class="modal fade" id="TambahPegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Tambah Data Pegawai</h5>
											<button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
											</button>
										</div>
										<div class="modal-body">
											<form method="POST" class="needs-validation" novalidate action="tambah/tambah.php">
												<div class="form-group mb-3">
													<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
												</div>
												<div class="input-group mb-3">
													<span class="input-group-text" id="basic-addon1">+62</span>
													<input type="number" name="no_hp" class="form-control" placeholder="No Handphone" aria-label="Nohandphone" aria-describedby="basic-addon1" required>
												</div>
												<div class="text-center my-3">
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="radio" name="gender" id="lk" value="Laki-laki" required>
														<label class="form-check-label" for="lk">Laki-laki</label>
													</div>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="radio" name="gender" id="pr" value="Perempuan">
														<label class="form-check-label" for="pr">Perempuan</label>
													</div>
												</div>
												<div class="form-group mb-3">
													<textarea class="form-control" name="alamat" style="height: 100px" placeholder="Alamat Lengkap" required></textarea>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" name="TambahPegawai">Save</button>
												</div>
											</form>
										</div>
									</div>
								</div>
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

		<!-- script delete pegawai  -->
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
