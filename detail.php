<?php 

session_start();
error_reporting(0);
require 'koneksi.php';

$id = $_GET["id"];
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM cake_tbl INNER JOIN category_tbl ON cake_tbl.category_id = category_tbl.id WHERE cake_tbl.id=$id";
$result = mysqli_query($conn, $query);
$cake = mysqli_fetch_assoc($result);
$cake_id = $cake['id'];
$resultp = mysqli_query($conn, 'SELECT * FROM cake_tbl');

// insert data 

if (isset($_POST['submit'])) {
  if (is_null($user_id)) {
    echo "<script> alert('Harap Login Terlebih Dahulu') </script>";
  } else {
    $total = $_POST['quantity'];
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d');
    $datetime = date('Y-m-d h:i:sa');
    $harga = $cake["cake_price"];
    $dis = $cake["cake_price"]*20/100;
    $price_total = ($harga-$dis) * $total;

    
    $result_transaction = mysqli_query($conn, "SELECT * FROM transaction_tbl WHERE user_id = $user_id");
    $transaction = mysqli_fetch_assoc($result_transaction);
    $transaction_user = $transaction['user_id'];
    $transaction_id = $transaction['id'];
    $new_price_total = $transaction['total'] + $price_total;
    

    if ($transaction_user == $user_id) {
        mysqli_query($conn, "UPDATE transaction_tbl 
        SET total = '$new_price_total' 
        WHERE id = $transaction_id
        ");
    } else {
        mysqli_query($conn, "INSERT INTO transaction_tbl
         VALUES 
            ('', '$user_id', '$date', '$price_total')");
        
    }

    $new = mysqli_query($conn, "SELECT * FROM transaction_tbl WHERE user_id = $user_id");
    $newdata = mysqli_fetch_assoc($new);
    $new_trans_id = $newdata['id'];
    mysqli_query($conn, "INSERT INTO transaction_detail_tbl
                    VALUES
                    ('', '$new_trans_id', '$id', '$datetime', '$total', '$price_total', '0', 'o', 'PENDING')");

    if (mysqli_affected_rows($conn) > 0) {
        echo '<script> alert("succes add to cart"); location.href = "cart.php";  </script>';
    } else echo "<script> alert('failed add to cart') </script>";
  }
}
require 'header.php';
 ?>

    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-alrey.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Produk Kami
                    </h1>
                    <p class="lead">
                        Hemat Waktu Anda dan Serahkan Pada Kami.
                    </p>
                </div>
            </div>
        </div>
        <div class="product-detail">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="slider-zoom">
                            <a href="assets/img/<?= $cake["cake_photo"]; ?>" class="cloud-zoom" rel="transparentImage: 'data:image/gif;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==', useWrapper: false, showTitle: false, zoomWidth:'500', zoomHeight:'500', adjustY:0, adjustX:10" id="cloudZoom">
                                <img alt="Detail Zoom thumbs image" src="assets/img/<?= $cake["cake_photo"]; ?>" style="width: 100%;">
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <p>
                            <strong><?= $cake["cake_name"]; ?></strong><br>
                            <?= $cake["cake_desc"]; ?>
                        </p>
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    <strong>Price</strong> (/Pack)<br>
                                    <?php 
                                            $harga = $cake["cake_price"];
                                            $dis = $cake["cake_price"]*20/100;
                                            $totaldis = number_format($harga-$dis);
                                              ?>
                                    <span class="price">Rp. <?= $totaldis ?></span>
                                    
                                    <span class="old-price">Rp. <?= number_format($cake["cake_price"]); ?></span>
                                </p>
                            </div>
                        </div>
                        <p class="mb-1">
                            <strong>Quantity</strong>
                        </p>
                        <form action="" method="POST">
                        <div class="row">
                            <div class="col-sm-5">
                                <input name="quantity" class="vertical-spin" type="number" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="" name="vertical-spin">
                            </div>
                        </div>
                            <button name="submit" class="mt-3 btn btn-primary btn-lg">
                                <i class="fa fa-shopping-basket"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <section id="related-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Related Products</h2>
                        <div class="product-carousel owl-carousel">
                        <?php while ($cake = mysqli_fetch_assoc($resultp)) : ?>
                            <div class="item">
                                <div class="card card-product">
                                    <div class="card-ribbon">
                                        <div class="card-ribbon-container right">
                                            <span class="ribbon ribbon-primary">SPECIAL</span>
                                        </div>
                                    </div>
                                    <div class="card-badge">
                                        <div class="card-badge-container left">
                                            <span class="badge badge-default">
                                                Until 2023
                                            </span>
                                            <span class="badge badge-primary">
                                                20% OFF
                                            </span>
                                        </div>
                                        <img src="assets/img/<?= $cake["cake_photo"]; ?>" alt="Card image 2" class="card-img-top">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="detail.php?id=<?= $cake["id"]; ?>"><?= $cake["cake_name"]; ?></a>
                                        </h4>
                                        <div class="card-price">
                                            <span class="discount">Rp. <?= number_format($cake["cake_price"]); ?></span>
                                            <?php 
                                            $harga = $cake["cake_price"];
                                            $dis = $cake["cake_price"]*20/100;
                                            $totaldis = number_format($harga-$dis);
                                              ?>
                                            <span class="reguler">Rp. <?= $totaldis ?></span>
                                        </div>
                                        <a href="detail.php?id=<?= $cake["id"]; ?>" class="btn btn-block btn-primary">
                                            Add to Cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?= require 'footer.php'; ?>
</body>
</html>
