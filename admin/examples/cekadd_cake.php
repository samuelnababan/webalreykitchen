<?php
// memanggil file koneksi.php untuk melakukan koneksi database
session_start(); 
error_reporting(0);

require 'koneksi.php';

	// membuat variabel untuk menampung data dari form
  $cake_name = $_POST['cake_name'];
  $cake_desc = $_POST['cake_desc'];
  $category_id = $_POST['category_id'];
  $cake_photo = $_FILES['cake_photo']['name'];
  $cake_price = $_POST['cake_price'];
 


//cek dulu jika ada gambar produk jalankan coding ini
if($cake_photo != "") {
  $ekstensi_diperbolehkan = array('png','jpg','jpeg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $cake_photo); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['cake_photo']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_gambar_baru = $angka_acak.'-'.$cake_photo; //menggabungkan angka acak dengan nama file sebenarnya
        if(in_array($ekstensi, $ekstensi_diperbolehkan) == true)  {     
                move_uploaded_file($file_tmp, '../../assets/img/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                  // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                  $query = "INSERT INTO cake_tbl VALUES ('','$cake_name', '$cake_desc', '$category_id', '$nama_gambar_baru', '$cake_price')";
                  $result = mysqli_query($conn, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($conn).
                           " - ".mysqli_error($conn));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='tbl_cake.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='add_cake.php';</script>";
            }
} else {
   $query = "INSERT INTO cake_tbl VALUES ('','$cake_name', '$cake_desc', '$category_id', null, '$cake_price')";
                  $result = mysqli_query($conn, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($conn).
                           " - ".mysqli_error($conn));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='tbl_cake.php';</script>";
                  }
}
