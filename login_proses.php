<?php
	session_start();
	include 'koneksi.php';

	$noRM		= $_POST['noRM'];
	$tglLahir	= $_POST['tglLahir'];
	$next_page	= $_POST['next_page'];

	$sql	= "SELECT * from pasien where no_rm='$noRM' and tanggal_lahir='$tglLahir'";
	$data	= mysqli_query($connect,$sql);

	$cek = mysqli_num_rows($data);	//check data

	if($cek > 0){
		$_SESSION['no_rm'] = $noRM;
		$_SESSION['status'] = "login";
		header("Location:$next_page");
	}
	else{
		header("Location:login.php?message=failed");
	}
	mysqli_close($connect);
?>