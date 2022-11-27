<?php 
	date_default_timezone_set("Asia/Jakarta");
	session_start();
	
	if (empty($_SESSION['no_rm'])) {
		header("Location:login.php?message=riwayat.php");
	}
	else{
	include 'koneksi.php';
	$no_rm=$_SESSION['no_rm'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Riwayat</title>
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
						elseif(($diff->format('%y')<=18)&&($data['status_kawin']=='Sudah Kawin')) $status_pasien="Ny.";
						elseif(($diff->format('%y')<=18)&&($data['status_kawin']=='Belum Kawin')) $status_pasien="An.";
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
				<a href="beranda_janji.php" class="list-group-item list-group-item-action" >Buat Janji Dokter</a>
				<a href="riwayat.php" class="list-group-item list-group-item-action" style="font-weight:bold;">Riwayat</a>
				<?php if(!empty($_SESSION['no_rm'])){?>
					<a href="edit_biodata.php" class="list-group-item list-group-item-action">Edit Biodata</a>
					<a href="logout.php" class="list-group-item list-group-item-action"><?="Keluar";
					?></a>
				<?php }?>
			</div>
		</div>
	</div>
	<!--end of navbar area-->
	<center>
		<h2 class="mt-5">Riwayat Janji Temu dengan Dokter</h2>
	<div style="width:90%;" class="px-2 mt-4">
	
	
	<h5 style="text-align:left">Akan Datang</h5>
		<table class="table table-bordered" style="text-align:center">
			<thead class="table-light">
				<tr>
					<td class="col-1">No. Pendaftaran</td>
					<td class="col-2">Hari, Tanggal</td>
					<td class="col-1">Waktu</td>
					<td class="col-3">Dokter</td>
					<td class="col-2">Klinik</td>
					<td class="col-1">Aksi</td>
				</tr>
			</thead>
				<tbody>
					<?php
					 
					$today= date("Y-m-d");
					$now= date("H:i:s");

					$sql= "SELECT a.no_pendaftaran, a.tgl, b.hari, b.waktu_mulai, b.waktu_selesai, 
							c.dokter, d.klinik FROM riwayat_pasien AS a INNER JOIN jadwal_dokter AS b
							ON a.id_jadwal=b.id_jadwal INNER JOIN dokter AS c ON b.id_dokter=c.id_dokter
							INNER JOIN klinik AS d ON b.id_klinik=d.id_klinik WHERE a.no_rm='$no_rm' AND a.tgl>='$today'";

					$query = mysqli_query($connect, $sql);
					while($data=mysqli_fetch_array($query)){
						$waktu_selesai=$data['waktu_selesai'];
						$tgl=$data['tgl'];
						if(($tgl==$today && $waktu_selesai>$now)||($tgl>$today)){
					?>
							<tr>
							<td> <?=$data['no_pendaftaran'];?></td>
							<td> <?=$data['hari'].", ".date('d F Y',strtotime($data['tgl']));?></td>
							<td> <?=date('H:i', strtotime($data['waktu_mulai']))." - ".date('H:i', strtotime($data['waktu_selesai']));?></td>
							<td> <?=$data['dokter'];?></td>
							<td> <?=$data['klinik'];?></td>
							<td><a href="hapus_riwayat.php?no_pendaftaran=<?php echo $data['no_pendaftaran'];?>" class="btn btn-danger">Batalkan</a></td>
							</tr>
					<?php }			
					}
					?>
				</tbody>
		</table>

		<h5 style="text-align:left">Berlalu</h5>
		<table class="table table-bordered" style="text-align:center">
			<thead class="table-light">
				<tr>
					<td class="col-1">No. Pendaftaran</td>
					<td class="col-2">Hari, Tanggal</td>
					<td class="col-2">Waktu</td>
					<td class="col-3">Dokter</td>
					<td class="col-1">Klinik</td>
				</tr>
			</thead>
				<tbody>
					<?php
					 
					$sql	= "SELECT a.no_pendaftaran, a.tgl, b.hari, b.waktu_mulai, b.waktu_selesai, 
								c.dokter, d.klinik FROM riwayat_pasien AS a INNER JOIN jadwal_dokter AS b
								ON a.id_jadwal=b.id_jadwal INNER JOIN dokter AS c ON b.id_dokter=c.id_dokter
								INNER JOIN klinik AS d ON b.id_klinik=d.id_klinik WHERE a.no_rm='$no_rm' AND a.tgl<='$today'";

					$query = mysqli_query($connect, $sql);
					while($data=mysqli_fetch_array($query)){
						$waktu_selesai=$data['waktu_selesai'];
						$tgl=$data['tgl'];
						if(($tgl==$today && $waktu_selesai<$now)||($tgl<$today)){
					?>
						<tr>
						<td> <?=$data['no_pendaftaran'];?></td>
						<td> <?=$data['hari'].", ".date('d F Y',strtotime($data['tgl']));?></td>
						<td> <?=date('H:i', strtotime($data['waktu_mulai']))." - ".date('H:i', strtotime($data['waktu_selesai']));?></td>
						<td> <?=$data['dokter'];?></td>
						<td> <?=$data['klinik'];?></td>
						</tr>
					<?php }
					}?>
				</tbody>
		</table>
	</center>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
