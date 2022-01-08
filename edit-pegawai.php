<?php
require 'function.php';
require 'cek-sesi-login.php';

$id = $_GET['id'];
if (isset($_POST["UpdatePegawai"])) {
	$nama = $_POST["nama"];
	$gender = $_POST["gender"];
	$no_hp = $_POST["no_hp"];
	$alamat = $_POST["alamat"];
	
    //update database
    mysqli_query($dbconnect,"UPDATE pegawai SET nama_pegawai = '$nama', jenis_kelamin = '$gender', no_hp = '$no_hp',
		alamat = '$alamat'
        WHERE id_pegawai = '$id'");
    header("Location: tabel-pegawai.php");
}
$isi_data_pegawai = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT * FROM pegawai WHERE id_pegawai = '$id'"));



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
							<a href="tabel-pegawai.php" class="active"> <i class="bi bi-circle"></i><span>Pegawai</span> </a>
						</li>
						<li>
							<a href="tabel-produk.php"> <i class="bi bi-circle"></i><span>Produk</span> </a>
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
				<h1>Tabel Pegawai</h1>
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item">Tables</li>
						<li class="breadcrumb-item"><a href="tabel-pegawai.php">Data Pegawai</a></li>
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
								<h5 class="card-title">Edit Data Pegawai</h5>
                                <form method="POST" class="needs-validation" novalidate action="">
                                    <div class="row mb-3">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama" class="form-control" value="<?= $isi_data_pegawai['nama_pegawai']; ?>" required>
                                        </div>
                                    </div>
                                    <fieldset class="row mb-3">
									<legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
										<div class="col-sm-10">
											<?php if($isi_data_pegawai['jenis_kelamin'] == 'Laki-laki') { ?>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="gender" id="lk" value="Laki-laki" checked required>
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
											<?php } else { ?>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="gender" id="lk" value="Laki-laki" required>
												<label class="form-check-label" for="lk">
													Laki-laki
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="gender" id="pr" value="Perempuan" checked>
												<label class="form-check-label" for="pr">
													Perempuan
												</label>
											</div>
											<?php } ?>
										</div>
									</fieldset>
									<div class="row mb-3">
										<label class="col-sm-2 col-form-label">No Handphone</label>
										<div class="col-sm-10">
										<div class="input-group mb-3">
											<span class="input-group-text" id="basic-addon1">+62</span>
											<input type="number" name="no_hp" class="form-control" aria-label="Nohandphone" aria-describedby="basic-addon1" required value="<?= $isi_data_pegawai['no_hp']; ?>">
											</div>
										</div>
									</div>
									<div class="row mb-3">
										<label class="col-sm-2 col-form-label">Alamat Lengkap</label>
										<div class="col-sm-10">
											<textarea class="form-control" style="height: 100px" name="alamat" required><?= $isi_data_pegawai['alamat']; ?></textarea>
										</div>
									</div>
                                    <div class="col-sm-10">
                                        <button class="btn btn-success" name="UpdatePegawai"><i class="bi bi-check-circle"></i> Update</button>
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
