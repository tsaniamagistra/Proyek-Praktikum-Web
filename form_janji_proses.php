<?php
    include 'koneksi.php';
    
    $id_klinik	    = $_POST['id_klinik'];
    $id_dokter	    = $_POST['id_dokter'];
    $hari           = $_POST['hari'];
    $tgl			= $_POST['tanggal_periksa'];
    $no_rm	       = $_POST['no_rm'];
    
    $sql4	= "SELECT id_jadwal from jadwal_dokter where id_klinik='$id_klinik' AND 
                id_dokter='$id_dokter' AND hari='$hari'";

	$query4	= mysqli_query($connect, $sql4) or die(mysqli_error($connect));
    while ($data4 = mysqli_fetch_array($query4)) {
        $id_jadwal=$data4['id_jadwal'];
    }
    
    $query5 = mysqli_query($connect, "SELECT * FROM riwayat_pasien WHERE id_jadwal='$id_jadwal' AND tgl='$tgl'");
    $cek = mysqli_num_rows($query5); 

    if($cek>15){
	    header("Location:form_janji.php"); //ini sementara
    }
    else{
        $sql6	= "INSERT INTO riwayat_pasien VALUES('','$no_rm', '$id_jadwal', '$tgl')";
	    $query6	= mysqli_query($connect, $sql6) or die(mysqli_error($connect));
        if($query6) {
            header("Location:riwayat.php");
        } else {
            echo "Input Data Gagal.";
        }
    }
	
?>
