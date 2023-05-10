<?php
    include 'database/connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - register</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<?php 
if ($_SERVER['REQUEST_METHOD']== "POST") {
    $error = "";
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    $select_user = $conn->prepare("SELECT * FROM `customer` WHERE username = ? AND email = ?");
    $select_user->execute([$username, $email]);
    if ($select_user->rowCount() > 0) {
        $error = "هذا المستخدم موجود مسبقاً";
    } else {
        if ($username != '' && $email != '' && $password != '') {
            $insert_user = $conn->prepare("INSERT INTO `customer`(username,email,password) VALUES(?,?,?)");
            $insert_user->execute([$username, $email, $password]);
            setcookie('message', 'تم العملية بنجاح', time() + 4);
            header('location:c-login.php');
        } else {
            echo $username. $email. $password;
            setcookie('message','الرجاء تعبئة الحقول', time() + 4);
            // header('location:../admin/register.php');
        }
    }
}

?>
<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin-top: 150px;">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image:url('admin/img/Chechnya.jpg');"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">أهلا وسهلا بكم</h1>
                                    </div>
                                    <!-- فورم تسجيل دخول -->
                                    <form class="user" action="" method="post" enctype="multipart/form-data">
                                        <!-- الايميل -->
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Enter username..." autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <!-- الباسسورد -->
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                                        </div>

                                        <!-- تأكيد الدخول -->
                                        <button class="btn btn-primary btn-user btn-block" type="submit" name="register">
                                            تسجيل الدخول
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="c-login.php"> هل لديك حساب بالفعل؟</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery.min.js"></script>
    <script src="vendor//bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>