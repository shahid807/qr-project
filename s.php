<?php
include('crm/db.php');
include('crm/functions.php');
include('lib/Mobile_detect.php');
include('lib/BrowserDetection.php');


if(isset($_GET['id']) && $_GET['id'] > 0){
    $id = get_safe_value($_GET['id']);

    $res = mysqli_query($con,"SELECT added_by,link FROM qr_code WHERE id='$id' and status=1");
    if(mysqli_num_rows($res) > 0){
        $row  = mysqli_fetch_assoc($res);
        $link = $row['link']; 
        $added_by = $row['added_by'];
        $getUserInfo    = getUserInfo($added_by);
    
        if($getUserInfo['total_qr_hits']!=0){
            $totalUserQRHitListRes = getUserTotalQRHit($added_by);
           if($getUserInfo['total_qr_hits'] < ($totalUserQRHitListRes['total_hit']+1)){
                die('something went wrong');
            }
        }

     

        $detect  = new Mobile_detect();
        $browserObj = new Wolfcast\BrowserDetection();
        $browser = $browserObj->getName();
       
        
        // variables for holding Data
        $device = "";
        $os     = "";

        if($detect->isMobile()){
            $device = "Mobile";
        }else if($detect->isTablet()){
            $device = "Tablet";
        }else{
            $device = "PC";
        }


        // FOR IOS
        if($detect->isiOS()){
            $os = "iOS";
        }else if($detect->isAndroidOS()){
            $os = "Android";
        }else{
            $os = "Windows";
        }

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $res = curl_exec($ch);
        curl_close($ch);
        $result     = json_decode($res,true);
        $city       = $result['city'];
        $state      = $result['regionName'];
        $country    = $result['country'];
        $ip_address = $result['query'];
        $added_on   = date('Y-m-d h:i:s');
        $added_on_str   = date('Y-m-d');
        mysqli_query($con,"INSERT INTO qr_traffic (qr_code_id,device,os,browser,city,state,country,added_on,added_on_str,ip_address) 
        VALUES('$id','$device','$os','$browser','$city','$state','$country','$added_on','$added_on_str','$ip_address')");
        redirect($link);
    }else{
        die('Something went Wrong!');
    }
}

?>