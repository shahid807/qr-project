<?php 

    function pr($arr){
        echo "<pre>";
            print_r($arr);
  
    }


    function prx($arr){
        echo "<pre>";
            print_r($arr);
        die();
    }

    function get_safe_value($str){
        if($str !=''){
            global $con;
            return mysqli_real_escape_string($con,$str);
        }
    }

    function redirect($location){
        ?>
        <script> window.location.href='<?php echo $location ?>' </script>
     <?php   
    }
    function check_auth(){
        if(!isset($_SESSION['QR_USER_LOGIN'])){
            redirect('index.php');
        }
    }


    function check_admin_auth(){
        if($_SESSION['QR_USER_ROLE'] != 'admin'){
            redirect('profile.php');
        }
    }

    function getCustomDate($data){
        if($data !=''){
            $data = strtotime($data);
            return date('d-M-Y',$data);
        }
    }

    function getUserInfo($uid){
        global $con;
        $row = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id='$uid'"));
        return $row;

    }

    function getUserTotalQR($uid){
        global $con;
        $row = mysqli_fetch_assoc(mysqli_query($con,"SELECT count(*) as total_qr FROM qr_code WHERE added_by='$uid'"));
        return $row;

    }

    function getUserTotalQRHit($uid){
        global $con;
      $row =  mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(*) as total_hit FROM qr_traffic,qr_code,users
            WHERE qr_traffic.qr_code_id=qr_code.id and qr_code.added_by=users.id and users.id='".$uid."'"));
        return $row;
    }


?>