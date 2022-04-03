<?php 
include('header.php');
   check_auth();
   if(isset($_GET['id']) && $_GET['id'] > 0){
      // checking if User Role
      $condition = "";
      if($_SESSION['QR_USER_ROLE'] == 'user'){
         $condition = "and qr_code.added_by='".$_SESSION['QR_USER_ID']."'";
      }
      $id = get_safe_value($_GET['id']);
      $res = mysqli_query($con,"SELECT qr_traffic.* FROM qr_traffic,qr_code 
      WHERE qr_traffic.qr_code_id = qr_code.id AND qr_code.id='$id' $condition");
       
      if(mysqli_num_rows($res) > 0){
         while($row  = mysqli_fetch_assoc($res)){
            $arr[] = $row;
         }
      }else{
         redirect('qr_codes.php');
      }


         
      
   }
?>
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">QR CODE DETAIL REPORT</h1>
      
   </div>
   <!-- Content Row -->
   <div class="row">
      <div class="col-lg-12 mb-4">
         <di class="card">
            <div class="card-body">
            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> DEVICE </th>
                                            <th> OS </th>
                                            <th> BROWSER </th>
                                            <th> CITY </th>
                                            <th> STATE </th>
                                            <th> COUNTRY </th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php 
                                       $i=1;
                                          foreach($arr as $data){?>
                                    
                                        <tr>
                                            <td> <?= $i++ ?> </td>
                                            <td> <?= $data['device'] ?> </td>
                                            <td> <?= $data['os'] ?> </td>
                                            <td> <?= $data['browser'] ?> </td>
                                            <td> <?= $data['city'] ?> </td>
                                            <td> <?= $data['state'] ?> </td>
                                            <td> <?= $data['country'] ?> </td>
                                            
                                           
                                            
                                        </tr>
                                        <?php }?>
                                        
                                    </tbody>
                                </table>
                            </div>
            </div>
         </di>
      </div>

   </div>
</div>
<!-- /.container-fluid -->
<?php include('footer.php') ?>