<?php
include_once("../../database/connect.php");
include_once("../header.php");
?>
<!-- Main content -->
<div class="container">
    <div class="boxes">
        <div class="card" style="width: 100%;height:70%;text-align:right">
            <div class="card-header">
                إضافة موظف جديد
            </div>
            <div class="card-body">
                <form action="../../controller/user.php" method="post" enctype="multipart/form-data" style="direction: rtl;">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">اسم الموظف</label>
                            <input type="text" class="form-control" id="username" name="username" value="" placeholder="اسم الموظف">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">رقم الجوال</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="" placeholder="رقم الجوال">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">البريد الالكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" value="" placeholder="البريد الالكتروني">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">العنوان</label>
                            <input type="text" class="form-control" id="address" name="address" value="" placeholder="العنوان">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="price">سعر الخدمة</label>
                            <input type="decimal" class="form-control" id="price" name="price" value="" placeholder="العنوان">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="service">المسمى الوظيفي</label>
                            <select class="form-control" name="id" id="id">
                                <option value="" selected disabled>أختر ...</option>
                                <?php
                                $select_service = $conn->prepare("SELECT * FROM `services`");
                                $select_service->execute();
                                if ($select_service->rowCount() > 0) {
                                    $i = 1;
                                    while ($row = $select_service->fetch(PDO::FETCH_ASSOC)) {
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
                            <input class="form-control" type="file" name="image" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="password">كلمة المرور :</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="add_emp" class="btn btn-success" style="float:left">
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