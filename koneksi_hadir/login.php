<?php
	
	//=================== KALAU PAKAI MYSQLI YANG ATAS SEMUA DI REMARK, TERUS YANG INI RI UNREMARK ========
	 include_once "koneksi.php";

	 class usr{}
	
	 $username = $_POST["username"];
	 $password = $_POST["password"];
	
	 if ((empty($username)) || (empty($password))) { 
	 	$response = new usr();
	 	$response->success = 0;
	 	$response->message = "Kolom tidak boleh kosong"; 
	 	die(json_encode($response));
	 }
	
	 $query = mysqli_query($con, "SELECT * FROM mahasiswa WHERE nim_mahasiswa='$username' AND password_mahasiswa=MD5('$password')");
	
	 $row = mysqli_fetch_array($query);
	
	 if (!empty($row)){
	 	$response = new usr();
	 	$response->success = 1;
	 	$response->message = "Selamat datang ".$row['nama_mahasiswa'];
	 	$response->id = $row['nim_mahasiswa'];
	 	$response->username = $row['nama_mahasiswa'];
	 	die(json_encode($response));
		
	 } else { 
	 	$response = new usr();
	 	$response->success = 0;
	 	$response->message = "NIM atau password salah";
	 	die(json_encode($response));
	 }
	
	 mysqli_close($con);

?>