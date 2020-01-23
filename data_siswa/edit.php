<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container" style="margin-top:180px">
	<div class="content" >
			<h2>Data Guru &raquo; Edit Data</h2>
			<hr />
			
			<?php
			$no_induk = $_GET['no_induk']; // assigment no_induk dengan nilai no_induk yang akan diedit
			$sql = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE no_induk='$no_induk'"); // query untuk memilih entri data dengan nilai nis terpilih
			// if(mysqli_num_rows($sql) == 0){
			// 	header("Location: index.php");
			// }else{
				$row = mysqli_fetch_assoc($sql);
			// }
			if(isset($_POST['save'])){ 
				$no_induk_id        = $_POST['no_induk'];
				$no_induk        = $_GET['no_induk'];
				// echo $no_induk;
				$nisn		     = $_POST['nisn'];
				$nama		     = $_POST['nama'];
				$tempat_lahir	 = $_POST['tempat_lahir'];
				$tanggal_lahir	 = $_POST['tanggal_lahir'];
				$jenis_kelamin   = $_POST['jenis_kelamin'];
				$agama           = $_POST['agama'];
				$nama_orang_tua  = $_POST['nama_orang_tua'];
				$pekerjaan       = $_POST['work'];
				$alamat		     = $_POST['alamat'];
				$no_telepon		 = $_POST['no_telepon'];
				$kelas			 = $_POST['kelas'];
				$foto			 = $_FILES['foto']['name'];
				if ($_FILES['foto']['name'] != '') {
					move_uploaded_file($_FILES['foto']['tmp_name'], "../img/".$foto);//upload foto ke folder
					$update = mysqli_query($koneksi, "UPDATE tb_siswa SET no_induk='$no_induk', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', agama='$agama', nama_orang_tua='$nama_orang_tua', pekerjaan='$pekerjaan',alamat='$alamat', no_telepon='$no_telepon', kelas='$kelas', foto='$foto' WHERE no_induk='$no_induk'") or die(mysqli_error($koneksi)); 
					
					// query untuk mengupdate nilai entri dalam database
				}else{
					// echo "UPDATE tb_siswa SET no_induk='$_POST[no_induk]', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', agama='$agama', nama_orang_tua='$nama_orang_tua', pekerjaan='$pekerjaan',alamat='$alamat', no_telepon='$no_telepon', kelas='$kelas' WHERE no_induk='$no_induk'";
					$update = mysqli_query($koneksi, "UPDATE tb_siswa SET no_induk='$no_induk', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', agama='$agama', nama_orang_tua='$nama_orang_tua', pekerjaan='$pekerjaan',alamat='$alamat', no_telepon='$no_telepon', kelas='$kelas', foto='$foto' WHERE no_induk='$no_induk'") or die(mysqli_error($koneksi)); // query untuk mengupdate nilai entri dalam database
				}
				if($update){ // jika query update berhasil dieksekusi
					header("Location: edit.php?no_induk=".$_POST['no_induk']."&pesan=sukses"); // tambahkan pesan=sukses pada url
				}else{ // jika query update gagal dieksekusi
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){ // jika terdapat pesan=sukses sebagai bagian dari berhasilnya query update dieksekusi
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>'; // maka tampilkan 'Data berhasil disimpan.'
			}
			?>
			<!-- bagian ini merupakan bagian form untuk mengupdate data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
					<label class="col-sm-3 control-label">No. Induk</label>
					<div class="col-sm-2">
						<input type="text" name="no_induk" value="<?php echo $row ['no_induk']; ?>" class="form-control" placeholder="no_induk" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NISN</label>
					<div class="col-sm-2">
						<input type="text" name="nisn" value="<?php echo $row ['nisn']; ?>" class="form-control" placeholder="NISN" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama</label>
					<div class="col-sm-4">
						<input type="text" name="nama" value="<?php echo $row ['nama']; ?>" class="form-control" placeholder="Nama" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tempat Lahir</label>
					<div class="col-sm-4">
						<input type="text" name="tempat_lahir" value="<?php echo $row ['tempat_lahir']; ?>" class="form-control" placeholder="Tempat Lahir" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Lahir</label>
					<div class="col-sm-4">
						<input type="text" name="tanggal_lahir" value="<?php echo $row ['tanggal_lahir']; ?>" class="input-group datepicker form-control" date="" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Kelamin</label>
					<div class="col-sm-2">
						<select name="jenis_kelamin" class="form-control" required>
						<?php if ($row['jenis_kelamin'] == "Laki-Laki"){
								echo '
									<option value="Laki-Laki">Laki-Laki</option>
									<option value="Perempuan">Perempuan</option>';
						}
							  else {
								  echo'
								  	<option value="Perempuan">Perempuan</option>
									<option value="Laki-Laki">Laki-Laki</option>';
							  }?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">agama</label>
					<div class="col-sm-2">
						<select name="agama" class="form-control" required>
						<?php if ($row['agama'] == "Islam"){
								echo '
								<option value="Islam">Islam</option>
								<option value="Kristen">Kristen</option>
								<option value="Katolik">Katolik</option>
								<option value="Budha">Budha</option>
								<option value="Hindu">Hindu</option>
								<option value="Kong Hu Cu">Kong Hu Cu</option>';
						}
							  else if($row['agama'] == "Kristen"){
								  echo'	
								  <option value="Kristen">Kristen</option>	
								  <option value="Islam">Islam</option>
								  <option value="Katolik">Katolik</option>
								  <option value="Budha">Budha</option>
								  <option value="Hindu">Hindu</option>
								  <option value="Kong Hu Cu">Kong Hu Cu</option>';
							  }
							  else if($row['agama'] == "Katolik"){
								echo'
								<option value="Katolik">Katolik</option>
								<option value="Kristen">Kristen</option>	
								<option value="Islam">Islam</option>
								<option value="Budha">Budha</option>
								<option value="Hindu">Hindu</option>
								<option value="Kong Hu Cu">Kong Hu Cu</option>';
							}
							else if($row['agama'] == "Budha"){
								echo'
								<option value="Budha">Budha</option>
								<option value="Katolik">Katolik</option>
								<option value="Kristen">Kristen</option>	
								<option value="Islam">Islam</option>
								<option value="Hindu">Hindu</option>
								<option value="Kong Hu Cu">Kong Hu Cu</option>';
							}
							else if($row['agama'] == "Hindu"){
								echo'
								<option value="Hindu">Hindu</option>
								<option value="Budha">Budha</option>
								<option value="Katolik">Katolik</option>
								<option value="Kristen">Kristen</option>	
								<option value="Islam">Islam</option>
								<option value="Kong Hu Cu">Kong Hu Cu</option>';
							}
							  else{
								echo '
								<option value="Kong Hu Cu">Kong Hu Cu</option>
								<option value="Hindu">Hindu</option>
								<option value="Budha">Budha</option>
								<option value="Katolik">Katolik</option>
								<option value="Kristen">Kristen</option>	
								<option value="Islam">Islam</option>';
							  }
						 ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Orang Tua</label>
					<div class="col-sm-2">
						<input type="text" name="nama_orang_tua" value="<?php echo $row ['nama_orang_tua']; ?>" class="form-control" placeholder="Nama Orang Tua" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Pekerjaan Orang Tua</label>
					<div class="col-sm-2">
						<input type="text" name="work" value="<?php echo $row ['pekerjaan']; ?>" class="form-control" placeholder="Pekerjaan Orang Tua" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat</label>
					<div class="col-sm-3">
						<textarea name="alamat" class="form-control" placeholder="alamat"><?php echo $row ['alamat']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">No Telepon</label>
					<div class="col-sm-3">
						<input type="text" name="no_telepon" value="<?php echo $row ['no_telepon']; ?>" class="form-control" placeholder="No Telepon" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Kelas</label>
					<div class="col-sm-2">
						<select name="kelas" class="form-control">
						<?php if ($row['kelas'] == "1"){
								echo '
								<option value="1">Kelas 1</option>
								<option value="2">Kelas 2</option>
								<option value="3">Kelas 3</option>
								<option value="4">Kelas 4</option>
								<option value="5">Kelas 5</option>
								<option value="6">Kelas 6</option>';
						}
							  else if($row['kelas'] == "2"){
								  echo'
								  <option value="2">Kelas 2</option> 
								  <option value="1">Kelas 1</option>
								<option value="3">Kelas 3</option>
								<option value="4">Kelas 4</option>
								<option value="5">Kelas 5</option>
								<option value="6">Kelas 6</option>';
							  }
							  else if($row['kelas'] == "3"){
								echo '
								<option value="3">Kelas 3</option>
								<option value="1">Kelas 1</option>
								<option value="2">Kelas 2</option>
								<option value="4">Kelas 4</option>
								<option value="5">Kelas 5</option>
								<option value="6">Kelas 6</option>';
							  }
							  else if($row['kelas'] == "4"){
								echo'
								<option value="4">Kelas 4</option>
								<option value="1">Kelas 1</option>
							  <option value="2">Kelas 2</option>
							  <option value="3">Kelas 3</option>
							  <option value="5">Kelas 5</option>
							  <option value="6">Kelas 6</option>';
							}
							else if($row['kelas'] == "5"){
							  echo '
							  <option value="5">Kelas 5</option>
							  <option value="1">Kelas 1</option>
							  <option value="2">Kelas 2</option>
							  <option value="3">Kelas 3</option>
							  <option value="4">Kelas 4</option>
							  <option value="6">Kelas 6</option>';
							}
							else{
							  echo '
							  <option value="6">Kelas 6</option>
							  <option value="1">Kelas 1</option>
							  <option value="2">Kelas 2</option>
							  <option value="3">Kelas 3</option>
							  <option value="4">Kelas 4</option>
							  <option value="5">Kelas 5</option>';
							}
						 ?>
						</select> 
					</div>
					<div class="col-sm-3">
                    <b>kelas Sekarang :</b> <span class="label label-info"><?php echo $row['kelas']; ?></span>
				    </div>
                </div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Foto</label>
					<div class="col-sm-2">
						<input type="file" name="foto">
						<img src="../img/<?php echo $row['foto'] ?>" width="30" higth="40">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Siswa">
						<a href="data.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form>
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>