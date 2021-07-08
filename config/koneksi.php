<?php
	error_reporting (E_ALL ^ E_DEPRECATED);
		$host = "localhost";
		$user = "root";
		$pass = "";
		$dbname = "exodus";

		$kon = mysqli_connect($host, $user, $pass);
		if (!$kon)
			die("Gagal Koneksi ...");

		$hasil = mysqli_select_db($kon,$dbname);
		if (!$hasil) {
			$hasil = mysqli_query ($kon,"CREATE DATABASE $dbname");
			if (!$hasil)
				die("Gagal Buat database");
			else
				$hasil = mysqli_select_db($kon, $dbname);
				if (!$hasil) die ("Gagal Konek Database");
		}



	$sqlTabelAdmin = "create table if not exists admin (
						id_admin int(11) auto_increment not null primary key,
						username varchar(30) not null,
						password varchar (40) not null unique
						)";


	mysqli_query ($kon, $sqlTabelAdmin) or die("Gagal Buat Tabel Admin");




	$sqlTabelKegiatan = "create table if not exists kegiatan (
						id_kgt int(11) auto_increment not null primary key,
						nama_kegiatan varchar(30) not null,
						tgl_kegiatan date not null,
						waktu time not null,
						jenis_kegiatan enum('Ibadah','Keakraban','Bakti Sosial') not null,
						catatan text not null,
						latitude float(10,6) not null,
						longitude float(10,6) not null,
						`created_at` timestamp,
						colapse varchar(10) NOT NULL,
						id_admin int(11) not null,


						CONSTRAINT FOREIGN KEY (id_admin) REFERENCES admin (id_admin) ON DELETE RESTRICT ON UPDATE CASCADE
						)";


	mysqli_query ($kon, $sqlTabelKegiatan) or die("Gagal Buat Tabel Kegiatan".mysqli_error($kon));



	$sqlTabelArtikel = "create table if not exists artikel (
						id_artkl int(11) auto_increment NOT NULL primary key,
						judul varchar(30) NOT NULL,
						isi_artikel text NOT NULL,
						tgl_artikel date NOT NULL,
						gambar varchar(200) NOT NULL,
						`created_at` timestamp,
						colapse varchar(10) NOT NULL,
						id_admin int(11) not null,


						CONSTRAINT FOREIGN KEY (id_admin) REFERENCES admin (id_admin) ON DELETE RESTRICT ON UPDATE CASCADE
						)";


	mysqli_query ($kon,$sqlTabelArtikel) or die("Gagal Buat Tabel Artikel");



	$sqlTabelKomentar = "create table if not exists komentar (
						id int(11) NOT NULL AUTO_INCREMENT primary key,
						nama_pengirim varchar(30) NOT NULL,
						isi_komentar text NOT NULL,
						`created_at` timestamp,
						id_kgt int(11) NOT NULL,

						CONSTRAINT FOREIGN KEY (id_kgt) REFERENCES kegiatan (id_kgt) ON DELETE RESTRICT ON UPDATE CASCADE
						)";

	mysqli_query ($kon,$sqlTabelKomentar) or die("Gagal Buat Tabel komentar");


?>