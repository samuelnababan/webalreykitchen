<?php 

session_start();
error_reporting(0);
require 'koneksi.php';
$id = $_SESSION['user_id'];

if (is_null($id)) {
  header("location: login.php");
  } else {
    $result = mysqli_query($conn, "SELECT * FROM transaction_tbl WHERE user_id=$id");
    $transaction = mysqli_fetch_assoc($result);
    $transaction_id = $transaction['id'];

    $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id WHERE transaction_id=$transaction_id AND status='PENDING'");
    $checkouts = [];
    while ($checkout = mysqli_fetch_assoc($result)) {
        $checkouts[] = $checkout;
    }
    $transaction_id = $checkouts['0']['transaction_id'];
    if (count($checkouts) == 0) {
        echo '<script> alert("ups, nothing to cart!") location.href = "shop.php"; </script>';
    }else {
    $result = mysqli_query($conn, "SELECT SUM(price_total) AS total FROM transaction_detail_tbl WHERE transaction_id=$transaction_id AND status='PENDING'");
    $total = mysqli_fetch_assoc($result);

    if (isset($_POST['submit'])) {
      if (count($checkouts) == 0) {
        echo '<script> alert("ups, your cart is empty!"); location.href = "shop.php"; </script>';
      } else {
        mysqli_query($conn, "UPDATE transaction_detail_tbl SET status = 'CHECKOUT' WHERE transaction_id=$transaction_id AND status='PENDING'");
        if (mysqli_affected_rows($conn)> 0) {
            echo '<script> alert("succes to checkout"); location.href = "checkout.php";  </script>';
        } else echo '<script> alert("failed to checkout"); location.href = "cart.php";  </script>';
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
                        Keranjang Anda
                    </h1>
                    <p class="lead">
                        Hemat Waktu Anda dan Serahkan Pada Kami
                    </p>
                </div>
            </div>
        </div>
        
        <section id="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <?php if (count($checkouts) == 0): ?>
          <div class="alert alert-danger" role="alert">
            ups, your cart is empty!
          </div>
        <?php endif ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="20%">Image</th>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th>Disscount Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                <?php foreach ($checkouts as $data): ?>
                                    <tr>
                                        <td>
                                            <img src="assets/img/<?= $data['cake_photo'] ?>" width="150">
                                        </td>
                                        <td>
                                            <?= $data['cake_name'] ?><br>
                                        </td>
                                        <td>
                                            
                                            Rp. <?= number_format($data['cake_price']); ?>
                                        </td>
                                        <td>
                                        <?php 
                                            $harga = $data["cake_price"];
                                            $dis = $data["cake_price"]*20/100;
                                            $totaldis = number_format($harga-$dis);
                                              ?>
                                              Rp. <?= $totaldis ?>
                                        </td>
                                        <td>
                                            <?= $data['quantity'] ?>
                                        </td>
                                        <td>
                                            Rp. <?= number_format($data['price_total']); ?>
                                        </td>
                                        <td>
                                            <a href="delete.php?id=<?= $data["transaction_detail_id"]; ?>" onclick="return confirm('Anda yakin akan menghapus produk= <?= $data['cake_name'];?>?')" class="text-danger"><i class="fa fa-times"></i></a>

                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col text-right">
                        <div class="w-50 float-right">
                            <a href="shop.php" class="btn btn-default">Continue Shopping</a>
                        </div>
                        <div class="clearfix"></div>
                        <h6 class="mt-3">Rp. <?= number_format( $total['total']); ?></h6>
                        <form action="" method="post">
                            <button type="submit" name="submit" class="btn btn-lg btn-primary">Checkout <i class="fa fa-long-arrow-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?= require 'footer.php'; ?>
</body>
</html>
