<?php 
	include 'koneksi.php';
	$no_pendaftaran	= $_GET['no_pendaftaran'];

	$query = mysqli_query($connect, "DELETE FROM riwayat_pasien where no_pendaftaran='$no_pendaftaran'");

	if($query)
	{
        header("Location:riwayat.php");
    }
	else{
		echo "proses hapus gagal";
	}
?>