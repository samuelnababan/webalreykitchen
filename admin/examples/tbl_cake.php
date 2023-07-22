<?php
session_start(); 
error_reporting(0);

require 'koneksi.php';
$id = $_SESSION['admin_id'];
$keyword = $_GET["keyword"];
if (is_null($id)) {
    header("location: login.php");
    } else {
        if($keyword){
$result = mysqli_query($conn, "SELECT cake_tbl.id, cake_tbl.cake_name, cake_tbl.cake_desc, cake_tbl.category_id, 
cake_tbl.cake_photo, cake_tbl.cake_price,category_tbl.category_name
FROM cake_tbl INNER JOIN category_tbl ON cake_tbl.category_id = category_tbl.id 
where cake_tbl.id like '%$keyword%' or 
cake_tbl.cake_name like '%$keyword%' or 
cake_tbl.cake_desc like '%$keyword%' or 
cake_tbl.category_id like '%$keyword%' or 
cake_tbl.cake_photo like '%$keyword%' or 
cake_tbl.cake_price like '%$keyword%' or 
category_tbl.category_name like '%$keyword%'");
        } else {
            $result = mysqli_query($conn, "SELECT cake_tbl.id, cake_tbl.cake_name, cake_tbl.cake_desc, cake_tbl.category_id, 
cake_tbl.cake_photo, cake_tbl.cake_price,category_tbl.category_name
FROM cake_tbl INNER JOIN category_tbl ON cake_tbl.category_id = category_tbl.id");
        }
    }

require 'header.php';
?>
            <div class="content">
                <div class="container-fluid">
                        <form method="get" action="tbl_cake.php">
                                        
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-plain table-plain-bg">
                                <div class="card-header ">
                                    <h4 class="card-title">Table Produk</h4>
                                    <p class="card-category">Cake</p>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Desc</th>
                                            <th>Category</th>
                                            <th width="20%">Photo</th>
                                            <th>Harga</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            while ($data = mysqli_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?> </td>
                                                <td><?= $data['cake_name']; ?></td>
                                                <td><?= $data['cake_desc']; ?></td>
                                                <td><?= $data['category_name']; ?></td>
                                                <td><img src="../../assets/img/<?= $data['cake_photo'];?>" alt="image" width="50%"></td>
                                                <td><?= number_format($data['cake_price']); ?></td>
                                                <td><a href="edit_cake.php?id=<?= $data['id'];?>" >Edit</a></td>
                                                <td><a href="hapus_cake.php?id=<?= $data['id'];?>" onclick="return confirm('Anda yakin akan menghapus data id= <?= $data['id'];?>?')">Delete</a></td>
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
