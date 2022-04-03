<?php include('header.php');
   check_auth();
   $msg = "";
   // checking if User Role
   $condition = "";
   if($_SESSION['QR_USER_ROLE'] == 'user'){
       $condition = "and added_by='".$_SESSION['QR_USER_ID']."'";
   }
   

   // FOR DOWNLOADING QR CODE
   if(isset($_GET['type']) == "download" && $_GET['type'] !=""){
         $link = "https://chart.apis.google.com/chart?cht=qr&chs=".$_GET['chs']."&chco=".$_GET['chco']."&chl=".$_GET['chl'];
         $img = './assets/img/flower_'.time().'_.jpg';     
         file_put_contents($img, file_get_contents($link));  
         $msg = "QR Code Downloaded Successfully!";

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
       mysqli_query($con,"UPDATE qr_code SET status='$status' WHERE id=$id $condition");
       redirect('qr_codes.php');
   }
       // Getting Data except admin
       $res = mysqli_query($con,"SELECT qr_code.*,users.email FROM qr_code,users WHERE 1 and qr_code.added_by=users.id $condition order by users.added_on DESC");
   
   ?>
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">QR Codes</h1>
   </div>
   <!-- Content Row -->
   <div class="row">
      <div class="col-lg-12 mb-4">
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <a href="manage_qr_codes.php" class="btn btn-sm btn-success">Add QR Code</a>
               <?php echo "<strong class='text-success'>$msg</strong>"; ?>
               <?php 
                  if(isset($_SESSION['QR_HIT_ERROR'])){
                     echo "&nbsp;<span>'".$_SESSION['QR_HIT_ERROR']."'</span>";
                  }
               ?>
               
            </div>
            <div class="card-body">
               <?php 
                  if(mysqli_num_rows($res) > 0){
                  ?>
               <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>QR CODE</th>
                           <th>Link</th>
                           <th>Size</th>
                           <th>
                              <?php 
                                 if(isset($_SESSION['QR_USER_ROLE']) && $_SESSION['QR_USER_ROLE'] == 'admin'){
                                    echo "Added By";
                                 }
                                 ?>
                           </th>
                           <th>Added On</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                           $i = 1;
                           while($row = mysqli_fetch_assoc($res)){
                             
                            $i++;
                            ?>
                        <tr>
                           <td> <?= $i ?> </td>
                           <td> <?= $row['name'] ?> </td>
                           <td><a target="_blank" href="https://chart.apis.google.com/chart?cht=qr&chs=<?= $row['size'] ?>&chco=<?= $row['color'] ?>&chl=<?= $qr_file_path ?>?id=<?= $row['id'] ?>"><img src="https://chart.apis.google.com/chart?cht=qr&chs=<?= $row['size'] ?>&chco=<?= $row['color'] ?>&chl=<?= $qr_file_path ?>?id=<?= $row['id'] ?>" alt="no-qr"></a></td>
                           <td> <?= $row['link'] ?> </td>
                           <td> <?= $row['size'] ?> </td>
                           <td> <?php 
                              if(isset($_SESSION['QR_USER_ROLE']) && $_SESSION['QR_USER_ROLE'] == 'admin'){
                                  echo $row['email'];
                              }
                               
                              ?> </td>
                           <td> <?= getcustomDate($row['added_on']) ?> </td>
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
                              <a class="btn btn-success btn-sm" href="manage_qr_codes.php?id=<?php echo $row['id'] ?>"><i class="fa fa-check"></i></a>
                              <a class="btn btn-info btn-sm" href="qr_report.php?id=<?php echo $row['id'] ?>"><i class="fa fa-eye" title="Report"></i></a>
                              <a class="btn btn-info btn-sm" href="?type=download&chs=<?= $row['size'] ?>&chco=<?= $row['color'];?>&chl=<?= $qr_file_path;?>?id=<?= $row['id'] ?>"><i class="fas fa-download"></i></a>
                                 
                           </td>
                        </tr>
                        <?php 
                           }
                           ?>
                        </td>
                        </tr>
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