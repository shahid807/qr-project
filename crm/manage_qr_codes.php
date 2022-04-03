<?php
include('header.php');
check_auth();
$msg = "";
$name  = "";
$link           = '';
$color          = '';
$size          = '';
$id=0;

// FOR CHECKING IS ADMIN SOTHAT USER CAN ADD QR CODE
$isAdmin = "yes";
// checking if User Role
$condition = "";
if($_SESSION['QR_USER_ROLE'] == 'user'){
    $condition = "and added_by='".$_SESSION['QR_USER_ID']."'";
    $isAdmin = "No";
    // Getting user Info to limit Qr Codes
    $getUserInfo    = getUserInfo($_SESSION['QR_USER_ID']);
    $getUserTotalQR = getUserTotalQR($_SESSION['QR_USER_ID']);
}else{
    $isAdmin = "No";
}





// Getting Data For Edit User
if(isset($_GET['id']) && $_GET['id'] > 0){
    $id  = get_safe_value($_GET['id']);
    $res = mysqli_query($con,"SELECT * FROM qr_code WHERE id='$id' $condition");
    if(mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res); 
    $name           = $row['name'];
    $link           = $row['link'];
    $color          = $row['color'];
    $size           = $row['size'];
    }else{
        redirect('qr_codes.php');
    }
}

// INSERTING DATA INTO QR CODE
if(isset($_POST['submit'])){
    extract($_POST);
    $name           = get_safe_value($_POST['name']);
    $link           = get_safe_value($_POST['link']);
    $size           = get_safe_value($_POST['size']);
    $color          = get_safe_value($_POST['color']);
    $status         = 1;
    $added_by       = $_SESSION['QR_USER_ID'];
    $added_on       = date('Y-m-d h:m:s');

    // Updating Data if ID found For Edit
    if(isset($_GET['id']) && $_GET['id'] > 0){
        mysqli_query($con,"UPDATE qr_code SET name='$name',link='$link',size='$size',color='$color' WHERE id='$id' $condition");
    }else{
        if(mysqli_query($con, "INSERT INTO qr_code(name,link,color,size,added_by,status,added_on)  VALUES('$name','$link','$color','$size','$added_by','$status','$added_on')")){
        
        }
    }
        redirect('qr_codes.php');
        
        
    

}
?>
<div class="container">

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
           
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Manage QR Code</h1>
                    </div>
                    <form class="user" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="name"
                                   value="<?= $name ?>" placeholder="Name">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" name="link"
                                value="<?= $link ?>" placeholder="Link">
                            </div>
                        </div>
                        <div class="form-group">
                        <select class="form-control" name="size" required>
                        <option value="">Select Size</option>
                        <?php
                            $sizeSql = mysqli_query($con,"SELECT * FROM size WHERE status=1 order by size asc");
                            while($row = mysqli_fetch_assoc($sizeSql)){
                                $is_selected="";
                                if($row['size'] == $size){
                                    $is_selected = "selected";
                                }
                                echo '<option '.$is_selected.' value="'.$row['size'].'">'.$row['size'].'</option>';
                            }
                        ?>
                        </select>
                        </div>
                       
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                            <select class="form-control" name="color" required>
                        <option value="">Select Color</option>
                        <?php
                            $coloreSql = mysqli_query($con,"SELECT * FROM colors WHERE status=1 order by color asc");
                            while($row = mysqli_fetch_assoc($coloreSql)){
                                $is_selected="";
                                if($row['color'] == $color){
                                    $is_selected = "selected";
                                }
                                echo '<option '.$is_selected.' value="'.$row['color'].'">'.$row['color'].'</option>';
                            }
                        ?>
                        </select>
                            </div>
                            
                            
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <?php 
                                    if($id == 0 && $isAdmin == "No"){
                                        if($getUserInfo['total_qr'] > $getUserTotalQR['total_qr']){
                                        ?>
                                        <input type="submit" name="submit" class="btn btn-lg btn-success">
                                        <?php
                                        }
                                        else{
                                            echo "<span class='text-danger'>Total QR limit Exceeds</span>";
                                        }
                                    }else{
                                        echo ' <input type="submit" name="submit" class="btn btn-lg btn-success">';
                                    }
                                ?>
                                
                            </div>
                            
                        </div>
                        
                        <hr>
                      
                    </form>
                    <hr>
                    
                </div>
            </div>
        </div>
    </div>
</div>

</div>


<?php include('footer.php') ?>