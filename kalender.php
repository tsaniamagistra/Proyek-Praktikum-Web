<?php
	date_default_timezone_set("Asia/Jakarta");
	session_start();
	if (empty($_POST['no_rm'])||empty($_POST['id_jadwal'])) {
		header("Location:form_janji.php");
	}

    include 'koneksi.php';
    
    $id_jadwal  = $_POST['id_jadwal'];
    $no_rm      = $_POST['no_rm'];
    $today		= date("Y-m-d");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Buat Janji</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
	<!--start of navbar area-->
	<nav class="navbar navbar-dark" style="background-color:#063970">
  	<div class="container-fluid">
  	  <a class="navbar-brand"><img src="Images/logo.png" style="height:30px" alt="HOSPITAL"></a>
  	</div>
	</nav>
	<!--end of navbar area-->
	<div class="d-flex align-items-center justify-content-center" style="height:85vh;">
		<center style="width:25%;">
		<h5 class="mb-3">Silakan pilih tanggal temu</h5>
		<div style="background-color:#063970; color:white;" class="p-4">
		<form method="POST" action="form_janji_proses.php" style="width: 100%;">
			<input type="hidden" name="id_jadwal" value="<?=$id_jadwal?>">
			<input type="hidden" name="no_rm" value="<?=$no_rm?>">
			<div class="row"><input type="date" name="tanggal_periksa" min="<?=$today?>"></div>
			<div class="row mt-4"><button type="submit" class="btn btn-light">Pilih</button></div>
		</form>
		</div>
		</center>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>