<?php
include_once("../header.php");
$update_id = $_GET['update'];
$username =  $email =  $avatar = '';
$select_emp = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
$select_emp->execute([$update_id]);
if ($select_emp->rowCount() > 0) {
    while ($fetch_emp = $select_emp->fetch(PDO::FETCH_ASSOC)) {
        $id = $fetch_emp['id'];
        $username = $fetch_emp['name'];
        $email = $fetch_emp['email'];
        $avatar = $fetch_emp['avatar'];
        $password = $fetch_emp['password'];
    }
}

?>
<!-- Main content -->
<div class="container">
    <div class="boxes">
        <div class="card" style="width: 100%;height:70%;text-align:right">
            <div class="card-header">
                تعديل البيانات
            </div>
            <div class="card-body">
                <form action="../../controller/user.php" method="post" enctype="multipart/form-data" style="direction: rtl;">
                    <div class="row">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
                        <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $avatar ?>">
                        <input type="hidden" class="form-control" id="old_password" name="old_password" value="<?= $password ?>">
                        <div class="form-group col-md-6">
                            <label for="name">الاسم</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" placeholder="اسم الموظف">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">البريد الالكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" placeholder="البريد الالكتروني">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image">إضافة صورة:</label>
                            <input class="form-control" type="file" name="image">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="password">كلمة المرور :</label>
                            <input type="password" class="form-control" name="password" value="">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="update_admin" class="btn btn-success" style="float:left">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
<?php
include_once("../footer.php");
?>