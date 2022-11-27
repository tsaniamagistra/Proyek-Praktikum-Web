<?php
    include 'koneksi.php';
    
    $id_jadwal  = $_POST['id_jadwal'];
    $tgl		= $_POST['tanggal_periksa'];
    $no_rm      = $_POST['no_rm'];

    $query1 = mysqli_query($connect, "SELECT * FROM riwayat_pasien WHERE id_jadwal='$id_jadwal' AND tgl='$tgl'");
    $cek1 = mysqli_num_rows($query1); 

    $query2 = mysqli_query($connect, "SELECT * FROM riwayat_pasien WHERE id_jadwal='$id_jadwal' AND tgl='$tgl' AND  no_rm='$no_rm'");
    $cek2 = mysqli_num_rows($query2); 


    if($cek1>15){ //membatasi jumlah pasien dalam 1 kloter
	    header("Location:form_janji.php?message=penuh");
    }
    elseif($cek2>0){ //menghindari jadwal yang sama
        header("Location:form_janji.php?message=sudah_ada");
    }
    else{
        $sql	= "INSERT INTO riwayat_pasien VALUES('','$no_rm', '$id_jadwal', '$tgl')";
	    $query	= mysqli_query($connect, $sql) or die(mysqli_error($connect));
        if($query) {
            header("Location:riwayat.php");
        } else {
            echo "Input Data Gagal.";
        }
    }
	
?>
