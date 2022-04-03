<?php
 include('db.php');
 include('functions.php');
 $msg = "";
    if(isset($_SESSION['QR_USER_LOGIN'])){
        redirect('profile.php');
    }

if(isset($_POST['submit'])){
    $email = get_safe_value($_POST['email']);
    $pass  = get_safe_value($_POST['password']);

    $res = mysqli_query($con,"SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        $db_password = $row['password'];
        if(password_verify($pass,$db_password)){

            if($row['status'] == 0){
                $msg = "You Account is Deactivated!";
            }else{
                $_SESSION['QR_USER_LOGIN'] = true;
                $_SESSION['QR_USER_ID'] = $row['id'];
                $_SESSION['QR_USER_NAME'] = $row['name'];
                $_SESSION['QR_USER_ROLE'] = $row['user_type'];
                redirect('profile.php');
                }

           }else{ // password verify else 
            $msg = "Please insert correct password!";
            }

    }else{
        $msg = "Please enter valid login details!";
    }
}// If isset ends here

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login to QR Code</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                name="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                    <input type="submit" name="submit" value="Login" class="btn btn-primary btn-user btn-block">
                                        </a>
                                        <br/>
                                        <span class="text-danger"><?php echo $msg ?></span>
                                    </form>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


</body>

</html>