<?php
	include 'koneksi.php';

    //no_rm diganti(?)
	$nik		    = $_POST['nik'];
	$nama	        = $_POST['nama'];
	$jenis_kelamin	= $_POST['jenis_kelamin'];
	$tempat_lahir	= $_POST['tempat_lahir'];
    $tanggal_lahir	= $_POST['tanggal_lahir'];
	$goldar	        = $_POST['goldar'];
	$agama	        = $_POST['agama'];
	$negara	        = $_POST['negara'];
    $status_kawin	= $_POST['status kawin'];
	$no_wa	        = $_POST['no_wa'];
	$email	        = $_POST['email'];
	$alamat	        = $_POST['alamat'];


	$sql	= "INSERT INTO pasien VALUES('','$nik', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$goldar', '$agama', '$negara','$status_kawin', '$no_wa', '$email', '$alamat')";

	$query	= mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($query) {
		header("Location:input_pasien.php");
	} else {
		echo "Input Data Gagal."; //diganti pemberitahuan dan balik ke input data
	}
	
?>