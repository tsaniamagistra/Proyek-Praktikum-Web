<?php
	session_start();
	include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Buat Janji</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<style>
		.list-group-item{
			border-bottom: 0;
		}
		.btn-merkcolor{
			background-color:#063970;
		}
	</style>
</head>
<body>
	<!--start of navbar area-->
	<nav class="navbar navbar-dark" style="background-color:#063970">
  	<div class="container-fluid">
  	  <a class="navbar-brand"><img src="Images/logo.png" style="height:30px" alt="HOSPITAL"></a>
  	  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
  	  	<span class="navbar-toggler-icon"></span>
  	  </button>
  	</div>
	</nav>
	<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="offcanvasRightLabel">
				<?php
					if(empty($_SESSION['no_rm'])){?>
						 <a href="login.php" style="color:black; text-decoration:none;">Masuk</a>
					<?php }
					else{
						$noRM=$_SESSION['no_rm'];
						$query=mysqli_query($connect,"SELECT * FROM pasien WHERE no_rm='$noRM'");
						$data=mysqli_fetch_array($query);
						//menentukan status pasien
						$dateOfBirth = $data['tanggal_lahir'];
						$today = date("Y-m-d");
						$diff = date_diff(date_create($dateOfBirth), date_create($today));
						if($diff->format('%y')<5) $status_pasien="By.";
						elseif($diff->format('%y')<=18) $status_pasien="An.";
						elseif($data['jenis_kelamin']=='L') $status_pasien="Tn.";
						elseif($data['jenis_kelamin']=='P'){
							if($data['status_kawin']=='Sudah Kawin') $status_pasien="Ny.";
							elseif($data['status_kawin']=='Belum Kawin') $status_pasien="Nn.";
						}
						//echo nama, status pasien
						echo $data['nama'] . ", " . $status_pasien;
					}
				?>
			</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			<div class="list-group list-group-flush">
				<a href="home.php" class="list-group-item list-group-item-action">Beranda</a>
				<a href="jadwal_dokter.php" class="list-group-item list-group-item-action">Jadwal Dokter</a>
				<a href="beranda_janji.php" class="list-group-item list-group-item-action" style="font-weight:bold;">Buat Janji Dokter</a>
				<a href="riwayat.php" class="list-group-item list-group-item-action">Riwayat</a>
				<?php if(!empty($_SESSION['no_rm'])){?>
					<a href="logout.php" class="list-group-item list-group-item-action"><?="Keluar";
					?></a>
				<?php }?>
			</div>
		</div>
	</div>
	<!--end of navbar area-->
	<center>
		<h2 style="margin-top:15%;">Buat Janji Temu dengan Dokter</h2>
		<div class="row mt-5" style="width:70%;">
			<div class="d-grid col-6"><a href="input_pasien.php" type="button" class="btn btn-dark btn-lg btn-merkcolor">Pasien Baru<br>(Belum ada nomor Rekam Medis)</a></div>
			<div class="d-grid col-6">
				<a href=<?php if(empty($_SESSION['no_rm'])) echo "login.php?message=form_janji.php"; else echo "form_janji.php";?> type="button" class="btn btn-dark btn-lg btn-merkcolor">Pasien Lama<br>(Sudah ada nomor Rekam Medis)</a></div>
		</div>
	</center>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
