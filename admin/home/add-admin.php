<?php

include_once("../../database/connect.php");
include_once("../header.php");

if(isset($_SESSION['type']) && $_SESSION['type']== "admin") {
    if($_SERVER['REQUEST_METHOD']== "POST")    {
        $name = $_POST['name'] ;
        $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        

        $email = $_POST['email'] ;
        $email = filter_var($email, FILTER_SANITIZE_EMAIL); 

        $avatar     = $_FILES['avatar']['name'] ;
        $avatar_tmp = $_FILES['avatar']['tmp_name'] ;
        $avatar_name = rand(1 , 1000) . $avatar ; 
        move_uploaded_file($avatar_tmp , '../../controller/uploaded_img\\' . $avatar);
        
        $stmt = $conn->prepare("SELECT * FROM admin WHERE name = ? AND email = ?") ;
        $stmt->execute(array($name , $email)) ;
        $count = $stmt->rowCount() ; 
        if($count > 0 ) {
           echo "<div class='alert alert-danger text-right'>هذا الحساب موجود</div>" ;

        } else {
           $stmt = $conn->prepare("INSERT INTO admin(name , password , email , avatar) VALUES (? , ?, ? ,?)") ;
           $stmt->execute(array($name , $password , $email , $avatar)) ;
           echo "<div class='alert alert-success  text-right''>تم التسجيل بنجاح</div>" ;
        }
    } 
?>
<h1 class="text-center">إضافة ادمن</h1>
                <div class="container">
                    <form class="form" action="" method="POST" enctype="multipart/form-data">
                        <!-- Start Input  -->
                        <div class="form-group row mt-3 ">
                            <label class="col-sm-2 col-form-label">الاسم</label>
                            <div class="col-sm-10 c">
                                <input type="text" name="name" class=" form-control"autocomplete="off"  required="required" placeholder=""> 
                            </div>
                        </div>
                    <!-- End Input  -->
                        
                    <!-- Start Input  -->
                    <div class="form-group row mt-3">
                            <label class="col-sm-2 col-form-label">كلمة المرور</label>
                            <div class="col-sm-10 c">
                                <input type="password" name="password" class="password form-control" autocomplete="new-password"required="required" placeholder="">
                            </div>
                        </div>
                        <!-- End Input  -->
                        
                    <!-- Start Input  -->
                    <div class="form-group row mt-3">
                            <label class="col-sm-2 col-form-label">البريد االإلكتروني</label>
                            <div class="col-sm-10 c">
                                <input type="text" name="email" class="form-control" autocomplete="off" required="required" placeholder="">
                            </div>
                    </div>
                        <!-- End Input  -->                

                    <!-- Start Input  -->
                    <div class="form-group row mt-3">
                            <label class="col-sm-2 col-form-label">الصورة الشخصية</label>
                            <div class="col-sm-10 c">
                                <input type="file" name="avatar" class="form-control p-1" >
                                <input type="submit" value="إضافة" class="btn btn-primary mt-3">
                            </div>
                    </div>
                        <!-- End Input  -->          
                    </form>
            </div>    
<?php } else {
    echo "hi" ;
}
?>



<?php
include_once("../footer.php");
?>