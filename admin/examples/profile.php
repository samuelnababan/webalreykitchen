<?php
session_start(); 
error_reporting(0);

require 'koneksi.php';
$id = $_SESSION['admin_id'];
if (is_null($id)) {
    header("location: login.php");
    } else {
$result = mysqli_query($conn, "SELECT * FROM admin_tbl where id = $id");
$user = mysqli_fetch_assoc($result);
    }
require 'header.php';
?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="cekprofile.php">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?= $user['username']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?= $user['name']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Telepon</label>
                                                    <input type="text" name="telepon" class="form-control" placeholder="Enter Telepon" value="<?= $user['telepon']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?= $user['email']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Enter Password" value="<?= $user['password']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-info btn-fill pull-right">UPDATE</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?= require 'footer.php'; ?>

