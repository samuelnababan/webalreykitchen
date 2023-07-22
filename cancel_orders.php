<?php 
require 'koneksi.php';
$id = $_GET['id'];

mysqli_query($conn, "UPDATE transaction_detail_tbl SET status = 'CANCEL' WHERE transaction_detail_id = $id");
header("location: transaction.php");


 ?>