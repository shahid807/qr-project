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
      $res = mysqli_query($con,"SELECT count(*) as total_record,qr_traffic.*,qr_code.name FROM qr_traffic,qr_code 
      WHERE qr_traffic.qr_code_id = qr_code.id AND qr_code.id='$id' $condition group by qr_traffic.added_on_str");
       
      if(mysqli_num_rows($res) > 0){
         while($row  = mysqli_fetch_assoc($res)){
            $arr[] = $row;
         }
      }else{
         redirect('qr_codes.php');
      }

      // GETTING TOTAL COUNT
      $total_count = 0;
      foreach($arr as $list){
         $total_count+= $list['total_record'];
      }

      // GETTING DATA FOR Device PIE CHARTS
      $resDevice = mysqli_query($con,"SELECT count(*) as total_record,device FROM qr_traffic 
      WHERE qr_code_id = '$id' group by qr_traffic.device");
      $deviceChartStr = "";
      while($rowDevice = mysqli_fetch_assoc($resDevice)){
         $deviceChartStr.="['".$rowDevice['device']."',".$rowDevice['total_record']."],";
      }
         $deviceChartStr = rtrim($deviceChartStr,",");

         // GETTING DATA FOR OS PIE CHARTS
         $resOS = mysqli_query($con,"SELECT count(*) as total_record,os FROM qr_traffic 
         WHERE qr_code_id = '$id' group by qr_traffic.os");
         $osChartStr = "";
         while($rowOS = mysqli_fetch_assoc($resOS)){
            $osChartStr.="['".$rowOS['os']."',".$rowOS['total_record']."],";
         }
            $osChartStr = rtrim($osChartStr,",");

            // GETTING DATA FOR BROWSER PIE CHARTS
         $resBrowser = mysqli_query($con,"SELECT count(*) as total_record,browser FROM qr_traffic 
         WHERE qr_code_id = '$id' group by qr_traffic.browser");
         $BrowserChartStr = "";
         while($rowBrowser = mysqli_fetch_assoc($resBrowser)){
            $BrowserChartStr.="['".$rowBrowser['browser']."',".$rowBrowser['total_record']."],";
         }
            $BrowserChartStr = rtrim($BrowserChartStr,",");
         
      
   }


   
   

   ?>
   <!-- GOOGLE PIE CHART JS -->
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawDeviceChart);
      google.charts.setOnLoadCallback(drawOSChart);
      google.charts.setOnLoadCallback(drawBrowserChart);

      function drawDeviceChart() {
      var data = google.visualization.arrayToDataTable([
      ['Device', 'Total Users'],
      <?php echo $deviceChartStr?>
     
      ]);

      var options = {title: 'Device'};
      var chart = new google.visualization.PieChart(document.getElementById('device'));
      chart.draw(data, options);
}


function drawOSChart() {
      var data = google.visualization.arrayToDataTable([
      ['Device', 'Total Users'],
      <?php echo $osChartStr ?>
      ]);

      var options = {title: 'OS'};
      var chart = new google.visualization.PieChart(document.getElementById('os'));
      chart.draw(data, options);
}

function drawBrowserChart() {
      var data = google.visualization.arrayToDataTable([
      ['Browser', 'Total Users'],
      <?php echo $BrowserChartStr ?>
      ]);

      var options = {title: 'Browser'};
      var chart = new google.visualization.PieChart(document.getElementById('browser'));
      chart.draw(data, options);
}
   </script>



<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">QR Code Report</h1>
   </div>
   <!-- Content Row -->
   <div class="row">
      <div class="col-lg-12">
      <di class="card">
            <div class="card-body"><h5>Total Count : ( <?= $total_count ?> ) </h5> 
            <a href="qr_detail_report.php?id=<?= $id ?>" class="btn btn-sm btn-success">See Complete Details</a> </div>
         </di>
         
      </div>
   </div>
   <br/>
   <div class="row">
      <div class="col-lg-4 mb-4">
         <di class="card">
            <div class="card-body" id="device"></div>
         </di>
      </div>

      <div class="col-lg-4 mb-4">
         <di class="card">
            <div class="card-body" id="os"></div>
         </di>
      </div>

      <div class="col-lg-4 mb-4">
         <di class="card">
            <div class="card-body" id="browser"></div>
         </di>
      </div>


      <div class="col-lg-12 mb-4">
         <di class="card">
            <div class="card-body">
            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>QR CODE</th>
                                            <th>DATE</th>
                                            <th>COUNT</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php 
                                          $i = 1;
                                          foreach($arr as $data){?>
                                    
                                        <tr>
                                            <td> <?= $i++ ?> </td>
                                            <td> <?= $data['name'] ?> </td>
                                            <td> <?= $data['total_record'] ?> </td>
                                            
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