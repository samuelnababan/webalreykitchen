<?php
error_reporting(0);
session_start(); 
require 'koneksi.php';
$result = mysqli_query($conn, 'SELECT * FROM category_tbl');

$id = $_SESSION['user_id']; 
require 'header.php';
 ?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-video text-center bg-dark mb-0 rounded-0">
                <video width="100%" preload="auto" loop autoplay muted>
                    <source src='assets/media/1.mp4' type='video/mp4' />
                    <source src='assets/media/2.webm' type='video/webm' />
                </video>
                <div class="container">
                    <h1 class="pt-5">
                        Hemat waktu anda<br>
                        dan serahkan pada kami.
                    </h1>
                    <p class="lead">
                        Fresh dari Oven.
                    </p>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="card-icon">
                                    <div class="card-icon-i">
                                        <i class="fa fa-shopping-basket"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        Buy
                                    </h4>
                                    <p class="card-text">
                                        Cukup klik untuk membeli produk yang Anda inginkan dan konfirmasi pesanan Anda setelah selesai.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="card-icon">
                                    <div class="card-icon-i">
                                    <svg fill="#ffffff" width="60px" height="100px" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M12 2C10.906937 2 10 2.9069372 10 4L7 4C5.3550302 4 4 5.3550302 4 7L4 42C4 43.644459 5.3544268 45 7 45L9 45L9 46C9 47.093063 9.9069372 48 11 48L14 48C15.093063 48 16 47.093063 16 46L16 45L34 45L34 46C34 47.093063 34.906937 48 36 48L39 48C40.093063 48 41 47.093063 41 46L41 45L43 45C44.645063 45 46 43.645063 46 42L46 7C46 5.3544268 44.644459 4 43 4L40 4C40 2.9069372 39.093063 2 38 2L32 2C30.906937 2 30 2.9069372 30 4L21 4C21 2.9069372 20.093063 2 19 2L12 2 z M 7 6L10.832031 6 A 1.0001 1.0001 0 0 0 11.158203 6L19.832031 6 A 1.0001 1.0001 0 0 0 20.158203 6L30.832031 6 A 1.0001 1.0001 0 0 0 31.158203 6L38.832031 6 A 1.0001 1.0001 0 0 0 39.158203 6L43 6C43.563541 6 44 6.4355732 44 7L44 42C44 42.562937 43.562937 43 43 43L40.167969 43 A 1.0001 1.0001 0 0 0 39.841797 43L35.167969 43 A 1.0001 1.0001 0 0 0 34.841797 43L15.167969 43 A 1.0001 1.0001 0 0 0 14.841797 43L10.167969 43 A 1.0001 1.0001 0 0 0 9.8417969 43L7 43C6.4355732 43 6 42.563541 6 42L6 7C6 6.4349698 6.4349698 6 7 6 z M 10 8C8.895 8 8 8.895 8 10C8 11.105 8.895 12 10 12C11.105 12 12 11.105 12 10C12 8.895 11.105 8 10 8 z M 16 8C14.895 8 14 8.895 14 10C14 11.105 14.895 12 16 12C17.105 12 18 11.105 18 10C18 8.895 17.105 8 16 8 z M 22 8C20.895 8 20 8.895 20 10C20 11.105 20.895 12 22 12C23.105 12 24 11.105 24 10C24 8.895 23.105 8 22 8 z M 28 8C26.895 8 26 8.895 26 10C26 11.105 26.895 12 28 12C29.105 12 30 11.105 30 10C30 8.895 29.105 8 28 8 z M 40 8C38.895 8 38 8.895 38 10C38 11.105 38.895 12 40 12C41.105 12 42 11.105 42 10C42 8.895 41.105 8 40 8 z M 9 14L9 15L9 33.832031 A 1.0001 1.0001 0 0 0 9 34.158203L9 40L41 40L41 34.167969 A 1.0001 1.0001 0 0 0 41 33.841797L41 14L9 14 z M 11 16L39 16L39 33L35.791016 33C35.921094 32.660389 36 32.296958 36 31.914062C36 27.002683 31.997317 23 27.085938 23L22.912109 23C18.001606 23 14 27.002683 14 31.914062C14 32.296958 14.079025 32.660389 14.208984 33L11 33L11 16 z M 23 25L27 25L27 28 A 1.0001 1.0001 0 1 0 29 28L29 25.384766C31.872379 26.224275 34 28.763082 34 31.914062C34 32.525554 33.525069 33 32.912109 33L17.085938 33C16.474447 33 16 32.525554 16 31.914062C16 28.762888 18.127944 26.224105 21 25.384766L21 28 A 1.0001 1.0001 0 1 0 23 28L23 25 z M 11 35L17.085938 35L32.912109 35L39 35L39 38L11 38L11 35 z M 11 45L14 45L14 46L11 46L11 45 z M 36 45L39 45L39 46L36 46L36 45 z"/>
                                        </g>
                                    </svg>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        Baked
                                    </h4>
                                    <p class="card-text">
                                        Tim kami memastikan kualitas produk sesuai dengan standar kami dan memasaknya dengan sepenuh hati.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="card-icon">
                                    <div class="card-icon-i">
                                        <i class="fa fa-truck"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        Delivery
                                    </h4>
                                    <p class="card-text">
                                        Baker menerima pesanan Anda dan langsung dikirimkan sesuai dengan alamat pemesanan Anda.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="why">
            <h2 class="title">Kenapa Alrey Kitchen</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0 text-center gray-bg">
                            <div class="card-icon">
                                <div class="card-icon-i text-success">
                                <svg width="60px" height="100px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                    <g id="SVGRepo_iconCarrier">
                                        <defs>
                                            <style>.cls-1{fill:none;stroke:#52970d;stroke-miterlimit:10;stroke-width:1.91px;}</style>
                                        </defs>
                                        <path class="cls-1" d="M22.52,15.45c0,2.37-4.71,3.22-10.52,3.22S1.48,17.82,1.48,15.45,6.19,10.07,12,10.07,22.52,13.07,22.52,15.45Z"/>
                                            <line class="cls-1" x1="17.01" y1="10.12" x2="15.91" y2="14.51"/>
                                            <line class="cls-1" x1="12.18" y1="10.29" x2="11.09" y2="14.68"/>
                                            <line class="cls-1" x1="7.36" y1="10.45" x2="6.26" y2="14.85"/>
                                            <path class="cls-1" d="M1.48,18.67h21a0,0,0,0,1,0,0v0A3.83,3.83,0,0,1,18.7,22.5H5.3a3.83,3.83,0,0,1-3.83-3.83v0a0,0,0,0,1,0,0Z"/>
                                            <path class="cls-1" d="M7.22.5c0,1.11-1,1.11-1,2.23s1,1.12,1,2.23-1,1.12-1,2.24"/>
                                            <path class="cls-1" d="M13,1.46c0,1.11-1,1.11-1,2.23s1,1.11,1,2.23S12,7,12,8.15"/>
                                            <path class="cls-1" d="M18.7.5c0,1.11-1,1.11-1,2.23s1,1.12,1,2.23-1,1.12-1,2.24"/>
                                    </g>
                                </svg>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    Fresh from Oven
                                </h4>
                                <p class="card-text">
                                    Konsep oven-ke-meja kami menekankan untuk mendapatkan kue langsung dari oven ke meja Anda dalam waktu yang cepat, sehingga Anda mendapatkan produk yang fresh.
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 text-center gray-bg">
                            <div class="card-icon">
                                <div class="card-icon-i text-success">
                                <svg width="60px" height="100px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                    <g id="SVGRepo_iconCarrier"> <title>icon/24/health</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="out" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <path d="M19,3 L5,3 C3.9,3 3.01,3.9 3.01,5 L3,19 C3,20.1 3.9,21 5,21 L19,21 C20.1,21 21,20.1 21,19 L21,5 C21,3.9 20.1,3 19,3 L19,3 Z M18,14 L14,14 L14,18 L10,18 L10,14 L6,14 L6,10 L10,10 L10,6 L14,6 L14,10 L18,10 L18,14 L18,14 Z" id="path" fill=" #599815"> </path> </g> </g>
                                </svg>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    Healthy Food
                                </h4>
                                <p class="card-text">
                                Kami sangat memperhatikan kualitas bahan yang kami gunakan dalam setiap hidangan yang kami sajikan. Kami senantiasa mengutamakan penggunaan bahan-bahan alami.
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 text-center gray-bg">
                            <div class="card-icon">
                                <div class="card-icon-i text-success">
                                    <svg fill="#599815" width="60px" height="100px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M3.012,10.981,3,11H5v9a1,1,0,0,0,1,1H18a1,1,0,0,0,1-1V11h2a1,1,0,0,0,.555-1.832l-9-6a1,1,0,0,0-1.11,0l-9,6a1,1,0,0,0-.277,1.387A.98.98,0,0,0,3.012,10.981ZM10,14a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1v5H10Z"/>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    Home Made
                                </h4>
                                <p class="card-text">
                                Kami akan selalu menyajikan makanan istimewa yang kami olah dengan sepenuh hati dan keahlian, menjadi karya Home Made yang tercipta dengan cinta dan dedikasi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-5 text-center">
                        <a href="shop.php" class="btn btn-primary btn-lg">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="categories" class="pb-0 gray-bg">
            <h2 class="title">Categories</h2>
            <div class="landing-categories owl-carousel">
            <?php 
             while ($cake = mysqli_fetch_assoc($result)) : ?>
                <div class="item">
                    <div class="card rounded-0 border-0 text-center">
                        <img src="assets/img/<?=$cake['category_photo']?>">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center">
                            <!-- <h4 class="card-title">Vegetables</h4> -->
                            <a href="category.php?id=<?= $cake["id"]; ?>" class="btn btn-primary btn-lg"><?=$cake['category_name']?></a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        </section>
    </div>
    <?= require 'footer.php'; ?>
</body>
</html>
