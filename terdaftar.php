<?php
    include('koneksi.php');
	if(isset($_GET['message'])){
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
        padding: 2.5%;
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
			<h5 class="offcanvas-title" id="offcanvasRightLabel">Contoh Nama, Nn.</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			<div class="list-group list-group-flush">
				<a href="home.php" class="list-group-item list-group-item-action">Beranda</a>
				<a href="#" class="list-group-item list-group-item-action">Jadwal Dokter</a>
				<a href="beranda_janji.php" class="list-group-item list-group-item-action" style="font-weight:bold;">Buat Janji Dokter</a>
				<a href="#" class="list-group-item list-group-item-action">Riwayat</a>
				<a href="#" class="list-group-item list-group-item-action">Logout</a>
			</div>
		</div>
	</div>
	<!--end of navbar area-->
    
    <div class="row" style="width:100vw">
    <div class="col-4">
    </div>
    <div class="col-4 mt-5">
        <div class="form-container">
        <center>
            <h4 class="text-white mb-4">Anda Sudah Terdaftar</h4>

            <?php
			  
			  
			  $query = mysqli_query($connect, "SELECT nama, nik, no_rm FROM pasien ORDER BY no_rm DESC LIMIT 1");

			  while ($data = mysqli_fetch_array($query)) {
          ?>

            <ul class="list-group mb-2">
                <li class="list-group-item"><?= "Nama   : ".$data['nama']; ?> </li>
            </ul>
            <ul class="list-group mb-2">
                <li class="list-group-item"><?= "NIK    : ".$data['nik']; ?></li>
            </ul>
            <ul class="list-group mb-2">
                <li class="list-group-item"><?= "No. RM : ".$data['no_rm']; ?></li>
            </ul>
			<?php } ?>
        </center>
        </div>
        <center>
            <div class="mt-4">
            <a href="login.php" type="button" class="btn btn-dark btn-merkcolor">Untuk membuat janji temu dokter<br>Silakan masuk di sini</a>
            </div>
        </center>
    </div>
    <div class="col-4">
    </div>
    </div>
    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
<?php }
    else{
        header("Location:input_pasien.php");
    }
?>