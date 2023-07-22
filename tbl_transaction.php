<?php
session_start(); 
error_reporting(0);

$conn = mysqli_connect('localhost', 'root', '', 'db_mycake');
$id = $_GET['id'];
$keyword = $_GET["keyword"];
$id_user = $_SESSION['admin_id'];
if (is_null($id_user)) {
    header("location: login.php");
    } else {
if($id == '1'){
    $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id
    JOIN transaction_tbl ON transaction_detail_tbl.transaction_id = transaction_tbl.id where transaction_detail_tbl.status = 'SUCCES' or transaction_detail_tbl.status = 'PROCESS' or transaction_detail_tbl.status = 'DELIVERD'");
} else if($id == '2'){
    $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id
    JOIN transaction_tbl ON transaction_detail_tbl.transaction_id = transaction_tbl.id where transaction_detail_tbl.status = 'SELESAI'");
} else if($id == '3'){
    $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id
    JOIN transaction_tbl ON transaction_detail_tbl.transaction_id = transaction_tbl.id where transaction_detail_tbl.status = 'CANCEL'");
} else if($keyword){
    $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id 
    JOIN transaction_tbl ON transaction_detail_tbl.transaction_id = transaction_tbl.id
    where transaction_detail_tbl.status like '%$keyword%' or 
    transaction_detail_tbl.order like '%$keyword%' or
    transaction_detail_tbl.datetime like '%$keyword%' or
    user_tbl.username like '%$keyword%' or 
    user_tbl.name like '%$keyword%' or 
    cake_tbl.cake_name like '%$keyword%'");
} else {
    $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id 
    JOIN transaction_tbl ON transaction_detail_tbl.transaction_id = transaction_tbl.id");

}

    }
require 'header.php';
?>
            <div class="content">
                <div class="container-fluid">
                        <form method="get" action="tbl_transaction.php">
                                        
                                        <div class="row justify-content-end">
                                            <div class="col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <input type="text" name="keyword" class="form-control" placeholder="Enter Search" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-lg-1">
                                                <div class="form-group">
                                                <button type="submit" class="btn btn-info btn-fill pull-right"><i class="nc-icon nc-zoom-split"></i></button>
                                               </div>
                                            </div>
                                        </div>
                                        
                                    </form>
                            <div class="places-buttons">
                                
                                <div class="row justify-content-center">
                                    <div class="col-md-3 col-lg-3">
                                        <a class="btn btn-default btn-block" href="tbl_transaction.php">Semua Order</a>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <a class="btn btn-default btn-block" href="tbl_transaction.php?id=1">Sedang Berjalan</a>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <a class="btn btn-default btn-block" href="tbl_transaction.php?id=2">Order Selesai</a>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <a class="btn btn-default btn-block" href="tbl_transaction.php?id=3">Cancel</a>
                                    </div>
                                </div>
                            </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-plain table-plain-bg">
                                <div class="card-header pr-1">
                                    <h4 class="card-title">Table Trancaction</h4>
                                    <?php if($id == '1'){ ?>
                                        <p class="card-category">Order yang sedang berjalan</p>
                                    <?php } else if($id == '2'){ ?>
                                        <p class="card-category">Order yang telah selesai</p>
                                    <?php } else if($id == '3'){ ?>
                                        <p class="card-category">Order Cancel</p>
                                    <?php } else if($keyword){ ?>
                                        <p class="card-category">Hasil Pencarian</p>
                                    <?php } else { ?>
                                        <p class="card-category">All Order</p>
                                    <?php } ?>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>No</th>
                                            <th>User</th>
                                            <th>Nama Produk</th>
                                            <th>Quantity</th>
                                            <th>Harga</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            while ($data = mysqli_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <?php $id_tr = $data['transaction_id']; 
                                                $resultu = mysqli_query($conn, "SELECT * FROM transaction_tbl INNER JOIN user_tbl ON transaction_tbl.user_id = user_tbl.id where transaction_tbl.id = $id_tr");
                                                $d = mysqli_fetch_array($resultu);?>
                                                <td><?= $no++ ?> </td>
                                                <td><?= $d['name']; ?></td>
                                                <td><?= $data['cake_name']; ?></td>
                                                <td><?= $data['quantity']; ?></td>
                                                <td><?= number_format($data['price_total']); ?></td>
                                                <td><?= $d['address']; ?></td>
                                                <td><?= $data['datetime']; ?></td>
                                                <td><?= $data['status']; ?></td>
                                                <td><a href="detail_transaction.php?id=<?= $data['transaction_detail_id'];?>" >Detail</a></td>
                                                <td><a href="hapus_transaction.php?id=<?= $data['transaction_detail_id'];?>" onclick="return confirm('Anda yakin akan menghapus data id= <?= $data['transaction_detail_id'];?>?')">Delete</a></td>
                                                <td width="1%"></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?= require 'footer.php'; ?>
