<?php
	include 'koneksi.php';

	if($_GET['proses']=='entri') {

		if (isset($_POST['tambah']))
		{
			$simpan=mysqli_query($koneksi,"INSERT INTO biodata(full_name, date_of_birth, place_of_birth, phone_number, address, last_education, religon, hobby) VALUES ('$_POST[full_name]','$_POST[date_of_birth]','$_POST[place_of_birth]','$_POST[phone_number]','$_POST[address]','$_POST[last_education]','$_POST[religon]','$_POST[hobby]')");

			if($simpan) {
				header("location:index.php?p=biodata");
			}
			else {
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='hapus') {

		$hapus=mysqli_query($koneksi, "DELETE FROM biodata WHERE id='$_GET[id_hapus]'");

		if($hapus){
			header('location:index.php?p=biodata');
		}
	}

	if($_GET['proses']=='ubah') {
		
		if (isset($_POST['update']))
		{
			$ubah=mysqli_query($koneksi, "UPDATE biodata SET 
						full_name='$_POST[full_name]',
						date_of_birth='$_POST[date_of_birth]',
						place_of_birth='$_POST[place_of_birth]',
						phone_number='$_POST[phone_number]',
						address='$_POST[address]', 
						last_education='$_POST[last_education]', 
						religon='$_POST[religon]',
						hobby='$_POST[hobby]'
						WHERE id='$_GET[id_ubah]'");

			if($ubah){
				header("location:index.php?p=biodata");
			}
			else{
				echo "Gagal";
			}
		}
	}
?>