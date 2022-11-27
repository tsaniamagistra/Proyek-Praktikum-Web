<?php 
	include 'koneksi.php';

	$no_rm			= $_POST['no_rm'];
	$nik		    = $_POST['nik'];
	$nama	        = $_POST['nama'];
	$jenis_kelamin	= $_POST['jenis_kelamin'];
	$tempat_lahir	= $_POST['tempat_lahir'];
    $tanggal_lahir	= $_POST['tanggal_lahir'];
	$goldar	        = $_POST['goldar'];
	$agama	        = $_POST['agama'];
	$wn		        = $_POST['wn'];
    $status_kawin	= $_POST['status_kawin'];
	$no_wa	        = $_POST['no_wa'];
	$email	        = $_POST['email'];
	$alamat	        = $_POST['alamat'];

    $query	= mysqli_query($connect, "UPDATE `pasien` SET nik='$nik', nama='$nama', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', goldar='$goldar', agama='$agama', wn='$wn', status_kawin='$status_kawin', no_wa='$no_wa', email='$email', alamat='$alamat' WHERE no_rm='$no_rm'") or die(mysqli_error($connect));
	
	if($query)
	{
		header("Location:login.php?message=edit_biodata_berhasil");
	}
	else{
		echo "proses update gagal";
	}
?>