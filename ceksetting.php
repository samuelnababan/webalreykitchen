<?php
session_start(); 
error_reporting(0);

require 'koneksi.php';
$id = $_SESSION['user_id'];

$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
 
if(!$uppercase || !$lowercase || !$number ||  strlen($password) < 6) {
    echo '<script>
	alert("Pasword setidaknya harus 6 karakter dan harus memiliki huruf besar, huruf kecil, dan angka.");
	location.href = "setting.php";
	</script>';
}else {
$sql = "UPDATE user_tbl SET name='$name', address='$address', phone='$phone', email='$email', password='$password' WHERE id=$id";
$query = mysqli_query($conn, $sql);

if($query) {
	echo '<script>
	location.href = "setting.php";
	</script>';
} else{
echo '<script>
	alert("Gagal!");
	location.href = "setting.php";
	</script>';}
}
?>