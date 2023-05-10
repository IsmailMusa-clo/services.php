<?php
include_once("../../database/connect.php");
include_once("../header.php");
?>
<!-- Main content -->
<div class="container">
    <div class="boxes">
        <div class="card" style="width: 100%;height:70%;text-align:right">
            <div class="card-header">
                إضافة خدمة جديدة
            </div>
            <div class="card-body">
                <form action="../../controller/service.php" method="post" enctype="multipart/form-data" style="direction: rtl;">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">اسم الخدمة</label>
                            <input type="text" class="form-control" id="name" name="name" value="" placeholder="اسم الخدمة">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">التصنيف </label>
                            <select class="form-control" name="category" id="category">
                                <option value="" selected disabled>أختر ...</option>
                                <?php
                                $select_category = $conn->prepare("SELECT * FROM `catagories`");
                                $select_category->execute();
                                if ($select_category->rowCount() > 0) {
                                    while ($row = $select_category->fetch(PDO::FETCH_ASSOC)) {
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
                            <textarea name="desc" class="form-control" style="height: 100px;resize:none"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="image">إضافة صورة:</label>
                            <input class="form-control" type="file" name="image" required>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="add_service" class="btn btn-success" style="float:left">
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