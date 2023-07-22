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
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Freshcery | Groceries Organic Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type = "text/javascript" 
    src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-hIV7UWLKd_vig5vh"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="assets/fonts/sb-bistro/sb-bistro.css" rel="stylesheet" type="text/css">
    <link href="assets/fonts/font-awesome/font-awesome.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="assets/packages/bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="all" href="assets/packages/o2system-ui/o2system-ui.css">
    <link rel="stylesheet" type="text/css" media="all" href="assets/packages/owl-carousel/owl-carousel.css">
    <link rel="stylesheet" type="text/css" media="all" href="assets/packages/cloudzoom/cloudzoom.css">
    <link rel="stylesheet" type="text/css" media="all" href="assets/packages/thumbelina/thumbelina.css">
    <link rel="stylesheet" type="text/css" media="all" href="assets/packages/bootstrap-touchspin/bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" media="all" href="assets/css/theme.css">
    

</head>
<body>
    <div class="page-header">
        <!--=============== Navbar ===============-->
        <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-transparent" id="page-navigation">
            <div class="container">
                <!-- Navbar Brand -->
                <a href="index.php" class="navbar-brand">
                    <img src="assets/img/logo/alrey2.png" alt="">
                </a>

                <!-- Toggle Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarcollapse">
                    <!-- Navbar Menu -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="shop.php" class="nav-link">Shop</a>
                        </li>
                        <?php if ($id): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Logout
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="logout.php">Yes</a>
                                <a class="dropdown-item" href="">No</a>
                            </div>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a href="register.php" class="nav-link">Register</a>
                        </li>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">Login</a>
                        </li>
                        <?php endif ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Account
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="transaction.php">Transactions History</a>
                                <a class="dropdown-item" href="setting.php">Settings</a>
                                <a class="dropdown-item" href="checkout.php">Checkout</a>
                            </div>
                        </li>
                          
                        <li class="nav-item dropdown">
                            <a href="cart.php" class="nav-link" >
                                <i class="fa fa-shopping-basket"></i>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </div>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-alrey.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Checkout
                    </h1>
                    <p class="lead">
                        Hemat Waktu Anda dan Serahkan Pada Kami.
                    </p>
                </div>
            </div>
        </div>
        
        <section id="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-7">
                        <h5 class="mb-3">BILLING DETAILS</h5>
                        <!-- Bill Detail of the Page -->
                        <form action="" method="post" class="bill-detail">
                            <fieldset>
                                <div class="form-group">
                                    <input  disabled class="form-control" placeholder="Name" value="<?= $user['name'] ?>" type="text">
                                </div>
                                <div class="form-group">
                                    <input  disabled class="form-control" placeholder="Address" value="<?= $user['address'] ?>" type="text">
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col">
                                        <input disabled class="form-control" placeholder="Email Address" value="<?= $user['email'] ?>" type="email">
                                    </div>
                                    <div class="col">
                                        <input disabled class="form-control" placeholder="Phone Number" value="<?= $user['phone'] ?>" type="tel">
                                    </div>
                                </div>
                                <div class="form-group">
                                    Pastikan alamat sudah sesuai jika belum klik button ubah 
                                    <?php if($total["total"] == 0 ) { ?>
                                        <button disabled href="setting.php" class="btn btn-primary float-right">UBAH</button>
                                    <?php } else { ?>  
                                        <a href="setting.php" class="btn btn-primary float-right">UBAH</a>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                        <!-- Bill Detail of the Page end -->
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <div class="holder">
                            <h5 class="mb-3">YOUR ORDER</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>Quantity</th>
                                            <th class="text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($checkouts as $data): ?>
                                        <tr>
                                            <td>
                                            <?= $data['cake_name'] ?>
                                            </td>
                                            <td class="text-center">
                                            <?= $data['quantity'] ?>
                                            </td>
                                            <td class="text-right">
                                            Rp. <?= number_format($data['price_total']); ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfooter>
                                        <tr>
                                            <td>
                                                <strong>Cart Subtotal</strong>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                            Rp. <?= number_format($total["total"]); ?>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Total Kurir</strong>
                                            </td>
                                            <td id="disp"></td>
                                            <td class="text-right">
                                                <?php $kurir = 10000;
                                                $semua =  $total["total"]+$kurir;
                                                ?>
                                            Rp. <?= number_format($kurir) ?>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>ORDER TOTAL</strong>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <strong>Rp. <?= number_format($semua) ?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <form action="" method="post">
                                                <?php
                                                if($total["total"] == 0 ) { ?>
                                                    <button disabled type="submit" name="cancel" class="btn btn-primary float-right" onclick="confirm('are you sure to cancel?')">CANCEL</button>
                                                <?php } else { ?>  
                                                    <button type="submit" name="cancel" class="btn btn-primary float-right" onclick="confirm('are you sure to cancel?')">CANCEL</button>
                                                <?php } ?>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <?php if(isset($token['token'])) { ?>
                                                    <button id="bayar" class="btn btn-primary float-right">PROCEED TO CHECKOUT <i class="fa fa-check"></i></button>
                                                <?php } else {?>
                                                    <button disabled class="btn btn-primary float-right">PROCEED TO CHECKOUT <i class="fa fa-check"></i></button>
                                                    <?php echo '<script> alert("konfirmasi dulu pembayaranmu") location.href = "bayar.php"; </script>'; ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </tfooter>
                                </table>
                            </div>  
                            <div class="holder ">
                                Tidak bisa melakukan Pembayaran?
                                <?php if(isset($token['token'])) { ?>
                                <a href="help.php"  target="_blank" class="btn btn-primary float-right">Help</a>
                                <?php } else {?>
                                    <button href="help.php" disabled target="_blank" class="btn btn-primary float-right">Help</button>
                                    <?php } ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </div>
    <?= require 'footer.php'; ?>
    <script type="text/javascript">
        var btnBayar = document.getElementById('bayar');
        btnBayar.addEventListener('click', function(){
            window.snap.pay('<?= $to; ?>', {
                onSuccess: function() {
                    location.href = "bayar.php"; alert('Pembayaran Berhasil'); 
                    <?php $query = mysqli_query($conn, "UPDATE transaction_detail_tbl SET transaction_detail_tbl.token = '$to'  WHERE transaction_id=$transaction_id AND status='CHECKOUT'"); ?>
                    <?php $query = mysqli_query($conn, "insert into total_tbl values ('order-$kt', '$kt', '$id', '$semua' )"); ?>
                    
                },
                onError: function() {
                    alert('Pembayaran Gagal');
                }
            });
        })
    </script>
</body>
</html>
