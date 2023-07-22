<?php 
session_start(); 
error_reporting(0);
require 'koneksi.php';
$id = $_SESSION['user_id'];

if (is_null($id)) {
    header("location: login.php");
    } else {
$result = mysqli_query($conn, "SELECT * FROM user_tbl WHERE id=$id");
$cake = mysqli_fetch_assoc($result);
    }
require 'header.php'; ?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-alrey.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Settings
                    </h1>
                    <p class="lead">
                        Update Informasi Akun Anda
                    </p>
                </div>
            </div>
        </div>

        <section id="checkout">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-sm-6">
                        <h5 class="mb-3">ACCOUNT DETAILS</h5>
                        <!-- Bill Detail of the Page -->
                        <form method="post" action="ceksetting.php">
                            <fieldset>
                                <div class="form-group">
                                    <input disabled value="<?php echo $cake['username']?>" class="form-control" placeholder="Username" type="text">
                                </div>
                                <div class="form-group">
                                    <input name="name" value="<?php echo $cake['name']?>" class="form-control" placeholder="Name" type="text">
                                </div>
                                <div class="form-group">
                                    <textarea name="address" value="<?php echo $cake['address']?>" class="form-control" placeholder="Address"> <?php echo $cake['address']?> </textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input name="email" value="<?php echo $cake['email']?>" class="form-control" placeholder="Email Address" type="text">
                                    </div>
                                    <div class="col">
                                        <input name="phone" value="<?php echo $cake['phone']?>" class="form-control" placeholder="Phone Number" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="password" value="<?php echo $cake['password']?>" class="form-control" placeholder="Password lebih dari 6 karakter berisi huruf besar, huruf kecil dan angka" type="password">
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" onclick="return confirm('Are you sure you want to update your profile?');" name="submit" class="btn btn-primary" >UPDATE</button>
                                    <div class="clearfix">
                                </div>
                            </fieldset>
                        </form>
                        
                        <!-- Bill Detail of the Page end -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?= require 'footer.php'; ?>
</body>
</html>
