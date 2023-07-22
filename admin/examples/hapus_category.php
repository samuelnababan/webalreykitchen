<?php
require 'koneksi.php';
$id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM category_tbl WHERE id = $id");
if ($query) {
echo "<script>alert('data berhasil dihapus');
document.location.href='tbl_category.php'</script>";
} else {
"<script>alert('gagal');
document.location.href='tbl_category.php'</script>";
}
