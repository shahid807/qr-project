<?php
include('header.php');
check_auth();
check_admin_auth();
// Getting Data For Edit User
$msg ="";
if(isset($_GET['id']) && $_GET['id'] > 0){
    $id  = get_safe_value($_GET['id']);
    $res = mysqli_query($con,"SELECT * FROM users WHERE id='$id'");
    if(mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res); 
    $name           = $row['name'];
    $email          = $row['email'];
    $password       = $row['password'];
    $total_qr       = $row['total_qr'];
    $total_qr_hits  = $row['total_qr_hits'];
    }else{
        redirect('users.php');
    }
}

if(isset($_POST['submit'])){
    extract($_POST);
    mysqli_query($con,"UPDATE users SET name='$name', email='$email', total_qr='$total_qr', total_qr_hits='$total_qr_hits' WHERE id='$id'");
    redirect('users.php');
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
                        <h1 class="h4 text-gray-900 mb-4">Update User</h1>
                    </div>
                    <form class="user" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="name"
                                    value = "<?= $row['name'] ?>" placeholder="Name"  required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" class="form-control form-control-user" name="email"
                                value = "<?= $row['email'] ?>"   placeholder="Email"  required> 
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="pass"
                            value = "<?= $row['password'] ?>" placeholder="Password" />
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user"
                                value = "<?= $row['total_qr'] ?>" name="total_qr"  placeholder="Total QR Codes">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user"
                                value = "<?= $row['total_qr_hits'] ?>"  name="total_qr_hits"  placeholder="Total QR Hits">
                            </div>
                            
                        </div>

                            <div class="col-sm-6">
                                <input name="submit" type="submit" class="btn btn-lg btn-success">
                            </div>
                            
                        </div>
                        
                        <hr>
                      
                    </form>
                    
                    <strong style="margin-left:10px" class='text-danger'><?php echo $msg ?></strong>
                    <br/><br/>
                </div>
            </div>
        </div>
    </div>
</div>
</div>