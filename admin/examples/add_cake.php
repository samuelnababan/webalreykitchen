<?php
session_start(); 
error_reporting(0);

require 'koneksi.php';
$id = $_SESSION['admin_id'];
if (is_null($id)) {
    header("location: login.php");
    } else {
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
                                    <form method="post" action="cekadd_cake.php " enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Produk Name</label>
                                                    <input type="text" name="cake_name" class="form-control" placeholder="Enter Name" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Produk Desc</label>
                                                    <textarea rows="4" cols="80" name="cake_desc" class="form-control" placeholder="Enter Desc" value=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Category Name</label>
                                                    <select name="category_id" class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                                        <option>--Pilih Category--</option>
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
                                                    <input type="text" name="cake_price" class="form-control" placeholder="Enter Harga" value="">
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

