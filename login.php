<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Masuk</title>
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
                            if($data['status_kawin']=='sk') $status_pasien="Ny.";
                            elseif($data['status_kawin']=='bk') $status_pasien="Nn.";
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
                <a href="#" class="list-group-item list-group-item-action">Jadwal Dokter</a>
                <a href="beranda_janji.php" class="list-group-item list-group-item-action" style="font-weight:bold;">Buat Janji Dokter</a>
                <a href="#" class="list-group-item list-group-item-action">Riwayat</a>
                <a href="logout.php" class="list-group-item list-group-item-action">
                    <?php
                        if(!empty($_SESSION['no_rm']))
                            echo "Keluar";
                    ?>
                </a>
            </div>
        </div>
    </div>
    <!--end of navbar area-->
	<div class="d-flex align-items-center justify-content-center" style="height: 90vh;">
	<div style="width:25%; background-color:#063970;" class="p-4">
		<form method="POST" action="login_proses.php" style="width: 100%;">
			<label for="noRM" class="text-white mt-2">No. RM</label>
			<input class="form-control d-grid mt-2" type="text" name="noRM" id="noRM" placeholder="Masukkan nomor Rekam Medis"></input>
			<label for="tglLahir" class="text-white mt-2">Tanggal Lahir</label>
			<input class="form-control mt-2" type="date" name="tglLahir" id="tglLahir"></input>
			<div class="mt-4" style="text-align:center;">
				<button class="btn btn-light" type="submit" name="login" id="submit">MASUK</button>
			</div>
		</form>
	</div>
	</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>