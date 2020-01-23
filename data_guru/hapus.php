<?php
include "koneksi.php";
if(isset($_GET['aksi']) == 'delete'){ // mengkonfirmasi jika 'aksi' bernilai 'delete' merujuk pada baris 90 dibawah
				$nip = $_GET['nip']; // ambil nilai nip
				$cek = mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE nip='$nip'"); // query untuk memilih entri dengan nip yang dipilih
				if(mysqli_num_rows($cek) == 0){ // mengecek jika tidak ada entri nip yang dipilih
                    echo '<script>alert("Data tidak ditemukan");window.history.back();</script>'; // maka tampilkan 'Data tidak ditemukan.'
                 
				}else{ // mengecek jika terdapat entri nip yang dipilih
					$delete = mysqli_query($koneksi, "DELETE FROM tb_guru WHERE nip='$nip'"); // query untuk menghapus
					if($delete){ // jika query delete berhasil dieksekusi
                        header('location:data.php'); // maka tampilkan 'Data berhasil dihapus.'
                        
					}else{ // jika query delete gagal dieksekusi
                        echo '<script>alert("Data Gagal Dihapus");window.history.back();</script>'; // maka tampilkan 'Data gagal dihapus.'
                    
					}
				}
            }
            ?>