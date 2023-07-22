<?php
// memanggil file koneksi.php untuk melakukan koneksi database
session_start(); 
error_reporting(0);

require 'koneksi.php';
$id = $_GET["id"];
	// membuat variabel untuk menampung data dari form
  $category_name = $_POST['category_name'];
  $category_photo = $_FILES['category_photo']['name'];
  $category_detail = $_POST['category_detail'];
 


//cek dulu jika ada gambar produk jalankan coding ini
if($category_photo != "") {
  $ekstensi_diperbolehkan = array('png','jpg','jpeg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $category_photo); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['category_photo']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_gambar_baru = $angka_acak.'-'.$category_photo; //menggabungkan angka acak dengan nama file sebenarnya
        if(in_array($ekstensi, $ekstensi_diperbolehkan) == true)  {     
                move_uploaded_file($file_tmp, '../../assets/img/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                  // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                  $query = "UPDATE category_tbl SET category_name ='$category_name', 
                  category_photo = '$nama_gambar_baru',
                  category_detail = '$category_detail' where id='$id'";
                  $result = mysqli_query($conn, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($conn).
                           " - ".mysqli_error($conn));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil diedit.');window.location='tbl_category.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='edit_category.php?id=$id';</script>";
            }
} else {
   $query = "UPDATE category_tbl SET category_name ='$category_name', 
   category_detail = '$category_detail' where id='$id'";
                  $result = mysqli_query($conn, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($conn).
                           " - ".mysqli_error($conn));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil diedit.');window.location='tbl_category.php';</script>";
                  }
}
