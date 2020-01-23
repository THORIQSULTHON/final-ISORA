<?php 
include 'header.php'; // memanggil file header.php
include 'koneksi.php'; // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content" style="margin-top:80px">
			<h2>Data siswa &raquo; Tambah Data</h2>
			<hr />
			
			<?php
			if(isset($_POST['add'])){ // jika tombol 'Simpan' dengan properti name="add" pada baris 137 ditekan
				$no_induk		 = $_POST['no_induk'];
				$nisn		     = $_POST['nisn'];
				$nama		     = $_POST['nama'];
				$tempat_lahir	 = $_POST['tempat_lahir'];
				$tanggal_lahir	 = $_POST['tanggal_lahir'];
				$jenis_kelamin   = $_POST['jenis_kelamin'];
				$agama           = $_POST['agama'];
				$alamat		     = $_POST['alamat'];
				$nama_orang_tua  = $_POST['nama_orang_tua'];
				$pekerjaan       = $_POST['work'];
				$no_telepon		 = $_POST['no_telepon'];
				$kelas			 = $_POST['kelas'];
				$foto			 = $_FILES['foto']['name'];
				$username		 = $_POST['username'];
				$pass1	         = $_POST['pass1'];
				$pass2           = $_POST['pass2'];	
				$cek = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE no_induk='$no_induk'"); // query untuk memilih entri dengan no_induk terpilih	
				if(mysqli_num_rows($cek) == 0){ // mengecek apakah no_induk yang akan ditambahkan tidak ada dalam database

					if($pass1 == $pass2){ // mengecek apakah nilai pada pass1 dan pass2 bernilai sama
						$pass = md5($pass1); // assigment variabel pass dengan nilai pass1 yang sudah dienkripsi dengan md5
						move_uploaded_file($_FILES['foto']['tmp_name'], "../img/".$foto);//upload foto ke folder
						$insert = mysqli_query($koneksi, "INSERT INTO tb_siswa(no_induk, nisn, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, nama_orang_tua, pekerjaan, alamat, no_telepon, kelas, foto, username, password) VALUES('$no_induk','$nisn', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$agama', '$nama_orang_tua', '$pekerjaan','$alamat', '$no_telepon', '$kelas', '$foto', '$username', '$pass')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data siswa Berhasil Di Simpan.</div>'; // maka tampilkan 'Data siswa Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data siswa Gagal Di simpan!</div>'; // maka tampilkan 'Ups, Data siswa Gagal Di simpan!'
						}
					} else{ // mengecek jika password yang diinput tidak sama
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Tidak sama!</div>'; // maka tampilkan 'Password Tidak sama!'
					}
				}else{ // mengecek jika no_induk yang akan ditambahkan sudah ada dalam database
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>no_induk Sudah Ada..!</div>'; // maka tampilkan 'no_induk Sudah Ada..!'
				}
			}
			?>
			<!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
			
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
					<label class="col-sm-3 control-label">No. Induk</label>
					<div class="col-sm-2">
						<input type="text" name="no_induk" class="form-control" placeholder="No. Induk" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NISN</label>
					<div class="col-sm-2">
						<input type="text" name="nisn" class="form-control" placeholder="NISN" required>
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
					<label class="col-sm-3 control-label">Nama Orang Tua</label>
					<div class="col-sm-3">
						<input type="text" name="nama_orang_tua" class="form-control" placeholder="Nama Orang Tua" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Pekerjaan Orang Tua</label>
					<div class="col-sm-3">
						<input type="text" name="work" class="form-control" placeholder="Pekerjaan Orang Tua" required>
					</div>
				</div>
					
				<div class="form-group">
					<label class="col-sm-3 control-label">No Telepon</label>
					<div class="col-sm-3">
						<input type="number" name="no_telepon" id="telp" class="form-control" placeholder="No Telepon" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">kelas</label>
					<div class="col-sm-3">
						<select name="kelas" class="form-control">
							<option value=""> -Kelas- </option>
                            <option value="1">Kelas 1</option>
							<option value="2">Kelas 2</option>
							<option value="3">Kelas 3</option>
							<option value="4">Kelas 4</option>
							<option value="5">Kelas 5</option>
							<option value="6">Kelas 6</option>
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
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data siswa">
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
