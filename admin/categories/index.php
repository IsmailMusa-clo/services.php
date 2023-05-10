<?php
include_once("../header.php");
?>
<!-- Main content -->
<div class="container">
    <div class="card">
        <div class="card-header">
            التصنيفات
        </div>
        <div class="card-body">
            <table class="table" style="text-align: right;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">إسم التصنيف</th>
                        <th scope="col">صورة</th>
                        <th scope="col">تعديل</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_cat = $conn->prepare("SELECT * FROM `catagories`");
                    $select_cat->execute();
                    if ($select_cat->rowCount() > 0) {
                        $i = 1;
                        while ($fetch_cat = $select_cat->fetch(PDO::FETCH_ASSOC)) {
                            
                    ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $fetch_cat['name'] ?></td>
                                <td><img src="../../controller/uploaded_img/<?=$fetch_cat['image']; ?>" width="50" height="50" style="border-radius:50%;"> </td>
                                <td>
                                    <a href="edit.php?update=<?= $fetch_cat['id']; ?>" class=" btn btn-success">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="delete_cat.php?delete=<?= $fetch_cat['id']; ?>" class=" btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                    <?php

                            $i++;
                        }
                    } else {
                        echo '<p class="empty">لا يوجد تصنيفات</p>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.content -->

<?php
include_once("../footer.php");
?>