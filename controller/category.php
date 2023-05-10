<?php
include_once('../database/connect.php');
if (isset($_POST['add_cat'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
    
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;
    $select_name = $conn->prepare("SELECT * FROM `catagories` WHERE name = ?");
    $select_name->execute([$name]);
    if ($select_name->rowCount() > 0) {
        $error = "هذا التصنيف موجود مسبقاً";
    } else {
        if ($image_size > 2000000) {
            setcookie('message', 'حجم الصورة كبير جدا', time() + 4);
        } else {
            $insert_cat = $conn->prepare("INSERT INTO `catagories`(`name`,`image`) VALUES(?,?)");
            $insert_cat->execute([$name,$image]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $message = "تم اضافة الموظف";
            setcookie('message', 'تم العملية بنجاح', time() + 4);
        }
    }
    header('location:../admin/categories/index.php');
}

if (isset($_POST['update_cat'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
    $id = $_POST['id'];

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $update_cat = $conn->prepare("UPDATE `catagories` SET name =? WHERE id = ?");
    $update_cat->execute([$name, $id]);
    setcookie('message', 'تم العملية بنجاح', time() + 4);
    if (!empty($image)) {
        if ($image_size > 2000000) {
            setcookie('message', 'حجم الصورة كبير جدا  ', time() + 4);
        } else {
            $update_image = $conn->prepare("UPDATE `catagories` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/' . $old_image);
            setcookie('message', ' تم تعديل الصورة!', time() + 4000);
        }
    }
    header('location:../admin/categories/index.php');
}
