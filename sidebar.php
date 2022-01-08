<?php $thisUrl = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 

if($thisUrl == "http://localhost/ResponsiBasdat/tabel-pegawai.php" || $thisUrl == "http://localhost/ResponsiBasdat/tabel-produk.php" || $thisUrl == "http://localhost/ResponsiBasdat/tabel-pembeli.php" || $thisUrl == "http://localhost/ResponsiBasdat/tabel-penjualan.php") {
	$tableOpened = true;
}

?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
	<ul class="sidebar-nav" id="sidebar-nav">
		<li class="nav-item">
			<a class="nav-link <?php if($thisUrl != "http://localhost/ResponsiBasdat/index.php") echo 'collapsed'; ?>" href="index.php">
				<i class="bi bi-grid"></i>
				<span>Dashboard</span>
			</a>
		</li>
		<!-- End Dashboard Nav -->

		<li class="nav-item">
			<a class="nav-link <?php if($thisUrl == "http://localhost/ResponsiBasdat/index.php" or $thisUrl == "http://localhost/ResponsiBasdat/") echo 'collapsed'; ?>" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i> </a>
			<ul id="tables-nav" class="nav-content collapse <?php if($tableOpened) echo 'show'; ?>" data-bs-parent="#sidebar-nav">
				<li>
					<a href="tabel-pegawai.php" class="<?php if($thisUrl == "http://localhost/ResponsiBasdat/tabel-pegawai.php") echo 'active'; ?>"> <i class="bi bi-circle"></i><span>Pegawai</span> </a>
				</li>
				<li>
					<a href="tabel-produk.php" class="<?php if($thisUrl == "http://localhost/ResponsiBasdat/tabel-produk.php") echo 'active'; ?>"> <i class="bi bi-circle"></i><span>Produk</span> </a>
				</li>
				<li>
					<a href="tabel-pembeli.php" class=" <?php if($thisUrl == "http://localhost/ResponsiBasdat/tabel-pembeli.php") echo 'active'; ?>"> <i class="bi bi-circle"></i><span>Pembeli</span> </a>
				</li>
				<li>
					<a href="tabel-penjualan.php" class=" <?php if($thisUrl == "http://localhost/ResponsiBasdat/tabel-penjualan.php") echo 'active'; ?>"> <i class="bi bi-circle"></i><span>Penjualan</span> </a>
				</li>
			</ul>
		</li>
		<!-- End Tables Nav -->
	</ul>
</aside>
<!-- End Sidebar-->
