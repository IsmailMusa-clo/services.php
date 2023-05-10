<?php
include_once("../header.php");
$update_id = $_SESSION['id'];
$username = $phone = $email = $address = $services_id = $avatar = '';
$select_emp = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_emp->execute([$update_id]);
if ($select_emp->rowCount() == 1) {
    while ($fetch_emp = $select_emp->fetch(PDO::FETCH_ASSOC)) {
        $id = $fetch_emp['id'];
        $username = $fetch_emp['username'];
        $phone = $fetch_emp['phone'];
        $email = $fetch_emp['email'];
        $address = $fetch_emp['address'];
        $services_id = $fetch_emp['services_id'];
        $avatar = $fetch_emp['avatar'];
        $password = $fetch_emp['password'];
        $service_price=$fetch_emp['service_price'];
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
                            <label for="name">اسم الموظف</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" placeholder="اسم الموظف">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">رقم الجوال</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $phone ?>" placeholder="رقم الجوال">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">البريد الالكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" placeholder="البريد الالكتروني">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">العنوان</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $address ?>" placeholder="العنوان">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="price">سعر الخدمة</label>
                            <input type="decimal" class="form-control" id="price" name="price" value="<?= $service_price ?>" placeholder="العنوان">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="service">المسمى الوظيفي</label>
                            <select class="form-control" name="service" id="service">
                                <?php
                                $select_service = $conn->prepare("SELECT * FROM `services`");
                                $select_service->execute();
                                if ($select_service->rowCount() > 0) {
                                    $i = 1;
                                    while ($row = $select_service->fetch(PDO::FETCH_ASSOC)) {
                                        if ($row['id'] == $services_id) {
                                            $ser = $row['name'];
                                            echo "<option value='" . $services_id . "' selected >" . $ser . "</option>";
                                        }
                                ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
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
                            <input type="submit" name="update_emp" class="btn btn-success" style="float:left">
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