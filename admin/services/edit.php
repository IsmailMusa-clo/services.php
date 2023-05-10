<?php
include_once("../header.php");
$update_id = $_GET['update'];
$username = $phone = $email = $address = $services_id = $avatar = '';
$select_service = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
$select_service->execute([$update_id]);
if ($select_service->rowCount() > 0) {
    while ($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)) {
        $id = $fetch_service['id'];
        $name = $fetch_service['name'];
        $category_id = $fetch_service['category_id'];
        $desc = $fetch_service['desc'];
        $image = $fetch_service['image'];
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
                <form action="../../controller/service.php" method="post" enctype="multipart/form-data" style="direction: rtl;">
                    <div class="row">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
                        <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $image ?>">
                        <div class="form-group col-md-6">
                            <label for="name">اسم الخدمة</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" placeholder="اسم الخدمة">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">التصنيف </label>
                            <select class="form-control" name="category" id="category">
                                <?php
                                $select_category = $conn->prepare("SELECT * FROM `catagories`");
                                $select_category->execute();
                                if ($select_category->rowCount() > 0) {
                                    while ($row = $select_category->fetch(PDO::FETCH_ASSOC)) {
                                        if ($row['id'] == $category_id) {
                                            $ser = $row['name'];
                                            echo "<option value='" . $category_id . "' selected >" . $ser . "</option>";
                                        }
                                ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="desc">وصف الخدمة:</label>
                            <textarea name="desc" class="form-control" style="height: 100px;resize:none"><?= $desc ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="image">إضافة صورة:</label>
                            <input class="form-control" type="file" name="image" >
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="update_service" class="btn btn-success" style="float:left">
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