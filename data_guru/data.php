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
						<option value="0">Filter Data Guru</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="PNS" <?php if($filter == 'PNS'){ echo 'selected'; } ?>>PNS</option>
						<option value="CPNS" <?php if($filter == 'CPNS'){ echo 'selected'; } ?>>CPNS</option>
					</select>
				</div>
			</form> <!-- end filter -->
			<br />
			<!-- memulai tabel responsive -->
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>Jenis Kelamin</th>
						<th>Agama</th>
						<th>Alamat</th>
						<th>No Telepon</th>
						<th>Jabatan</th>
						<th>Status</th>
						<th>Foto</th>
						<th>Tools</th>
					</tr>
					<?php
					if($filter){
						$sql = mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE status='$filter' ORDER BY nip ASC"); // query jika filter dipilih
					}else{
						$sql = mysqli_query($koneksi, "SELECT * FROM tb_guru ORDER BY nip ASC"); // jika tidak ada filter maka tampilkan semua entri
					}
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="8">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$row['nip'].'</td>
								<td>'.$row['nama'].'</td>
								<td>'.$row['tempat_lahir'].'</td>
								<td>'.$row['tanggal_lahir'].'</td>
								<td>'.$row['jenis_kelamin'].'</td>
								<td>'.$row['agama'].'</td>
								<td>'.$row['alamat'].'</td>
								<td>'.$row['no_telepon'].'</td>
								<td>';
								if($row['jabatan'] == 'Kepala Sekolah'){
									echo '<span class="label label-success">Kepala Sekolah</span>';
								}
								else {
									echo '<span class="label label-warning">Guru</span>';
								}
							echo '
								</td>
								<td>';
								if($row['status'] == 'PNS'){
									echo '<span class="label label-success">PNS</span>';
								}
								else {
									echo '<span class="label label-warning">CPNS</span>';
								}
							echo '
								</td>
								<td>'.$row['foto'].'</td>
								<td>
									
									<a href="edit.php?nip='.$row['nip'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="password.php?nip='.$row['nip'].'" title="Ganti Password" data-toggle="tooltip" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
									<a href="hapus.php?aksi=delete&nip='.$row['nip'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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