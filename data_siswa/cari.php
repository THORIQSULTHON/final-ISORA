<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<?php 
			$no_induk = $_POST['carino_induk']; // mengambil no_induk dari form cari ?> 
			<h2>Pencarian Data Guru &raquo; No. Induk: <?php echo $no_induk; // menampilkan no_induk ?></h2>
			<hr />
			
			<?php
			$sql = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE no_induk= '$no_induk'"); // query untuk memilih entri dengan no_induk terpilih
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
				
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			if(isset($_GET['aksi']) == 'delete'){ // jika tombol 'Hapus Data' pada baris 74 ditekan
				$delete = mysqli_query($koneksi, "DELETE FROM tb_siswa WHERE no_induk='$no_induk'"); // query delete entri dengan no_induk terpilih
				if($delete){ // jika query delete berhasil dieksekusi
					echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil dihapus.</div>'; // maka tampilkan 'Data berhasil dihapus.'
				}else{ // jika query delete gagal dieksekusi
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
				}
			}
			?>
			<!-- bagian ini digunakan untuk menampilkan data Guru hasil pencarian-->
			<table class="table table-striped table-condensed">
			<tr>
					<th width="20%">No. Induk</th>
					<td><?php echo $row['no_induk']; ?></td>
				</tr>
				<tr>
					<th width="20%">NISN</th>
					<td><?php echo $row['nisn']; ?></td>
				</tr>
				
				<tr>
					<th>Nama Siswa</th>
					<td><?php echo $row['nama']; ?></td>
				</tr>
				<tr>
					<th>Tempat & Tanggal Lahir</th>
					<td><?php echo $row['tempat_lahir'].', '.$row['tanggal_lahir']; ?></td>
				</tr>
				<tr>
					<th>Jenis Kelamin</th>
					<td><?php echo $row['jenis_kelamin']; ?></td>
				</tr>
				<tr>
					<th>Agama</th>
					<td><?php echo $row['agama']; ?></td>
				</tr>
				<tr>
					<th>Nama Orang Tua</th>
					<td><?php echo $row['nama_orang_tua']; ?></td>
				</tr>
				<tr>
					<th>Pekerjaan Orang Tua</th>
					<td><?php echo $row['pekerjaan']; ?></td>
				</tr>
				<tr>
					<th>Alamat</th>
					<td><?php echo $row['alamat']; ?></td>
				</tr>
				<tr>
					<th>No Telepon</th>
					<td><?php echo $row['no_telepon']; ?></td>
				</tr>
				<tr>
					<th>No Telepon</th>
					<td><?php echo $row['no_telepon']; ?></td>
				</tr>
				<tr>
					<th>Kelas</th>
					<td><?php echo $row['kelas']; ?></td>
				</tr>
					<th>Foto</th>
					<rd><?php echo $row['foto']; ?></td>
				</tr>
				<tr>
				<tr>
					<th>Username</th>
					<td><?php echo $row['username']; ?></td>
				</tr>
				<tr>
					<th>Password</th>
					<td><?php echo $row['password']; ?></td>
				</tr>
			</table>
			
			<a href="data.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali</a>
			<a href="edit.php?no_induk=<?php echo $row['no_induk']; ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Data</a>
			<a href="profile.php?aksi=delete&no_induk=<?php echo $row['no_induk']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin akan mengahapus data <?php echo $row['nama']; ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus Data</a>
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>