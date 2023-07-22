<?php
session_start(); 
error_reporting(0);

$conn = mysqli_connect('localhost', 'root', '', 'db_mycake');
$result = mysqli_query($conn, 'SELECT * FROM category_tbl');


require '../header.php';
?>
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Bordered table</h4>
                  <p class="card-description">
                    Add class <code>.table-bordered</code>
                  </p>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th width="20%">Photo</th>
                            <th>Desc</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
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
                            <td><a href="hapus_category.php?id=<?= $data['id'];?>" >Delete</a></td>
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

<?= require '../footer.php'; ?>