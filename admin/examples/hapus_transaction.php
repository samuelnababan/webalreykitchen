<?php
require 'koneksi.php';
$id = $_GET['id'];

$query = mysqli_query($conn, "UPDATE transaction_detail_tbl SET status ='CANCEL' where transaction_detail_id='$id'");
if ($query) {
echo "<script>alert('data berhasil dicancel');
document.location.href='tbl_transaction.php'</script>";
} else {
"<script>alert('gagal');
document.location.href='tbl_transaction.php'</script>";
}
