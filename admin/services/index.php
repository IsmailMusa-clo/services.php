<?php
include_once("../header.php");
?>
<!-- Main content -->
<div class="container">
    <div class="card">
        <div class="card-header" style="text-align: right;">
            الخدمات
        </div>
        <div class="card-body">
            <table class="table" style="text-align: right;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">إسم الخدمة</th>
                        <th scope="col">التصنيف</th>
                        <th scope="col">صورة</th>
                        <th scope="col">الوصف</th>
                        <th scope="col">تعديل</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_services = $conn->prepare("SELECT * FROM `services`");
                    $select_services->execute();
                    if ($select_services->rowCount() > 0) {
                        $i = 1;
                        while ($fetch_services = $select_services->fetch(PDO::FETCH_ASSOC)) {
                            $category_id = $fetch_services['category_id'];
                            $category_name='';
                            $select_category = $conn->prepare("SELECT * FROM `catagories`WHERE id = ?");
                            $select_category->execute([$category_id]);
                            if ($select_category->rowCount() > 0) {
                                while ($row = $select_category->fetch(PDO::FETCH_ASSOC)) {
                                    $category_name=$row['name'];
                                }
                            }
                    ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $fetch_services['name'] ?></td>
                                <td><?= $category_name ?></td>
                                <td><img src="../../controller/uploaded_img/<?= $fetch_services['image']; ?>" width="50" height="50" style="border-radius: 50%;"> </td>
                                <td> <textarea class="form-control" style="height: 100px;resize:none" disabled><?= $fetch_services['desc']; ?></textarea></td>
                                <td>
                                    <a href="edit.php?update=<?= $fetch_services['id']; ?>" class=" btn btn-success">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="delete_cat.php?delete=<?= $fetch_services['id']; ?>" class=" btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                    <?php

                            $i++;
                        
                                
                    }
                    } else {
                        echo '<p class="empty">لا يوجد خدمات</p>';
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