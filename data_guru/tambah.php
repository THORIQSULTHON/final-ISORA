<?php 
include 'header.php'; // memanggil file header.php
include 'koneksi.php'; // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Data Guru &raquo; Tambah Data</h2>
			<hr />
			
			<?php
			if(isset($_POST['add'])){ // jika tombol 'Simpan' dengan properti name="add" pada baris 137 ditekan
				$nip		     = $_POST['nip'];
				$nama		     = $_POST['nama'];
				$tempat_lahir	 = $_POST['tempat_lahir'];
				$tanggal_lahir	 = $_POST['tanggal_lahir'];
				$jenis_kelamin   = $_POST['jenis_kelamin'];
				$agama           = $_POST['agama'];
				$alamat		     = $_POST['alamat'];
				$no_telepon		 = $_POST['no_telepon'];
				$jabatan		 = $_POST['jabatan'];
				$status			 = $_POST['status'];
				$foto			 = $_FILES['foto']['name'];
				$username		 = $_POST['username'];
				$pass1	         = $_POST['pass1'];
				$pass2           = $_POST['pass2'];
				
				$cek = mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE nip='$nip'"); // query untuk memilih entri dengan nip terpilih	
				if(mysqli_num_rows($cek) == 0){ // mengecek apakah nip yang akan ditambahkan tidak ada dalam database
					if($pass1 == $pass2){ // mengecek apakah nilai pada pass1 dan pass2 bernilai sama
						$pass = md5($pass1); // assigment variabel pass dengan nilai pass1 yang sudah dienkripsi dengan md5
						move_uploaded_file($_FILES['foto']['tmp_name'], "../img/".$foto);//upload foto ke folder
						$insert = mysqli_query($koneksi, "INSERT INTO tb_guru(nip, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, no_telepon, jabatan, status, foto, username, password) VALUES('$nip', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$agama','$alamat', '$no_telepon','$jabatan', '$status', '$foto', '$username', '$pass')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Guru Berhasil Di Simpan.</div>'; // maka tampilkan 'Data Guru Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Guru Gagal Di simpan!</div>'; // maka tampilkan 'Ups, Data Guru Gagal Di simpan!'
						}
					} else{ // mengecek jika password yang diinput tidak sama
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Tidak sama!</div>'; // maka tampilkan 'Password Tidak sama!'
					}
				}else{ // mengecek jika nip yang akan ditambahkan sudah ada dalam database
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>NIP Sudah Ada..!</div>'; // maka tampilkan 'NIP Sudah Ada..!'
				}
			}
			?>
			<!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
			
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-3 control-label">NIP</label>
					<div class="col-sm-2">
						<input type="number" id="telp" name="nip" class="form-control" placeholder="nip" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama</label>
					<div class="col-sm-4">
						<input type="text" name="nama" class="form-control" placeholder="Nama" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tempat Lahir</label>
					<div class="col-sm-4">
						<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Lahir</label>
					<div class="col-sm-3">
						<input type="text" name="tanggal_lahir" class="input-group datepicker form-control" date="" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Kelamin</label>
					<div class="col-sm-2">
						<select name="jenis_kelamin" class="form-control" required>
							<option value=""> -Jenis Kelamin- </option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Agama</label>
					<div class="col-sm-2">
						<select name="agama" class="form-control" required>
							<option value=""> -Agama- </option>
							<option value="Islam">Islam</option>
							<option value="Kristen">Kristen</option>
							<option value="Katolik">Katolik</option>
							<option value="Budha">Budha</option>
							<option value="Hindu">Hindu</option>
							<option value="Kong Hu Cu">Kong Hu Cu</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat</label>
					<div class="col-sm-3">
						<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">No Telepon</label>
					<div class="col-sm-3">
						<input type="number" name="no_telepon" id="telp" class="form-control" placeholder="No Telepon" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jabatan</label>
					<div class="col-sm-3">
						<select name="jabatan" class="form-control">
							<option value=""> --Jabatan-- </option>
							<option value="Kepala Sekolah">Kepala Sekolah</option>
							<option value="Guru Pengajar">Guru Pengajar</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status</label>
					<div class="col-sm-3">
						<select name="status" class="form-control">
							<option value=""> --status-- </option>
							<option value="CPNS">CPNS</option>
							<option value="PNS">PNS</option>
						</select>
					</div>
				</div>
				<div>
				<div class="form-group">
				<label class="col-sm-3 control-label">Foto</label>
				<input type="file" name="foto">
				</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Username</label>
					<div class="col-sm-3">
						<input type="text" name="username" class="form-control" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-3">
						<input type="password" name="pass1" class="form-control" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Ulangi Password</label>
					<div class="col-sm-3">
						<input type="password" name="pass2" class="form-control" placeholder="Ulangi Password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Guru">
						<a href="index.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
	<script>
	(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));

$(document).ready(function() {
  $("#telp").inputFilter(function(value) {
    return /^\d*$/.test(value);    // Allow digits only, using a RegExp
  });
});
	</script>
<?php 
include 'footer.php'; // memanggil file footer.php
?>