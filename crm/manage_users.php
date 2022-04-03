<?php 
include('header.php');
check_auth();
check_admin_auth();
$msg = "";

if(isset($_POST['submit'])){
    $name           = get_safe_value($_POST['name']);
    $email          = get_safe_value($_POST['email']);
    $pass           = get_safe_value($_POST['pass']);
    $total_qr       = get_safe_value($_POST['total_qr']);
    $total_qr_hits  = get_safe_value($_POST['email']);
    $role           ='user';
    $status         = 1;
    $added_on       = date('Y-m-d h:m:s');
    $pass = password_hash($pass,PASSWORD_DEFAULT);

    // $email_sql = "";
    // if($id > 0){
    //     $email_sql ="and id!='$id'";
    // }   

    if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE email='$email'")) > 0){
        $msg = "Email Address already Exist";
    }else{
        if(mysqli_query($con, "INSERT INTO users(name,email,password,total_qr,total_qr_hits,user_type,status,added_on)  VALUES('$name','$email','$pass','$total_qr','$total_qr_hits','$role','$status','$added_on')")){
            }
            redirect('users.php');
        }

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
                        <h1 class="h4 text-gray-900 mb-4">Manage User</h1>
                    </div>
                    <form class="user" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="name"
                                    placeholder="Name"  required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" class="form-control form-control-user" name="email"
                                    placeholder="Email"  required> 
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="pass"
                                placeholder="Password" />
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user"
                                    name="total_qr"  placeholder="Total QR Codes">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user"
                                    name="total_qr_hits"  placeholder="Total QR Hits">
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


<?php include('footer.php') ?>