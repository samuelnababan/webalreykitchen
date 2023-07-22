<?php
session_start(); 
error_reporting(0);

require 'koneksi.php';
$id = $_GET["id"];
$id_user = $_SESSION['admin_id'];
if (is_null($id_user)) {
    header("location: login.php");
    } else {
if($id == ''){
    echo '<script> alert("failed to edit!"); location.href = "tbl_transaction.php";  </script>';
} else {
    $result = mysqli_query($conn, "SELECT * FROM transaction_detail_tbl INNER JOIN cake_tbl ON transaction_detail_tbl.cake_id = cake_tbl.id
    JOIN transaction_tbl ON transaction_detail_tbl.transaction_id = transaction_tbl.id where transaction_detail_id = $id");
$data = mysqli_fetch_array($result);
$id_tr = $data['transaction_id'];
$resultu = mysqli_query($conn, "SELECT * FROM transaction_tbl INNER JOIN user_tbl ON transaction_tbl.user_id = user_tbl.id where transaction_tbl.id = $id_tr");
$d = mysqli_fetch_array($resultu);
$status = $data['status'];
                                            
}
    }
require 'header.php';
?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">User Transaction</h4>
                                </div>
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="name" class="form-control" disabled value="<?= $d['name']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text"name="phone" class="form-control" disabled value="<?= $d['phone']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" name="email" disabled class="form-control" value="<?= $d['email']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea disabled rows="4" cols="80" name="address" class="form-control" placeholder="Enter Detail" value="<?= $d['address']; ?>"><?= $d['address']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    
                                        <form method="post" action="cekdetail_transaction.php?id=<?= $data['transaction_detail_id']; ?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Status Pemesanan</label>
                                                    
                                                    <input type="text" name="stat" disabled class="form-control" value="<?php 
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
                                                    }  ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Ubah Status Pemesanan</label>
                                                    <?php if($status == "SELESAI" || $status == "CANCEL"){ ?>
                                                        <select disabled name="status" class="form-control">
                                                    <?php } else {?>
                                                    <select name="status" class="form-control">
                                                    <?php }?>
                                                    <option>--pilih status pemesanan--</option> 
                                                    <option value="PROCESS">Pesanan Sedang Diproses</option>     
                                                        <option value="DELIVERD">Pesanan Diantar</option>
                                                        <option value="SELESAI">Pesanan Selesai</option>
                                                        <option value="CANCEL">CANCEL</option> 
													 </select>
                                                </div>
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Status</button>
                                            <div class="clearfix"></div>
                                    
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Produk Transaction</h4>
                                </div>
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>ID</label>
                                                    <input type="text" name="id" class="form-control" disabled value="<?= $data['transaction_detail_id']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3 pl-1">
                                                <div class="form-group">
                                                    <label>ORDER ID</label>
                                                    <input type="text" name="id" class="form-control" disabled value="<?= $data['order']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Nama Produk</label>
                                                    <input type="text" name="cake_name" disabled class="form-control" value="<?= $data['cake_name']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Harga Produk</label>
                                                    <input type="text" name="cake_price" class="form-control" disabled value="<?= number_format($data['cake_price']); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input type="text" name="quantity" disabled class="form-control" value="<?= $data['quantity']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Total</label>
                                                    <input type="text" name="price_total" class="form-control" disabled value="<?= number_format($data['price_total']); ?>">
                                                </div>
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
<?= require 'footer.php'; ?>

