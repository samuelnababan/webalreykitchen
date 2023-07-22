<?php 
session_start();
require 'koneksi.php';


if ( isset($_POST["submit"]) ) {

  $username = $_POST["username"];
  $password = $_POST["password"]; 
  
  $result = mysqli_query($conn, "SELECT * FROM user_tbl WHERE username = '$username'");
  $user = mysqli_fetch_assoc($result);
  $cek = mysqli_num_rows($result);
  $id = $user["id"];

  if ( $cek == 1 && $password == $user["password"] ) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['username'];
    header("location: shop.php");
  } else {
    echo '<script> alert("failed to login!"); location.href = "login.php";  </script>';
  } 
}

require 'header.php';
 ?>

    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-alrey.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Login Page
                    </h1>
                    <p class="lead">
                        Hemat Waktu Anda dan Serahkan Pada Kami.
                    </p>

                    <div class="card card-login mb-5">
                        <div class="card-body">
                            <form class="form-horizontal" action="" method="post">
                                <div class="form-group row mt-3">
                                    <div class="col-md-12">
                                        <input class="form-control" name="username" type="text" required="" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input class="form-control" name="password" type="password" required="" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row text-center mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase">Log In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= require 'footer.php'; ?>
</body>
</html>
