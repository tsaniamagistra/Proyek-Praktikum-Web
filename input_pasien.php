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
    
    <center>
        <h2 style="margin-top:2.5%;">Formulir Data Pasien Baru</h2>
    </center>
    <div class="row">
    <div class="col-3">
    </div>
    <div class="col-6">
        <div class="container-md form-container">
        <form action="input_pasien_proses.php" method="POST">
        <div class="row">
            <div class="col-6 mr-2">
                <input type="text" name="nik" minlength="16" class="form-control mb-2" placeholder="NIK">
                <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Lengkap">
                <input type="text" name="tempat_lahir" class="form-control mb-1" placeholder="Tempat Lahir">
                <label class="form-label text-white mb-0">Tanggal Lahir</label>
                <input class="form-control mb-3" type="date" name="tanggal_lahir">
                <div class="row mb-2">
                <div class="col-6 mr-1">
                    <select name="goldar" class="form-select form-select-sm">
                        <option selected>Gol. Darah</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="O">O</option>
                        <option value="AB">AB</option>
                    </select>
                </div>
                <div class="col-6">
                    <div class="form-check form-check-inline">
					    <input class="form-check-input" type="radio" name="jenis_kelamin" onclick="button_disabled()" value="P">
						<label class="form-check-label text-white" for="P">P</label>
					</div>
					<div class="form-check form-check-inline">
					    <input class="form-check-input" type="radio" name="jenis_kelamin" onclick="button_disabled()" value="L">
						<label class="form-check-label text-white" for="L">L</label>
					</div>
                </div>
                </div>
            </div>
            <div class="col-6 ml-2">
                <select name="agama" class="form-select form-select mb-2">
                    <option selected>Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="B">B</option>
                    <option value="O">O</option>
                    <option value="AB">AB</option>
                </select>
                <div>
                    <label class="form-label text-white mb-0">Status Perkawinan</label>
                </div>
                <div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="status_kawin" onclick="button_disabled()" value="Belum Kawin">
					<label class="form-check-label text-white" for="Belum Kawin">Belum Kawin</label>
				</div>
				<div class="form-check form-check-inline">
					    <input class="form-check-input" type="radio" name="status_kawin" onclick="button_disabled()" value="Sudah Kawin">
						<label class="form-check-label text-white" for="Sudah Kawin">Sudah Kawin</label>
				</div>
                <input type="text" name="no_wa" class="form-control mb-2 mt-1" placeholder="Nomor Whatsapp">
                <input type="text" name="email" class="form-control mb-2" placeholder="Email">
                <div class="mb-2">
                <textarea class="form-control" name="alamat" rows="2" placeholder="Alamat"></textarea>
                </div>
            </div>
        </div>                
        </form>    
        <button type="submit" class="btn btn-light mt-5" style="width: 100%">DAFTAR</button>
        </div>
    </div>
    <div class="col-3">
    </div>
    </div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>