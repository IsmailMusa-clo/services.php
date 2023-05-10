    <?php
    /* 
    Copy Template 
    */
    session_start();
include_once('../database/connect.php'); 

// التاكد من ان المستخدم قام بالضغط على ارسال
if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $newpass = rand(123456654 , 654663211) ; // Create a Random Password
    $email      = $_POST['email'] ; 
    // Check The Email is exist or not 
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?") ;
    $stmt->execute(array($email)) ; 
    $check = $stmt->rowCount() ;
    if($check > 0) {
        // PhpMailer To send a new password 
        require_once 'mail.php' ;
        $mail->setFrom('webservices061@gmail.com', 'webservices');
        $mail->addAddress($email);               //Name is optional
        $mail->Subject = 'إعادة تعيين كلمة المرور';
        $mail->Body    = "كلمة السر الجديدة : " . "<strong>$newpass</strong>  ";
        $password = password_hash($newpass , PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET Password = ? WHERE email = ?") ;
        $stmt->execute(array($password , $email)) ;
        $mail->send() ;
        $msg = "<div class='alert alert-success'>تم ارسال كلمة سر جديدة الى البريد الالكتروني، سيتم تحويلك الى صفحة تسجيل الدخول بعد 3 ثوان</div>" ;
        header( "refresh:3;url=login.php" );
        exit();
    } else {
        echo "<div class='container'>" ;
        $msg =  "لم يتم العثور على البريد الالكتروني " ;
        echo "</div>"; 
    }           
}      
?>
<link href="../admin/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">



<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin-top: 150px;">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image:url('../admin/img/3293465.jpg');"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center mt-5">
                                        <?php 
                                            if(isset($msg)) {
                                                echo $msg ;
                                            }
                                        ?>
                                        <h1 class="h4 text-gray-900 mb-4">إعادة تعيين كلمة المرور</h1>
                                    </div>
                    <form action="" method = "POST" class="user">
                      
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="ادخل البريد الإلكتروني">
                        </div>
                        <input  class="btn btn-primary btn-user btn-block" type="submit" name="login">
                        
                        <div class="text-center mt-3">
                            <a class="small" href="login.php"> تسجيل الدخول</a> <br>
                        </div>
                        
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

  