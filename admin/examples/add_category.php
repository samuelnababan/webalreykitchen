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
                                    <h4 class="card-title">Add Category</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="cekadd_category.php" enctype="multipart/form-data">
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Category Name</label>
                                                    <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Category Photo</label>
                                                    <input type="file" name="category_photo" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Category Details</label>
                                                    <textarea rows="4" cols="80" name="category_detail" class="form-control" placeholder="Enter Category Detail" value=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Add Category</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?= require 'footer.php'; ?>

