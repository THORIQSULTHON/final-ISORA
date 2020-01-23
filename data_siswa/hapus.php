<?php
include "koneksi.php";
if(isset($_GET['aksi']) == 'delete'){ // mengkonfirmasi jika 'aksi' bernilai 'delete' merujuk pada baris 90 dibawah
				$no_induk = $_GET['no_induk']; // ambil nilai no_induk
				$cek = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE no_induk='$no_induk'"); // query untuk memilih entri dengan no_induk yang dipilih
				if(mysqli_num_rows($cek) == 0){ // mengecek jika tidak ada entri no_induk yang dipilih
                    echo '<script>alert("Data tidak ditemukan");window.history.back();</script>'; // maka tampilkan 'Data tidak ditemukan.'
                 
				}else{ // mengecek jika terdapat entri no_induk yang dipilih
					$delete = mysqli_query($koneksi, "DELETE FROM tb_siswa WHERE no_induk='$no_induk'"); // query untuk menghapus
					if($delete){ // jika query delete berhasil dieksekusi
                        header('location:data.php'); // maka tampilkan 'Data berhasil dihapus.'
                        
					}else{ // jika query delete gagal dieksekusi
                        echo '<script>alert("Data Gagal Dihapus");window.history.back();</script>'; // maka tampilkan 'Data gagal dihapus.'
                    
					}
				}
            }
            ?>