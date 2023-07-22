<?php 

session_start();
error_reporting(0);
require 'koneksi.php';
$id = $_SESSION['user_id'];
$i = $_GET['id'];
if (is_null($id)) {
    header("location: login.php");
    } else {
$resulta = mysqli_query($conn, "SELECT SUM(price_total) AS total FROM transaction_detail_tbl WHERE  transaction_detail_tbl.order = '$i'");
    $total = mysqli_fetch_assoc($resulta);
    $resultp = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id WHERE transaction_detail_tbl.order = '$i'");
    $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id WHERE transaction_detail_tbl.order = '$i'");
    $o = mysqli_fetch_assoc($result);
    }
    
require 'header.php'; 
?>
<div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-alrey.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Transaksi Anda

                    </h1>
                    <p class="lead">
                        Hemat Waktu Anda dan Serahkan Pada Kami.
                    </p>
                </div>
            </div>
        </div>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">No. Pesanan: <?= $o['order']; ?></h5>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <strong>Your Order:</strong>
                                </p>
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
                                        <?php 
                                        
                                        while ($cake = mysqli_fetch_assoc($resultp)): ?>
                                            <tr>
                                                <td>
                                                    <?= $cake['cake_name']; ?>
                                                </td>
                                                <td>
                                                    <?= $cake['quantity']; ?>
                                                </td>
                                                <td class="text-right">
                                                <?= number_format($cake['price_total']); ?>
                                                </td>
                                            </tr>
                                            <?php endwhile; ?>
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
                                                    <strong>Kurir</strong>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                <?php $kurir = 10000; ?>
                                                    Rp. <?= number_format($kurir); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>ORDER TOTAL</strong>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <strong><?php 
                                                $semua =  $total["total"]+$kurir;
                                                ?>
                                            Rp. <?= number_format($semua); ?></strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>STATUS</strong>
                                                </td>
                                                <td >
                                                    <strong><?php 
                                            $status=$o['status'];
                                            if($status == "SUCCES"){
                                                echo 'Sudah Dibayar';
                                            } else if($status == "DELIVERD"){
                                                echo 'Pesanan Diantar';
                                            } else if($status == "PROCESS"){
                                                echo 'Pesanan Sedang Diproses';
                                            } else if($status == "CHECKOUT"){
                                                echo 'Belum Dibayar';
                                            } else if($status == "SELESAI"){
                                                echo 'Pesanan Selesai';
                                            } else if($status == "CANCEL"){
                                                echo 'CANCEL';
                                            } 
                                            ?></strong>
                                                </td>
                                                <td class="text-right">
                                                    
                                                    <?php if($status == "DELIVERD"){ ?>
                                                        <a href="selesai.php?id=<?= $o["order"]; ?>" onclick="return confirm('Apakah anda telah menerima pesanan? jika sudah silahkan konfirmasi')" class="btn btn-default">Selesai</a>
                                                    <?php } else { ?>
                                                        <button disabled class="btn btn-default">Selesai</button>
                                                        <?php } ?>
                                                </td>
                                            </tr>
                                        </tfooter>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="transaction.php" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= require 'footer.php'; ?>
</body>
</html>