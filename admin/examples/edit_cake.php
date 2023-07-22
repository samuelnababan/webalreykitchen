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
    echo '<script> alert("failed to edit!"); location.href = "tbl_cake.php";  </script>';
} else {
$result = mysqli_query($conn, "SELECT cake_tbl.id, cake_tbl.cake_name, cake_tbl.cake_desc, cake_tbl.category_id, 
cake_tbl.cake_photo, cake_tbl.cake_price,category_tbl.category_name
FROM cake_tbl inner join category_tbl on cake_tbl.category_id = category_tbl.id where cake_tbl.id = $id");

$data = mysqli_fetch_array($result);
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
                                    <h4 class="card-title">Edit Produk</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="cekedit_cake.php?id=<?= $data['id']; ?>" enctype="multipart/form-data">
                                        
                                        <div class="row">
                                            <div class="col-md-2 pr-1">
                                                <div class="form-group">
                                                    <label>ID</label>
                                                    <input type="text" class="form-control" disabled placeholder="id" value="<?= $data['id']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-10 pl-1">
                                                <div class="form-group">
                                                    <label>Produk Name</label>
                                                    <input type="text" name="cake_name" class="form-control" placeholder="Enter Name" value="<?= $data['cake_name']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Produk Desc</label>
                                                    <textarea rows="4" cols="80" name="cake_desc" class="form-control" placeholder="Enter Detail" value="<?= $data['cake_desc']; ?>"><?= $data['cake_desc']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Category Name</label>
                                                    <select name="category_id" class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                                        <option value="<?= $data['category_id']; ?>"><?= $data['category_name']; ?></option>
                                                 <?php $ssql ="select * from category_tbl";
													$res=mysqli_query($conn, $ssql); 
													while($row=mysqli_fetch_array($res))  
													{ 
                                                       echo' <option value="'.$row['id'].'">'.$row['category_name'].'</option>';
													}  
                                                 
													?> 
													 </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Harga</label>
                                                    <input type="text" name="cake_price" class="form-control" placeholder="Enter Name" value="<?= $data['cake_price']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Produk Photo</label>
                                                    <input type="file" name="cake_photo" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Produk</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?= require 'footer.php'; ?>

