<?php 
require 'koneksi.php';
$id = $_GET['id'];

mysqli_query($conn, "UPDATE transaction_detail_tbl SET status ='SELESAI' where transaction_detail_tbl.order='$id'");
header("location: trdetail.php?id=$id");


 ?>