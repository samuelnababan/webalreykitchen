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
    echo '<script> alert("failed to edit!"); location.href = "tbl_category.php";  </script>';
} else {
$result = mysqli_query($conn, "SELECT * FROM category_tbl where id = $id");

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
                                    <h4 class="card-title">Edit Category</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="cekedit_category.php?id=<?= $data['id']; ?>" enctype="multipart/form-data">
                                        
                                        <div class="row">
                                            <div class="col-md-2 pr-1">
                                                <div class="form-group">
                                                    <label>ID</label>
                                                    <input type="text" class="form-control" disabled placeholder="id" value="<?= $data['id']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-10 pl-1">
                                                <div class="form-group">
                                                    <label>Category Name</label>
                                                    <input type="text" name="category_name" class="form-control" placeholder="Enter Name" value="<?= $data['category_name']; ?>">
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
                                                    <textarea rows="4" cols="80" name="category_detail" class="form-control" placeholder="Enter Detail" value="<?= $data['category_detail']; ?>"><?= $data['category_detail']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Category</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?= require 'footer.php'; ?>

