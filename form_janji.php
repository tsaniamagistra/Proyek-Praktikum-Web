<?php
	session_start();
	include 'koneksi.php';
    $no_rm=$_SESSION['no_rm'];
    $days = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
	$length = count($days);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pendaftaran Pasien Baru</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<style>
        .form-container{
        background-color: #063970;
        padding: 4%;
        }
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
				<a href="jadwal_dokter.php" class="list-group-item list-group-item-action" >Jadwal Dokter</a>
				<a href="beranda_janji.php" class="list-group-item list-group-item-action" style="font-weight:bold;">Buat Janji Dokter</a>
				<a href="#" class="list-group-item list-group-item-action">Riwayat</a>
				<?php if(!empty($_SESSION['no_rm'])){?>
					<a href="logout.php" class="list-group-item list-group-item-action"><?="Keluar";
					?></a>
				<?php }?>
			</div>
		</div>
	</div>
	<!--end of navbar area-->
    
    <center>
        <h2 style="margin-top:2.5%;">Buat Janji Temu Dokter</h2>
    </center>
    <div class="row" style="width:100vw">
    <div class="col-3">
    </div>
    <div class="col-6">
        <div class="container-md form-container">
        <form action="form_janji_proses.php" method="POST">
        <div class="row">
            <div class="col-6 mr-2">
                <?php
			    include('koneksi.php');
			  
			    $query = mysqli_query($connect, "SELECT no_rm, nama, nik, no_wa, email FROM pasien WHERE no_rm='$no_rm'");

			    while ($data = mysqli_fetch_array($query)) {
                ?>
                
                <input type="text" name="no_rm" class="form-control mb-2" value="<?= $data['no_rm'];?>" readonly>
                <input type="text" name="nama" class="form-control mb-2" value="<?= $data['nama'];?>" readonly>
                <input type="text" name="nik" minlength="16" maxlength="16" class="form-control mb-2" value="<?= $data['nik']; ?>" readonly>
                <input type="text" name="no_wa" class="form-control mb-2" value="<?= $data['no_wa'];?>" readonly>
                <input type="text" name="email" class="form-control mb-2" value="<?= $data['email'];?>" readonly>
                
                <?php  } ?>
            </div>
            <div class="col-6 ml-2">
                    
                <select name="id_klinik" class="form-select form-select mb-3">
                <option selected>Pilih Klinik</option>
            
                <?php 
            
                $query2 = mysqli_query($connect,"SELECT * FROM klinik ");
            
                while ($data2 = mysqli_fetch_array($query2)) {
                ?>
                <option value="<?= $data2['id_klinik']; ?>"><?= $data2['klinik']; ?></option>
                <?php } ?>
                </select>
                <select name="id_dokter" class="form-select form-select mb-3">
                <option selected>Pilih Dokter</option>
                <?php 
                $query3 = mysqli_query($connect,"SELECT * FROM dokter ");
        
                while ($data3 = mysqli_fetch_array($query3)) {
                ?>
                    <option value="<?= $data3['id_dokter']; ?>"><?= $data3['dokter']; ?></option>
                <?php } ?>
                </select>

                <select name="hari" class="form-select form-select mb-2">
                <option value='0' selected>Pilih Hari</option>
				<?php for ($i=0; $i < $length; $i++) { ?>
					<option value="<?=$days[$i];?>"><?=$days[$i];?></td>
				<?php } ?>
                </select>
                
                <label class="form-label text-white mb-0">Tanggal Periksa</label>
                <input class="form-control mb-2" type="date" name="tanggal_periksa">             
            </div>
        </div>   
        <button type="submit" class="btn btn-light mt-3" style="width: 100%">BUAT</button>  
        </form>    
        </div>
    </div>
    <div class="col-3">
    </div>
    </div>

    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>