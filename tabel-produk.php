<?php
require 'function.php';
require 'cek-sesi-login.php';

if(isset ($_POST["UpdateImg"])) {
	// uploadan gambar
	$id_produk = $_POST["id_produk"];	
	$filename = $_FILES["img"]["name"];
	if($filename != '') {
		$ekstensi = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
		$ekstensi_valid = array("jpg", "jpeg", "png", "gif");
		if(in_array($ekstensi, $ekstensi_valid)){
			$img_base64 = base64_encode(file_get_contents($_FILES["img"]["tmp_name"]));
			$img = "data::image/".$ekstensi.";base64,".$img_base64;
			echo $ekstensi;
			//insert database
			$query = "UPDATE produk SET img = '$img' WHERE id_produk = '$id_produk'";
			mysqli_query($dbconnect, $query);
			header("location:tabel-produk.php");
		}
	}
}


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
				<h1>Tabel Produk</h1>
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item">Tables</li>
						<li class="breadcrumb-item active">Data Produk</li>
					</ol>
				</nav>
			</div>
			<!-- End Page Title -->

			<section class="section">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Tabel Data Produk</h5>

								<!-- Table with stripped rows -->
								<table class="table datatable">
									<thead>
										<tr>
											<th scope="col">ID</th>
											<th scope="col">Nama</th>
											<th scope="col">Jenis</th>
											<th scope="col">Modal Produksi</th>
											<th scope="col">Harga Jual</th>
											<th scope="col">Stok</th>
											<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$produk = mysqli_query($dbconnect, "SELECT * FROM produk");
									while ($row = mysqli_fetch_array($produk)) {
									?>
										<tr>
											<td><?php echo $row['id_produk'] ?></td>
											<td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#img<?=$row['id_produk'] ?>"><i class="bi bi-info-circle"></i></button> &nbsp&nbsp<?php echo $row['nama_produk'] ?></td>
											<td><?php echo $row['jenis_produk'] ?></td>
											<td><?php echo "Rp. " . number_format($row['modal_produksi']) ?></td>
											<td><?php echo "Rp. " . number_format($row['harga_jual']) ?></td>
											<td><?php echo $row['stok'] ?></td>
											<td>
												<a type="button" href="edit-produk.php?id=<?php echo $row['id_produk'] ?>" class="btn btn-info btn-icon-split">
													<span class="icon text-white">
														<i class="fas fa-pen"></i>
													</span>
												</a>
												<a type="button" href="javascript:remove('hapus.php?id_produk=<?php echo $row['id_produk'] ?>')" class="btn btn-danger btn-icon-split">
													<span class="icon text-white">
														<i class="fas fa-times"></i>
													</span>
												</a>
											</td>
										</tr>
										<div class="modal fade" id="img<?=$row['id_produk']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-body">
														<div class="card">
														<?php 
															$result = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT img FROM produk WHERE id_produk = '".$row['id_produk']."'")); 
															$img_src = $result['img'];
														?>
															<img src="<?php echo $img_src; ?>" class="card-img-top" alt="..." height="300px">
															<div class="card-body">
																<h5 class="card-title"><?php echo $row['nama_produk'] ?></h5>
																<p class="card-text">Untuk mengganti gambar, silahkan masukkan file baru ke form berikut</p>
																<form method="POST" class="needs-validation" novalidate action="" enctype="multipart/form-data">
																<div class="col-12">
																	<input type="hidden" value="<?php echo $row['id_produk']?>" name="id_produk">
																	<input type="file" class="form-control" id="file-input" name="img">
																</div>
																<div class="modal-footer">
																	<button type="submit" class="btn btn-success" name="UpdateImg">Update</button>
																	<button type="reset" class="btn btn-danger">Reset</button>
																</div>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php } ?>
									</tbody>
								</table>
								<!-- End Table with stripped rows -->
								<button class="btn btn-primary" data-toggle="modal" data-target="#TambahProduk">
									<i class="bi bi-plus-square"></i>
									<span class="text">Tambah Produk</span>
								</button>
							</div>
							<div class="modal fade" id="TambahProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk</h5>
											<button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
											</button>
										</div>
										<div class="modal-body">
											<form method="POST" class="needs-validation" novalidate action="tambah/tambah.php" enctype="multipart/form-data">
												<div class="form-floating mb-3">
													<input type="text" class="form-control" name="nama" placeholder="Nama Produk" required>
													<label for="floatingInput">Nama Produk</label>
												</div>
												<div class="form-floating mb-3">
													<select class="form-select" name="jenis" aria-label="Floating label select example" required>
														<option value="" disabled="" selected>Pilih Jenis Produk</option>
														<option value="Premium">Premium</option>
														<option value="Biasa">Biasa</option>
													</select>
													<label for="floatingSelect">Jenis Produk</label>
												</div>
												<div class="form-floating mb-3">
													<input type="number" class="form-control" name="modal" placeholder="Modal Produksi" required oninput="validity.valid||(value='');" min="0">
													<label for="floatingInput">Modal Produksi</label>
												</div>
												<div class="form-floating mb-3">
													<input type="number" class="form-control" name="h_jual" placeholder="Harga Jual" required oninput="validity.valid||(value='');" min="0">
													<label for="floatingInput">Harga Jual</label>
												</div>
												<div class="form-floating mb-3">
													<input type="number" class="form-control" name="stok" placeholder="Stok" required oninput="validity.valid||(value='');" min="0">
													<label for="floatingInput">Stok</label>
												</div>
												<div class="col-12">
													<label for="file-input" class="form-label">Upload gambar</label>
													<input type="file" class="form-control" id="file-input" name="img" required>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" name="TambahProduk">Save</button>
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

		<!-- script delete produk  -->
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
