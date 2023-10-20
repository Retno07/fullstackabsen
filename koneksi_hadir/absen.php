<?php

	include_once "koneksi.php";
	class usr{}

	$nim = $_POST["nim"];
	$id_log_absen = $_POST["id_log_absen"];
	$pertemuan_log_absen = $_POST["pertemuan_log_absen"];
	
	
	$cek = mysqli_num_rows(mysqli_query($con,"SELECT * FROM absen WHERE nim_mahasiswa_absen='$nim' and id_log_absen='$id_log_absen'"));
    if ($cek > 0){
		$response = new usr();
		 $response->success = 0;
		 $response->message = "Anda sudah absen!";
		 die(json_encode($response));
    }else {
		mysqli_query($con, "INSERT INTO absen (id_absen, nim_mahasiswa_absen, id_log_absen, pertemuan_log_absen, keterangan_log_absen) VALUES(0,'".$nim."','".$id_log_absen."','".$pertemuan_log_absen."',1)");
		$response = new usr();
		 $response->success = 1;
		 $response->message = "Absen Berhasil!.";
		 die(json_encode($response));
    }
	
	mysqli_close($con);

?>	