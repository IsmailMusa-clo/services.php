<?php
include_once("../header.php");
$update_id = $_GET['update'];
$name = $emp_id = $order_avatar = $id = '';
$select_cat = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
$select_cat->execute([$update_id]);
if ($select_cat->rowCount() > 0) {
    while ($fetch_cat = $select_cat->fetch(PDO::FETCH_ASSOC)) {
        $id = $fetch_cat['id'];
        $emp_id=$fetch_cat['emp_id'];
        $name = $fetch_cat['username'];
    }
}
if (isset($_POST['update_emp'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
    $id = $_POST['id'];
    $emp  = $_POST['emp'];
    $emp = filter_var($emp, FILTER_SANITIZE_SPECIAL_CHARS);
   
    $update_cat = $conn->prepare("UPDATE `orders` SET emp_id =? WHERE id = ?");
    $update_cat->execute([$emp, $id]);
    setcookie('message', 'تم العملية بنجاح', time() + 4);
    echo "<script>location.replace('index.php')</script>";
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
                <form action="" method="post" enctype="multipart/form-data" style="direction: rtl;">
                    <div class="row">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
                        <div class="col-md-8">
                            <div class="form-group col-md-12">
                                <label for="name">اسم مقدم الطلب</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" placeholder="اسم التصنيف">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="category">تغيير الموظف</label>
                                <select class="form-control" name="emp" id="emp">
                                    <?php
                                    $select_category = $conn->prepare("SELECT * FROM `users`");
                                    $select_category->execute();
                                    if ($select_category->rowCount() > 0) {
                                        while ($row = $select_category->fetch(PDO::FETCH_ASSOC)) {
                                            if ($row['id'] == $emp_id) {
                                                $ser = $row['username'];
                                                echo "<option value='" . $emp_id . "' selected >" . $ser . "</option>";
                                            }
                                    ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['username'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
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