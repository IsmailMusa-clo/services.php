<?php
include_once("../../database/connect.php");
include_once("../header.php");
?>
<!-- Main content -->
<div class="container">
    <div class="boxes">
        <div class="card" style="width: 100%;height:70%;text-align:right">
            <div class="card-header">
                إضافة تصنيف جديد
            </div>
            <div class="card-body">
                <form action="../../controller/category.php" method="post" enctype="multipart/form-data" style="direction: rtl;">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">اسم التصنيف</label>
                            <input type="text" class="form-control" id="name" name="name" value="" placeholder="اسم التصنيف">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image">إضافة صورة:</label>
                            <input class="form-control" type="file" name="image" required>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="add_cat" class="btn btn-success" style="float:left">
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