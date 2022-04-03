<?php include('header.php') ;
check_auth();
check_admin_auth();
$curren_page = $_SERVER['SCRIPT_NAME'];
$curren_page_arr = explode("/",$curren_page);
$curren_page = $curren_page_arr[(count($curren_page_arr)-1)];

if($curren_page == "" || $curren_page == "manage_users.php"){
    
}


if(isset($_GET['status']) && $_GET['status'] !='' && isset($_GET['id']) && $_GET['id'] > 0 ){
    $status = get_safe_value($_GET['status']);
    $id     = get_safe_value($_GET['id']);
    
    if($status == 'active'){
        $status = 1;
    }else{
        $status = 0;
    }
    // Updating Staus of user
    mysqli_query($con,"UPDATE users SET status='$status' WHERE id=$id");
    redirect('users.php');
}
    // Getting Data except admin
    $res = mysqli_query($con,"SELECT * FROM users WHERE user_type='user' order by added_on DESC");

?>
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Users</h1>
     
   </div>
   <!-- Content Row -->
   <div class="row">
      <div class="col-lg-12 mb-4">
      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="manage_users.php" class="btn btn-sm btn-success">Add User</a>
                        </div>
                        <div class="card-body">
                            <?php 
                                if(mysqli_num_rows($res) > 0){
                                ?>
                                
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Total QR/Total Used</th>
                                            <th>Total Hits/Total Used</th>
                                            <th>Added On</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            while($row = mysqli_fetch_assoc($res)){
                                              $getUserTotalQR = getUserTotalQR($row['id']);
                                              $getUserTotalQRHit = getUserTotalQRHit($row['id']);
                                               
                                             $i++;
                                             ?>
                                             <tr>
                                            <td> <?php echo $i ?> </td>
                                            <td> <?php echo $row['name'] ?> </td>
                                            <td> <?php echo $row['email'] ?> </td>
                                            <td> <?php echo $row['total_qr'] .'/'. $getUserTotalQR['total_qr'] ?> </td>
                                            <td> <?php echo $row['total_qr_hits'].'/'.$getUserTotalQRHit['total_hit'] ?> </td>
                                            <td></td>
                                            <td>
                                                <?php
                                                $status = "active";
                                                $strStatus = "Deactive";
                                                if($row['status'] == 1){
                                                    $status = "deactive";
                                                    $strStatus = "Active";
                                                }
                                                
                                                ?>
                                                <a class="btn btn-primary btn-sm" href="?id=<?= $row['id'] ?>&status=<?= $status ?>"><?= $strStatus ?></a>
                                                <a class="btn btn-success btn-sm" href="edit_user.php?id=<?php echo $row['id'] ?>"><i class="fa fa-check"></i></a>
                                                
                                                
                                            </td>
                                        </tr>
                                             
                                            <?php 
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                            <?php
                                }else{
                                    echo "<p class='text text-danger text-center'> No Data Found </p>";
                                }
                                ?>
                        </div>
                    </div>
      </div>
   </div>
</div>
</div>
<!-- /.container-fluid -->
<?php include('footer.php') ?>