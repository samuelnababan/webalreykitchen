<?php 

session_start();
error_reporting(0);
require 'koneksi.php';
$id = $_SESSION['user_id'];
$i = $_GET['id'];
if (is_null($id)) {
    header("location: login.php");
    } else {
        $resultu = mysqli_query($conn, "SELECT id FROM transaction_tbl where transaction_tbl.user_id = $id");
            $d = mysqli_fetch_array($resultu);
            $id_tr = $d['id'];
        if($i == '1'){
        $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id WHERE transaction_id = $id_tr and status = 'PROCESS'");
        } else if($i == '2'){
            $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id WHERE transaction_id = $id_tr and status = 'DELIVERD'");
        } else if($i == '3'){
            $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id WHERE transaction_id = $id_tr and status = 'SELESAI'");
        } else if($i == '4'){
            $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id WHERE transaction_id = $id_tr and status = 'CANCEL'");
        } else{
            
            $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id WHERE transaction_detail_tbl.transaction_id = '$id_tr'");
        }
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

        <section id="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="transaction.php">Semua Pesanan</a></li>
                                <li class="page-item"><a class="page-link" href="transaction.php?id=1">Proses</a></li>
                                <li class="page-item"><a class="page-link" href="transaction.php?id=2">Diantar</a></li>
                                <li class="page-item"><a class="page-link" href="transaction.php?id=3">Selesai</a></li>
                                <li class="page-item"><a class="page-link" href="transaction.php?id=4">Cancel</a></li>
                            </ul>
                        </nav>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Invoice</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Cancel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                        if(!mysqli_num_rows($result) > 0)
                                                {
                                                    echo '<center>You have No orders Placed yet. </center>';
                                                }
                                            else
                                                {
                                    $no = 1;
                                    while ($cake = mysqli_fetch_assoc($result)): 
                                    if ($cake['status'] == "SUCCES" || $cake['status'] == "CHECKOUT" || $cake['status'] == "DELIVERD" || $cake['status'] == "PROCESS" || $cake['status'] == "SELESAI" || $cake['status'] == "CANCEL"){
                                    ?>
                                    <tr>

                                        <td> <?= $no++; ?></td>
                                        <td>
                                        <?= $cake['order']; ?>
                                        </td>
                                        <td>
                                        <?= $cake['cake_name']; ?>
                                        </td>
                                        <td>
                                        <?= $cake['datetime']; ?>
                                        </td>
                                        <td>
                                        <?= $cake['quantity']; ?>
                                        </td>
                                        <td>
                                        Rp. <?= number_format($cake['price_total']); ?>
                                        </td>
                                        <td>
                                            <?php 
                                            $status=$cake['status'];
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
                                            ?>
                                        </td>
                                        <?php 
														if($status=="SUCCES"){
                                                            ?> <td><a href="cancel_orders.php?id=<?php echo $cake['transaction_detail_id'];?>" onclick="return confirm('Are you sure you want to cancel your order?');" class="text-danger"><i class="fa fa-times"></i></a> </td>
                                                            <?php
															
														} else if($status=="CHECKOUT") {
                                                            ?> <td>
                                                            <a href="delete.php?id=<?= $cake["transaction_detail_id"]; ?>" class="text-danger"><i class="fa fa-times"></i></a></td>
                                                            <?php
                                                        } else {
															echo  '<td></td>';
														}
														?>	
                                        <td>
                                            <a href="trdetail.php?id=<?= $cake["order"]; ?>" class="btn btn-default btn-sm">
                                                Detail
                                                    </a>
                                        </td>
                                    </tr>
                                    <?php }  endwhile; }?>
                                </tbody>
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