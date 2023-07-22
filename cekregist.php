<?php
require 'koneksi.php';

// check conection
if (mysqli_connect_error()) {
	echo "koneksi database gagal : ".
	mysqli_connect_error();
}

$username = $_POST['username'];
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($conn, "SELECT username FROM user_tbl where username = '$username'");
$cake = mysqli_fetch_assoc($result);
$cekuname = $cake['username'];

$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
 
if(!$uppercase || !$lowercase || !$number ||  strlen($password) < 6) {
    echo '<script>
	alert("Pasword setidaknya harus 6 karakter dan harus memiliki huruf besar, huruf kecil, dan angka.");
	location.href = "register.php";
	</script>';
}else if($username == $cekuname){
	echo '<script>
	alert("Username telah digunakan");
	location.href = "register.php";
	</script>';
} else if($username == $cekuname && !$uppercase || !$lowercase || !$number ||  strlen($password) < 6){
	echo '<script>
	alert("Username telah digunakan dan Pasword setidaknya harus 6 karakter dan harus memiliki huruf besar, huruf kecil, dan angka.");
	location.href = "register.php";
	</script>';
} else {
$sql = "insert into user_tbl (id, username, name, address, phone, email, password) values ('', '$username', '$name', '$address', '$phone', '$email', '$password' )";
$query = mysqli_query($conn, $sql);

if($query) {
	echo '<script> alert("Berhasil!");
	location.href = "login.php";
	</script>';
} else{
echo '<script>
	alert("Gagal!");
	location.href = "register.php";
	</script>';}
}
?>