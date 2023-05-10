<?php
include_once("../header.php");
$update_id = $_GET['update'];
$name = $image = $id = '';
$select_cat = $conn->prepare("SELECT * FROM `catagories` WHERE id = ?");
$select_cat->execute([$update_id]);
if ($select_cat->rowCount() > 0) {
    while ($fetch_cat = $select_cat->fetch(PDO::FETCH_ASSOC)) {
        $id = $fetch_cat['id'];
        $name = $fetch_cat['name'];
        $image = $fetch_cat['image'];
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
                <form action="../../controller/category.php" method="post" enctype="multipart/form-data" style="direction: rtl;">
                    <div class="row">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
                        <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $image ?>">
                        <div class="form-group col-md-4">
                            <img src="../../controller/uploaded_img/<?= $image; ?>" width="250" height="200">
                        </div>
                        <div class="col-md-8">
                            <div class="form-group col-md-12">
                                <label for="name">اسم التصنيف</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" placeholder="اسم التصنيف">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="image">إضافة صورة:</label>
                                <input class="form-control" type="file" name="image" >
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="update_cat" class="btn btn-success" style="float:left">
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