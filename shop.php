<?php
session_start(); 
error_reporting(0);

require 'koneksi.php';
$result = mysqli_query($conn, 'SELECT * FROM cake_tbl');
$result1 = mysqli_query($conn, 'SELECT * FROM category_tbl');
$id = $_SESSION['user_id'];

require 'header.php';
 ?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-alrey.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Mari Belanja
                    </h1>
                    <p class="lead">
                    Hemat Waktu Anda dan Serahkan Pada Kami.
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shop-categories owl-carousel mt-5">
                    <?php while ($cake = mysqli_fetch_assoc($result1)) : ?>
                        <div class="item">
                            <a href="category.php?id=<?= $cake["id"]; ?>">
                                <div class="media d-flex align-items-center justify-content-center">
                                    <span class="d-flex mr-2"><i class="sb-bistro"></i></span>
                                    <div class="media-body">
                                        <h5 align="center"><?=$cake["category_name"]?></h5>
                                        <p align="center"><?=$cake["category_detail"]?></</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endwhile; ?>
                        
                    </div>
                </div>
            </div>
        </div>

        <section id="most-wanted">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">ALL PRODUCT</h2>
                        <div class="product-carousel owl-carousel">
                            <?php 
                            while ($cake = mysqli_fetch_assoc($result)) : ?>
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
