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
                        <th scope="col">الاسم </th>
                        <th scope="col">البريد الالكتروني</th>
                        <th scope="col">الصورة الشخصية</th>
                        <th scope="col">تعديل</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // FETCH DATA FROM USERS WITH INNER JOIN RATING TABLE 
                    $select_emp = $conn->prepare("SELECT  *  FROM `admin`");
                    $select_emp->execute();
                    if ($select_emp->rowCount() > 0) {
                        $i = 1;
                        while ($fetch_emp = $select_emp->fetch(PDO::FETCH_ASSOC)) {
                            
                    ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $fetch_emp['name'] ?></td>
                                <td><?= $fetch_emp['email'] ?></td>
                                <td><img src="../../controller/uploaded_img/<?= $fetch_emp['avatar'] ?>" width="70" height="70" style="border-radius:50% ;"> </td>
                                <td>
                                    <a href="edit.php?update=<?= $fetch_emp['id']; ?>" class=" btn btn-success">
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