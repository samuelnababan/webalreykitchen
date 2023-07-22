<?php
session_start(); 
error_reporting(0);

require 'koneksi.php';
$id = $_SESSION['admin_id'];

$username = $_POST['username'];
$name = $_POST['name'];
$telepon = $_POST['telepon'];
$email = $_POST['email'];
$password = $_POST['password'];

$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
 
if(!$uppercase || !$lowercase || !$number ||  strlen($password) < 6) {
    echo '<script>
	alert("Pasword setidaknya harus 6 karakter dan harus memiliki huruf besar, huruf kecil, dan angka.");
	location.href = "profile.php";
	</script>';
}else if($username == $cekuname){
	echo '<script>
	alert("Username telah digunakan");
	location.href = "profile.php";
	</script>';
} else if($username == $cekuname && !$uppercase || !$lowercase || !$number ||  strlen($password) < 6){
	echo '<script>
	alert("Username telah digunakan dan Pasword setidaknya harus 6 karakter dan harus memiliki huruf besar, huruf kecil, dan angka.");
	location.href = "profile.php";
	</script>';
} else {
$sql = "UPDATE admin_tbl SET username='$username', name='$name', telepon='$telepon', email='$email', password='$password' WHERE id=$id";
$query = mysqli_query($conn, $sql);

if($query) {
	echo '<script> alert("Berhasil");
	location.href = "profile.php";
	</script>';
} else{
echo '<script>
	alert("Gagal!");
	location.href = "profile.php";
	</script>';}
}
?>