 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">List Peserta</h1>
 </div>

<?php
	include 'koneksi.php';
?>

<table class="table table-striped table-sm">
    <thead>
        <tr>
          <th>Nama Lengkap</th>
          <th>Tempat Lahir</th>
          <th>Tanggal Lahir</th>
          <th>No. Hp</th>
          <th>Alamat</th>
          <th>Pendidikan Terakhir</th>
          <th>Agama</th>
          <th>Hobby</th>
        </tr>
    </thead>

	    <?php
	      	$db_panggil=mysqli_query($koneksi, "SELECT biodata.id, biodata.full_name, biodata.place_of_birth, biodata.place_of_birth_id, biodata.date_of_birth, biodata.phone_number, biodata.last_education, biodata.religon,biodata.address,biodata.hobby, cities.id, cities.name FROM biodata INNER JOIN cities ON biodata.place_of_birth_id=cities.id GROUP BY cities.id");

				while ($data=mysqli_fetch_array($db_panggil)){
		?>
	
	<tr>
		<td><?php echo $data['full_name']?></td>
		<td><?php echo $data['place_of_birth']?></td>
		<td><?php echo $data['date_of_birth']?></td>
		<td><?php echo $data['phone_number']?></td>
		<td><?php echo $data['address']?></td>
		<td><?php echo $data['last_education']?></td>
		<td><?php echo $data['religon']?></td>	
		<td><?php echo $data['hobby']?></td>
	</tr>		
	
	<?php
		}
	?>
           
</table>