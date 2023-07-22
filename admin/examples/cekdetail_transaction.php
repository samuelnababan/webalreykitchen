<?php
session_start(); 
error_reporting(0);

require 'koneksi.php';

$id = $_GET['id'];
$status = $_POST['status'];

if($status == "--pilih status pemesanan--"){
    echo "<script>alert('Pilih status pemesanan');
    document.location.href='detail_transaction.php?id=$id'</script>";
} else{
$query = mysqli_query($conn, "UPDATE transaction_detail_tbl SET status ='$status' where transaction_detail_id='$id'");

if($query) {
echo "<script>alert('data berhasil disimpan');
document.location.href='detail_transaction.php?id=$id'</script>";
} else {
echo "<script>alert('data gagal disimpan');
document.location.href='detail_transaction.php?id=$id'</script>";}
}
?>

