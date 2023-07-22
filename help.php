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

    $gatewayUrl = 'https://app.sandbox.midtrans.com';
  $curl = curl_init($gatewayUrl.'/snap/v1/transactions');
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_USERPWD, 'SB-Mid-server-De48jo6EJZwfytolGpPJL_39:');
  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
    
  'transaction_details' => [
    'order_id' => 'order-'.$t['transaction_detail_id'],
    'gross_amount' => $semua
  ],
    'credit_card' => [
        'secure' => true
    ],
        'customer_details' => [
            'first_name' => $user['name'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'address' => $user['address']
            ]
        ]));

        $response = curl_exec($curl);
        $token = json_decode($response, true);
        echo $response;
        $to = $token['token'];
        $re = $token['redirect_url'];
    if (isset($_POST['cancel'])) {
      if (count($checkouts) == 0) {
        echo '<script> alert("ups, nothing to cancel!") location.href = "shop.php"; </script>';
      } else {
        mysqli_query($conn, "UPDATE transaction_detail_tbl SET status = 'PENDING' WHERE transaction_id=$transaction_id AND status='CHECKOUT'");
        if (mysqli_affected_rows($conn) > 0) {
            echo '<script> alert("succes to cancel, thank you!"); location.href = "cart.php";  </script>';
        } else echo "<script> alert('failed to cancel') </script>";
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
                        Help Payment
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
                    <div class="col-xs-12 col-sm-12">
                    <h5 class="mb-12">Untuk melakukan pembayaran silahkan klik payment, jika sudah balik kemenu help klik confirm payment</h5>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                    <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        </tr>
                                    </tbody>
                                    <tfooter class="text-right">
                                        <tr>
                                            <td>
                                                <strong>PAYMENT</strong>
                                            </td>
                                            <td class="text-right">
                                                <a href="<?= $re ?>"  target="_blank" class="btn btn-primary float-right">PAYMENT</a>
                                        </td>  
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>CONFIRM PAYMENT</strong>
                                            </td>
                                            <td class="text-right">
                                                <a href="bayar.php" class="btn btn-primary">CONFIRM PAYMENT</a> 
                                        </td>
                                        </tr>
                                    </tfooter>
                                </table>
                            </div>  
                        
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?= require 'footer.php'; ?>

</body>
</html>
