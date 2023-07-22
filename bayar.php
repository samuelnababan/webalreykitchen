<?php 

session_start();
error_reporting(0);
require 'koneksi.php';
$i = $_GET['id'];
$id = $_SESSION['user_id'];


if (is_null($id)) {
  header("location: login.php");
  } else {
    $result = mysqli_query($conn, "SELECT * FROM transaction_tbl WHERE user_id=$id");
    $transaction = mysqli_fetch_assoc($result);
    $transaction_id = $transaction['id'];


    $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id WHERE transaction_id=$transaction_id AND status='CHECKOUT'");
    $checkouts = [];
    while ($checkout = mysqli_fetch_assoc($result)) {
        $checkouts[] = $checkout;
    }
    $transaction_id = $checkouts['0']['transaction_id'];
    if (count($checkouts) == 0) {
        echo '<script> alert("ups, nothing to checkout!") location.href = "shop.php"; </script>';
    }else {
    $result = mysqli_query($conn, "SELECT * FROM user_tbl WHERE id=$id");
    $user = mysqli_fetch_assoc($result);

    $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl WHERE transaction_id=$transaction_id AND status='CHECKOUT'");
    $t = mysqli_fetch_assoc($result);
    $kt = $t['transaction_detail_id'];

    $result = mysqli_query($conn, "SELECT SUM(price_total) AS total FROM transaction_detail_tbl WHERE transaction_id=$transaction_id AND status='CHECKOUT'");
    $total = mysqli_fetch_assoc($result);
    $kurir = 10000; 
    $semua =  $total["total"]+$kurir;
                                                
    if (isset($_POST['submit'])) {
      if (count($checkouts) == 0) {
        echo '<script> alert("ups, nothing to checkout!") location.href = "shop.php"; </script>';
      } else {
        mysqli_query($conn, "UPDATE transaction_detail_tbl SET transaction_detail_tbl.status = 'SUCCES', transaction_detail_tbl.order = 'order-$kt'  WHERE transaction_id=$transaction_id AND status='CHECKOUT'");
        if (mysqli_affected_rows($conn) > 0) {
            echo '<script> alert("succes to confirm. your order we will processed!"); location.href = "shop.php";  </script>';
        } else echo "<script> alert('failed to confirm') </script>";
      }
    }

}
  }
  
  require 'header.php';
 ?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-alrey.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Confirm Payment
                    </h1>
                    <p class="lead">
                        Hemat Waktu Anda dan Serahkan Pada Kami
                    </p>
                </div>
            </div>
        </div>
        
        <section id="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5">
                        <div class="holder">
                            <h5 class="mb-3">CONFIRM PAYMENT</h5>
                            <form action="" method="post">
                                <button type="submit" name="submit" class="btn btn-primary">PROCEED TO CONFIRM <i class="fa fa-check"></i></button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?= require 'footer.php'; ?>
</body>
</html>
