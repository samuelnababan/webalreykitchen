<?php
session_start();
require 'koneksi.php';

  $username = $_POST["username"];
  $password = $_POST["password"]; 
  
  $result = mysqli_query($conn, "SELECT * FROM admin_tbl WHERE username = '$username'");
  $admin = mysqli_fetch_assoc($result);
  $cek = mysqli_num_rows($result);
  $id = $admin["id"];

  if ( $cek == 1 && $password == $admin["password"] ) {
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_name'] = $admin['username'];
    echo '<script> location.href = "dashboard.php";  alert("Successful to login!"); </script>';
  } else {
    echo '<script> alert("failed to login!"); location.href = "login.php";  </script>';
  } 

?>