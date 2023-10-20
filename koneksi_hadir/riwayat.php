<?php

//-------------database 

$dbhost = 'http://presensi-online.my.id';
$dbuser = 'root';
$dbpass = '';
$dbname = 'presen24_fullstack-absen';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

mysqli_select_db($conn, $dbname);


//------------------------ 
// array for JSON response 

$response = array();

//------if($_SERVER['REQUEST_METHOD']=='POST'){     
$d_kriteria = $_GET['tanggal'];
$d_kriteria2 = $_GET['nim'];

$zsql = "";
$zsql = $zsql . "select * From log JOIN absen ON absen.id_log_absen=log.id_log 
									JOIN identity_log_book ON identity_log_book.id_identity=log.id_identity_log
									JOIN mata_kuliah ON mata_kuliah.id_mata_kuliah=identity_log_book.id_makul_group
									JOIN users ON users.id=identity_log_book.id_dosen_identity
									JOIN ruang ON ruang.id_ruang=log.id_ruang_log
									JOIN kelas ON kelas.id_kelas=identity_log_book.id_kelas_identity
									WHERE hari_log='$d_kriteria' AND nim_mahasiswa_absen='$d_kriteria2' ";

//$zsql = $zsql." WHERE id_log like '%%".$d_kriteria."%%'";  
//$zsql = $zsql." or id_identity_log like '%%".$d_kriteria."%%'";  
//$zsql = $zsql." or hari_log like '%%".$d_kriteria."%%'";  
//$zsql = $zsql." or waktu_mulai_log like '%%".$d_kriteria."%%'";  
//$zsql = $zsql." or waktu_selesai_log like '%%".$d_kriteria."%%'";  
//$zsql = $zsql." or id_ruang_log like '%%".$d_kriteria."%%'";  
//$zsql = $zsql." or materi_log like '%%".$d_kriteria."%%'"; 
//$zsql = $zsql." or metode_pbm_log like '%%".$d_kriteria."%%'"; 
//$zsql = $zsql." or jumlah_mhs_hadir_log like '%%".$d_kriteria."%%'"; 
//$zsql = $zsql." or nim_mahasiswa_absen like '%%".$d_kriteria."%%'"; 
//$zsql = $zsql." or id_makul_identity like '%%".$d_kriteria."%%'"; 
//$zsql = $zsql." or id_dosen_identity like '%%".$d_kriteria."%%'"; 
//$zsql = $zsql." or nama_dosen like '%%".$d_kriteria."%%'";
//$zsql = $zsql." or nama_ruang like '%%".$d_kriteria."%%'";  
//$zsql = $zsql." or nama_mata_kuliah like '%%".$d_kriteria."%%'"; 
//$zsql = $zsql." or nama_kelas like '%%".$d_kriteria."%%'"; 

$result = mysqli_query($conn, $zsql);

if ($result === FALSE) {
	die(mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {

	$response["databsen"] = array();

	while ($row = mysqli_fetch_array($result)) {

		// temp user array    
		$datafield = array();
		$datafield["id_log"] = $row["id_log"];
		$datafield["id_identity_log"] = $row["id_identity_log"];
		$datafield["hari_log"] = $row["hari_log"];
		$datafield["waktu_mulai_log"] = $row["waktu_mulai_log"];
		$datafield["waktu_selesai_log"] = $row["waktu_selesai_log"];
		$datafield["id_ruang_log"] = $row["id_ruang_log"];
		$datafield["materi_log"] = $row["materi_log"];
		$datafield["metode_pbm_log"] = $row["metode_pbm_log"];
		$datafield["jumlah_mhs_hadir_log"] = $row["jumlah_mhs_hadir_log"];
		$datafield["nim_mahasiswa_absen"] = $row["nim_mahasiswa_absen"];
		$datafield["id_makul_group"] = $row["id_makul_group"];
		$datafield["id_dosen_identity"] = $row["id_dosen_identity"];
		$datafield["name"] = $row["name"];
		$datafield["nama_mata_kuliah"] = $row["nama_mata_kuliah"];
		$datafield["nama_ruang"] = $row["nama_ruang"];
		$datafield["nama_kelas"] = $row["nama_kelas"];

		// push single product into final response array    
		array_push($response["databsen"], $datafield);
	}

	// success   
	$response["success"] = 1;

	// echoing JSON response   
	echo json_encode($response);
} else {

	$response["success"] = 0;
	$response["message"] = "No user found";
	// echoing JSON response   
	echo json_encode($response);
}



//-------close database 
mysqli_close($conn);
