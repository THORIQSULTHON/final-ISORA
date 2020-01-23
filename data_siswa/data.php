<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Data Guru</h2>
			<hr />
			
			<!-- bagian ini untuk memfilter data berdasarkan status -->
			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filter Data Siswa</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="1" <?php if($filter == '1'){ echo 'selected'; } ?>>Kelas 1</option>
						<option value="2" <?php if($filter == '2'){ echo 'selected'; } ?>>Kelas 2</option>
                        <option value="3" <?php if($filter == '3'){ echo 'selected'; } ?>>Kelas 3</option>
						<option value="4" <?php if($filter == '4'){ echo 'selected'; } ?>>Kelas 4</option>
						<option value="5" <?php if($filter == '5'){ echo 'selected'; } ?>>Kelas 5</option>
                        <option value="6" <?php if($filter == '6'){ echo 'selected'; } ?>>Kelas 6</option>
					</select>
				</div>
			</form> <!-- end filter -->
			<br />
			<!-- memulai tabel responsive -->
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
					<th>No</th>
						<th>No. Induk</th>
						<th>NISN</th>
						<th>Nama</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>Jenis Kelamin</th>
						<th>Agama</th>
						<th>Nama Orang Tua</th>
						<th>Pekerjaan Orang Tua</th>
						<th>Alamat</th>
						<th>No Telepon</th>
						<th>Kelas</th>
						<th>Foto</th>
						<th>Tools</th>
					</tr>
					<?php
					if($filter){
						$sql = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE kelas='$filter' ORDER BY no_induk ASC"); // query jika filter dipilih
					}else{
						$sql = mysqli_query($koneksi, "SELECT * FROM tb_siswa ORDER BY no_induk ASC"); // jika tidak ada filter maka tampilkan semua entri
					}
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="8">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$row['no_induk'].'</td>
								<td>'.$row['nisn'].'</td>
								<td>'.$row['nama'].'</td>
								<td>'.$row['tempat_lahir'].'</td>
								<td>'.$row['tanggal_lahir'].'</td>
								<td>'.$row['jenis_kelamin'].'</td>
								<td>'.$row['agama'].'</td>
								<td>'.$row['nama_orang_tua'].'</td>
								<td>'.$row['pekerjaan'].'</td>
								<td>'.$row['alamat'].'</td>
								<td>'.$row['no_telepon'].'</td>
								<td>';
								if($row['kelas'] == '1'){
									echo '<span class="label label-success">Kelas 1</span>';
								}
								else if ($row['kelas'] == '2' ){
									echo '<span class="label label-info">Kelas 2</span>';
								}
								else if ($row['kelas'] == '3' ){
									echo '<span class="label label-warning">Kelas 3</span>';
								}
								else if($row['kelas'] == '4'){
									echo '<span class="label label-success">Kelas 4</span>';
								}
								else if ($row['kelas'] == '5' ){
									echo '<span class="label label-info">Kelas 5</span>';
								}
								else{
									echo '<span class="label label-warning">Kelas 6</span>';
								}
							echo '
								</td>
								<td>'.$row['foto'].'</td>
								<td>
									
									<a href="edit.php?no_induk='.$row['no_induk'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="password.php?no_induk='.$row['no_induk'].'" title="Ganti Password" data-toggle="tooltip" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
									<a href="hapus.php?aksi=delete&no_induk='.$row['no_induk'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
							</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
						}
					}
					?>
				</table>
			</div> <!-- /.table-responsive -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>