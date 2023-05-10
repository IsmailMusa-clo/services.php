<?php
include_once('../database/connect.php');
if (isset($_POST['add_service'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
    
    $desc = $_POST['desc'];
    $desc = filter_var($desc, FILTER_SANITIZE_SPECIAL_CHARS);
    $category_id = $_POST['category'];
    $category_id = filter_var($category_id, FILTER_SANITIZE_NUMBER_INT);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;
    $select_name = $conn->prepare("SELECT * FROM `services` WHERE name = ?");
    $select_name->execute([$name]);
    if ($select_name->rowCount() > 0) {
        $error = "هذه الخدمة موجود مسبقاً";
    } else {
        if ($image_size > 2000000) {
            setcookie('message', 'حجم الصورة كبير جدا', time() + 4);
        } else {
            $insert_service = $conn->prepare("INSERT INTO `services`(`name`,`desc`,`image`,`category_id`) VALUES(?,?,?,?)");
            $insert_service->execute([$name,$desc, $image,$category_id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $message = "تم اضافة الموظف";
            setcookie('message', 'تم العملية بنجاح', time() + 4);
        }
    }
    header('location:../admin/services/index.php');
}

if (isset($_POST['update_service'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

    $desc = $_POST['desc'];
    $desc = filter_var($desc, FILTER_SANITIZE_SPECIAL_CHARS);
    $category_id = $_POST['category'];
    $category_id = filter_var($category_id, FILTER_SANITIZE_NUMBER_INT);

    $id = $_POST['id'];

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $update_cat = $conn->prepare("UPDATE `services` SET `name` =?,`desc`=?,`category_id`=? WHERE id = ?");
    $update_cat->execute([$name,$desc,$category_id, $id]);
    setcookie('message', 'تم العملية بنجاح', time() + 4);
    if (!empty($image)) {
        if ($image_size > 2000000) {
            setcookie('message', 'حجم الصورة كبير جدا  ', time() + 4);
        } else {
            $update_image = $conn->prepare("UPDATE `services` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/' . $old_image);
            setcookie('message', ' تم تعديل الصورة!', time() + 4000);
        }
    }
    header('location:../admin/services/index.php');
}
