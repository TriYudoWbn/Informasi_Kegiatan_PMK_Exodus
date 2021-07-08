<!DOCTYPE html>
<html lang="en">
  <head>

    <?php
        include_once ('../layout/library.php') ; 
    ?>

  </head>
  <body>
      
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar">
    <div class="container">
        <a class="navbar-brand">PMK Exodus</a>
    </div>
</nav>

<?php
	session_start();
	
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$dataValid = "YA";
	if(strlen(trim($username))==0){
		echo "<center>Username harus di isi! </center><br/>";
		$dataValid = "TIDAK";
	}
	if(strlen(trim($password))==0){
		echo "<center>password harus di isi! </center><br/>";
		$dataValid = "TIDAK";
	}
	if($dataValid == "TIDAK"){
		echo "<center>Masih ada kesalahan, silahkan perbaiki! <center></br>";
		echo "<center><button class='btn card-button btn-sm' type='button' onclick='history.back();'> Kembali </button></center>";
		exit;
	}

	//include_once ('koneksi.php') ; 
	include "../../config/koneksi.php";

	$sql = "select * from admin where username='".$username."' and password='".$password."' limit 1";

	$hasil = mysqli_query($kon, $sql) or die ('Gagal Akses! <br/>');

	$jumlah = mysqli_num_rows($hasil);

	if($jumlah > 0){
		$row = mysqli_fetch_assoc($hasil);
		$_SESSION["id_admin"] = $row["id_admin"];
		$_SESSION["username"] = $row["username"];
		$_SESSION["password"] = $row["password"];
		header("Location:../kegiatan/tampil_data_kegiatan.php");
	}else{
		echo"<br>";
		echo "<center>User atau Password salah! </center><br/>";
		echo "<center><button class='btn card-button btn-sm' type='button' onclick='history.back();'> Kembali </button></center>";
	}
    
        //footer
        include_once ('../layout/footer.php') ; 
    ?>
    
</body>
</html>