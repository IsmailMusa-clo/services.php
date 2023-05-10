<?php
include_once("../header.php");
?>
<!-- Main content -->
<div class="container">
    <div class="card">
        <div class="card-header">
            الموظفون
        </div>
        <div class="card-body">
            <table class="table" style="text-align: right;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">إسم الموظف</th>
                        <th scope="col">رقم الجوال</th>
                        <th scope="col">البريد الالكتروني</th>
                        <th scope="col">العنوان</th>
                        <th scope="col">المسمى الوظيفي</th>
                        <th scope="col">سعرا لخدمة</th>
                        <th scope="col">الصورة الشخصية</th>
                        <th scope="col">التقييم</th>
                        <th scope="col">تعديل</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // FETCH DATA FROM USERS WITH INNER JOIN RATING TABLE 
                    $select_emp = $conn->prepare("SELECT users.* , AVG(rating.rate)AS rate FROM `users` 
                    INNER JOIN rating ON rating.rate_id = users.id
                    GROUP BY users.id ");
                    
                    $select_emp->execute();
                    $serivce="";
                    if ($select_emp->rowCount() > 0) {
                        $i = 1;
                        while ($fetch_emp = $select_emp->fetch(PDO::FETCH_ASSOC)) {
                            $services_id = $fetch_emp['services_id'];
                            $select_service = $conn->prepare("SELECT name FROM `services` WHERE id=?");
                            $select_service->execute([$services_id]);
                            
                            if ($select_service->rowCount() > 0) {
                                while ($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)) {
                                    $serivce=$fetch_service['name']; 
                                }
                                
                            }
                    ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $fetch_emp['username'] ?></td>
                                <td><?= $fetch_emp['phone'] ?></td>
                                <td><?= $fetch_emp['email'] ?></td>
                                <td><?= $fetch_emp['address'] ?></td>
                                <td><?= $serivce ?></td>
                                <td><?= $fetch_emp['service_price'] ?></td>
                                <td><img src="../../controller/uploaded_img/<?=$fetch_emp['avatar']?>" width="70" height="70" style="border-radius:50% ;"> </td>
                                <td><?php echo '<i class="fa fa-star"><i>' .round($fetch_emp['rate'] , 1) ?></td>
                                <td>
                                    <a href="edit.php?update=<?=$fetch_emp['id']; ?>" class=" btn btn-success">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="delete_emp.php?delete=<?= $fetch_emp['id']; ?>" class=" btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                    <?php

                            $i++;
                        }
                    } else {
                        echo '<p class="empty">لا يوجد موظفين</p>';
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