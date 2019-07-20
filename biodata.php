<?php
	include 'koneksi.php';

	$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
	switch ($aksi) {
		case 'list':
	
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Biodata</h1>
</div>

<a class="btn btn-primary" role ="button" href="index.php?p=biodata&aksi=input">Tambah Data</a>

<table id="example" class="table table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th>ID</th>
			<th>Nama Lengkap</th>
			<th>Tanggal Lahir</th>
			<th>Tempat Lahir</th>
			<th>No. Hp</th>
			<th>Alamat</th>
			<th>Pendidikan Terakhir</th>
			<th>Agama</th>
			<th>Hobby</th>
			<th>Aksi</th>
		</tr>
	</thead>

	<tbody>
		<?php
			

			$db_panggil=mysqli_query($koneksi,"SELECT *FROM biodata");
			$no=1;
			while ($data=mysqli_fetch_array($db_panggil))
			{

		?>
	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $data['id']?></td>
		<td><?php echo $data['full_name']?></td>
		<td><?php echo $data['date_of_birth']?></td>
		<td><?php echo $data['place_of_birth']?></td>
		<td><?php echo $data['phone_number']?></td>
		<td><?php echo $data['address']?></td>
		<td><?php echo $data['last_education']?></td>
		<td><?php echo $data['religon']?></td>
		<td><?php echo $data['hobby']?></td>


		<td align="center">
			<a class="btn btn-primary" href="?p=biodata&aksi=edit&id_ubah=<?php echo $data['id'] ?>">Edit</a> 
			<a class="btn btn-danger" href="aksi_biodata.php?proses=hapus&id_hapus=<?php echo $data['id'] ?>" onclick="return confirm('Yakin akan menghapus data <?php echo $data['full_name']?>?')">Hapus</a>
			
		</td>
	</tr>
	<?php
		$no++;
		}
	?>
	</tbody>
</table>

<?php
	break;
	case 'input' : 
?>

<h1>Entri List Biodata</h1>
	<form method="post" action="aksi_biodata.php?proses=entri">

		<div class="form-group">
			<label>Nama Lengkap</label>
 			<input type="text" class="form-control col-sm-5" name="full_name">
 		</div>

 		<div class="form-group">
			<label>Tanggal Lahir</label>
 			<input type="date" class="form-control col-sm-5" name="date_of_birth">
 		</div>

 		<div class="form-group">
			<label>Tempat Lahir</label>
 			<select class="form-control col-sm-5" name="name">
				<?php
					include 'koneksi.php';
					$input = mysqli_query($koneksi,"SELECT * FROM cities");
					$no=1;
					while($data_input = mysqli_fetch_array($input)){
						echo "<option value='$data_input[name]'>" . $data_input['name'] . "</option>";
							$no++;
						}
				?>
			</select>
 		</div>
 		
 		<div class="form-group">
			<label>No Hp</label>
 			<input type="text" class="form-control col-sm-5" name="phone_number">
 		</div>
		
		<div class="form-group">
			<label>Alamat</label>
 			<textarea name="address" class="form-control col-sm-5"></textarea>
 		</div>

 		
	    <div class="row">
	      <legend class="col-form-label col-sm-2 pt-0">Pendidikan Terakhir</legend>
	      <div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
			  <label class="form-check-label" for="inlineRadio1">SMA</label>
		  </div>

		  <div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
			  <label class="form-check-label" for="inlineRadio2">S1</label>
		  </div>
	    </div>
  		
		<div class="row">
		    <legend class="col-form-label col-sm-2 pt-0">Agama</legend>
		  
		      <div>
			        <select class="custom-select custom-select-sm">
					  <option value="Islam">Islam</option>
					  <option value="Kristen">Kristen</option>
					  <option value="Katolik">Katolik</option>
					</select>
		      </div>
		</div>

		<div class="container">
		  <p>Hobby</p>
		  <form>
		    <div class="checkbox">
		      <label><input type="checkbox" value="Renang">Renang</label>
		    </div>
		    <div class="checkbox">
		      <label><input type="checkbox" value="Game">Game</label>
		    </div>
		    <div class="checkbox disabled">
		      <label><input type="checkbox" value="Gibah">Gibah</label>
		    </div>
		    <div class="checkbox disabled">
		      <label><input type="checkbox" value="Programming">Programming</label>
		    </div>
		  </form>
		</div>

		<input class="btn btn-primary" type="submit" name="tambah" value="Submit">
		<input class="btn btn-primary" type="reset" name="reset" value="Reset">
		<a class="btn btn-primary" role ="button" href="index.php?p=biodata">Kembali</a>
	</form>

<?php
	break;
	case 'edit' : 
		include 'koneksi.php';
			$db_panggil=mysqli_query($koneksi, "SELECT biodata.id, biodata.full_name, biodata.place_of_birth, biodata.place_of_birth_id, biodata.date_of_birth, biodata.phone_number, biodata.last_education, biodata.religon,biodata.address,biodata.hobby, cities.id, cities.name FROM biodata INNER JOIN cities ON cities.id=biodata.place_of_birth_id WHERE biodata.id='$_GET[id_ubah]'");
			$data=mysqli_fetch_array($db_panggil);
?>
	<h1>Update Form Biodata</h1>
	<form method="post" action="aksi_biodata.php?proses=ubah&id_ubah=<?php echo $data['id']?>">
		<table>
			<tr>
				<td>ID</td>
				<td> : </td>
				<td>
					<input type="text" value="<?php echo $data['id'] ?>" name="id" readonly>
				</td>
			</tr>

			<tr>
				<td>Nama Lengkap</td>
				<td> : </td>
				<td><input type="text" value="<?php echo $data['full_name'] ?>" name="full_name"></td>
			</tr>

			<tr>
				<td>Tanggal Lahir</td>
				<td> : </td>
				<td><input type="date" value="<?php echo $data['date_of_birth'] ?>" name="date_of_birth"></td>
			</tr>

			<tr>
				<td>Tempat Lahir</td>
				<td> : </td>
				<td>
					<select>
						<?php
							include 'koneksi.php';
							$input = mysqli_query($koneksi, "SELECT * FROM cities");
							$no=1;
							while($data_input = mysqli_fetch_array($input)){
								echo "<option value='$data_input[name]'>" . $data_input['name'] . "</option>";
									$no++;
								}

							
						?>
					</select>
				</td>
			</tr>

			<tr>
				<td>No Hp</td>
				<td> : </td>
				<td><input type="number" value="<?php echo $data['phone_number'] ?>" name="phone_number"></td>
			</tr>

			<tr>
				<td>Alamat</td>
				<td> : </td>
				<td><textarea name="address" cols="25" rows="5"><?php echo $data['address'] ?></textarea></td>
			</tr>

			<tr>
				<td>Pendidikan Terakhir</td>
				<td> : </td>
				<td>
					<?php
						if($data['last_education']=='SMA'){

						
					?>

						<input type="radio" name="last_education" value="SMA" checked>SMA
						<input type="radio" name="last_education" value="S1">S1


					<?php
						}
							else {
					?>
						<input type="radio" name="last_education" value="SMA">SMA
						<input type="radio" name="last_education" value="S1" checked>S1
					<?php
						}
					?>
				</td>
			</tr>			

			<tr>
				<td>Agama</td>
				<td> : </td>
				<td>
					<?php
						if($data['religon']=='Islam'){
			
					?>

						<input type="radio" name="religon" value="Islam" checked>Islam
						<input type="radio" name="religon" value="Kristen">Kristen
						<input type="radio" name="religon" value="Katolik">Katolik

					<?php
						}
							else {
					?>
						<input type="radio" name="religon" value="Islam">Islam
						<input type="radio" name="religon" value="Katolik">Kristen
						<input type="radio" name="religon" value="Katolik" checked>Katolik

					<?php	
						}
					?>
				</td>
			</tr>			

			<tr>
				<td></td>
				<td></td>
				<td><input class="btn btn-primary" type="submit" name="update" value="Update">
					<input class="btn btn-primary" type="reset" name="reset" value="Reset">
					<a class="btn btn-primary" href="index.php?p=biodata" role="button ">Back
				</td>
			</tr>
		</table>
	</form>
<?php
 	break;
 	}
 ?>