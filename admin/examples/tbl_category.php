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
            $result = mysqli_query($conn, "SELECT * FROM category_tbl
            where category_name like '%$keyword%' or
            category_detail like '%$keyword%' or
            category_photo like '%$keyword%'");
        } else {
$result = mysqli_query($conn, 'SELECT * FROM category_tbl');
        }
    }

require 'header.php';
?>
            <div class="content">
                <div class="container-fluid">
                <form method="get" action="tbl_category.php">
                                        
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
                                    <h4 class="card-title">Table Category</h4>
                                    <p class="card-category">Category</p>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover" width="100%" cellspacing="0">
                                        <thead>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th width="20%">Photo</th>
                                            <th>Desc</th>
                                            <th>Edit</th>
                                            <th scope="col">Delete</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            while ($data = mysqli_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?> </td>
                                                <td><?= $data['category_name']; ?></td>
                                                <td><img src='../../assets/img/<?= $data['category_photo'];?>' width="50%"></td>
                                                <td><?= $data['category_detail']; ?></td>
                                                <td><a href="edit_category.php?id=<?= $data['id'];?>" >Edit</a></td>
                                                <td><a href="hapus_category.php?id=<?= $data['id'];?>" onclick="return confirm('Anda yakin akan menghapus data id= <?= $data['id'];?>?')">Delete</a></td>
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
