<?php
	session_start();
	include 'koneksi.php';
	$days = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
	$length = count($days);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Jadwal Dokter</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet" href="home.css">
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
	<nav class="navbar navbar-dark fixed-top" style="background-color:#063970">
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
				<a href="jadwal_dokter.php" class="list-group-item list-group-item-action" style="font-weight:bold;">Jadwal Dokter</a>
				<a href="beranda_janji.php" class="list-group-item list-group-item-action">Buat Janji Dokter</a>
				<a href="riwayat.php" class="list-group-item list-group-item-action">Riwayat</a>
				<?php if(!empty($_SESSION['no_rm'])){?>
					<a href="logout.php" class="list-group-item list-group-item-action"><?="Keluar";
					?></a>
				<?php }?>
			</div>
		</div>
	</div>
	<!--end of navbar area-->
	<center class="my-5 pt-5">
	<div style="width:90%; background-color:#063970;" class="py-4 px-2">
		<div style="color:white; text-align:left;" class="mb-3 mx-3">Pilih satu atau lebih filter atau langsung klik LIHAT untuk seluruhnya</div>
		<form method="GET" action="jadwal_dokter.php" style="width: 100%;" class="row">
			<div class="col-4">
			<select class="form-select dropdown-toggle scrollable-select" name="klinik">
				<option value='0' selected>- Pilih Klinik</option>
				<?php
					$opt_klinik=mysqli_query($connect,"SELECT * FROM klinik");
						while($klinik=mysqli_fetch_array($opt_klinik)){ ?>
							<option value="<?php echo $klinik['id_klinik']; ?>"><?php echo $klinik['klinik']?></option>
						<?php }
					?>
				?>
			</select>
			</div>
			<div class="col-4">
			<select class="form-select col" name="dokter">
				<option value='0' selected>- Pilih Dokter</option>
				<?php
					$opt_dokter=mysqli_query($connect,"SELECT * FROM dokter");
						while($dokter=mysqli_fetch_array($opt_dokter)){ ?>
							<option value="<?php echo $dokter['id_dokter']; ?>"><?php echo $dokter['dokter']?></option>
						<?php }
					?>
				?>
			</select>
			</div>
			<div class="col-3">
			<select class="form-select col" name="hari">
				<option value='0' selected>- Pilih Hari</option>
				<?php for ($i=0; $i < $length; $i++) { ?>
					<option value="<?=$days[$i];?>"><?=$days[$i];?></td>
				<?php } ?>
			</select>
			</div>
			<div class="col-1">
				<button class="btn btn-light" type="submit" name="submit" value="1">LIHAT</button>
			</div>
		</form>
	</div>
	<?php if(!empty($_GET['submit'])){
		$id_klinik	= $_GET['klinik'];
		$id_dokter	= $_GET['dokter'];
		$hari		= $_GET['hari'];
	?>
	<div style="width:90%;" class="px-2 mt-5">
		<h3>Jadwal Dokter</h3>
		<?php
			if($_GET['klinik']=='0')
					$sql1="SELECT * FROM klinik";
			else
				$sql1="SELECT * FROM klinik WHERE id_klinik='$id_klinik'";
			$query1=mysqli_query($connect,$sql1);
			while($data1=mysqli_fetch_array($query1)){ 
				if($_GET['dokter']=='0'){
					if($_GET['hari']=='0') //tdk filter dokter, tdk filter hari
						$sql2="SELECT DISTINCT id_dokter FROM jadwal_dokter WHERE id_klinik=$data1[id_klinik]";
					else //tdk filter dokter, filter hari
						$sql2="SELECT DISTINCT id_dokter FROM jadwal_dokter WHERE id_klinik=$data1[id_klinik] AND hari='$hari'";
				}
				else{
					if($_GET['hari']=='0') //filter dokter, tdk filter hari
						$sql2="SELECT DISTINCT id_dokter FROM jadwal_dokter WHERE id_klinik=$data1[id_klinik] AND id_dokter='$id_dokter'";
					else //filter dokter filter hari
						$sql2="SELECT DISTINCT id_dokter FROM jadwal_dokter WHERE id_klinik=$data1[id_klinik] AND id_dokter='$id_dokter' AND hari='$hari'";
				}
				$query2=mysqli_query($connect,$sql2);
				if(mysqli_num_rows($query2)!=0){ ?>
					<h6 style="text-align:left"><?=$data1['klinik'];?></h6>
					<table class="table table-bordered" style="text-align:center;">
						<thead class="table-light">
							<tr>
								<td class="col-3">Nama Dokter</td>
								<?php for ($i=0; $i < $length; $i++) { ?>
								<td class="col-1"><?=$days[$i];?></td>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
							while($data2=mysqli_fetch_array($query2)){
							?>
							<tr>
								<td> <!--Nama Dokter-->
								<?php
								$query3=mysqli_query($connect, "SELECT dokter FROM dokter WHERE id_dokter=$data2[id_dokter]");
								$data3=mysqli_fetch_array($query3);
								echo $data3['dokter'];
								?>
								</td>
								<!--Hari-->
								<?php
								for ($i=0; $i < $length; $i++) { ?>
									<td>
									<?php
									$query4=mysqli_query($connect, "SELECT * FROM jadwal_dokter WHERE id_dokter=$data2[id_dokter] AND hari='$days[$i]' AND id_klinik=$data1[id_klinik]");
									while($data4=mysqli_fetch_array($query4)){
									if($data4!=NULL)
										echo date('H:i', strtotime($data4['waktu_mulai'])) . " - " . date('H:i', strtotime($data4['waktu_selesai'])) . "\n";
									else
										echo "-";
									}
									?>
									</td>
								<?php } ?>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php }
			} ?>
	</div>
	<?php } ?>
	</center>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
