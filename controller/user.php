<?php
include_once('../database/connect.php');
if (isset($_POST['add_emp'])) {
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = $_POST['phone'];
    $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_SPECIAL_CHARS);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT);
    $service_id = $_POST['id'];
    $service_id = filter_var($service_id, FILTER_SANITIZE_NUMBER_INT);
    $password =password_hash($_POST['password'],PASSWORD_BCRYPT);
   
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;
    $select_name = $conn->prepare("SELECT * FROM `users` WHERE username = ?");
    $select_name->execute([$username]);
    if ($select_name->rowCount() > 0) {
        $error = "هذا الموظف موجود مسبقاً";
    } else {
        if ($image_size > 2000000) {
            setcookie('message', 'حجم الصورة كبير جدا', time() + 4);
        } else {
            $insert_emp = $conn->prepare("INSERT INTO `users`(`username`,`password`,`phone`,`email`,`address`,`avatar`,`services_id`,`service_price`) VALUES(?,?,?,?,?,?,?,?)");
            $insert_emp->execute([$username, $password, $phone, $email,$address,$image,$service_id,$price]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $message = "تم اضافة الموظف";
            setcookie('message', 'تم العملية بنجاح', time() + 4);
        }
    }
    header('location:../admin/users/index.php');
}

if (isset($_POST['update_emp'])) {
    // اسم المستخدم
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    //رقم الجوال 
    $phone = $_POST['phone'];
    $phone = filter_var($phone, FILTER_SANITIZE_SPECIAL_CHARS);
    // الايميل
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT);
    // العنوان
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_SPECIAL_CHARS);
    // رقم الخدمة
    $service_id = $_POST['service'];
    // كلمة السر
    $password = $_POST['old_password'];
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }
    // رقم المستخدم
    $id=$_POST['id'];
    // الصورة السابقة
    $old_image = $_POST['old_image'];

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $update_user = $conn->prepare("UPDATE `users` SET username=? ,password=? ,phone=? , email=?, address=? ,services_id=? ,service_price=?where id=?");
    $update_user->execute([$username,$password,$phone,$email,$address,$service_id,$price,$id]);
    setcookie('message', 'تم العملية بنجاح', time() + 4);
    if (!empty($image)) {
        if ($image_size > 2000000) {
            setcookie('message', 'حجم الصورة كبير جدا  ', time() + 4);
        } else {
            $update_image = $conn->prepare("UPDATE `users` SET avatar = ? WHERE id = ?");
            $update_image->execute([$image, $id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/' . $old_image);
            setcookie('message', ' تم تعديل الصورة!', time() + 4000);
        }
    }
    
    header('location:../admin/home/index.php');
}

