<?php
include_once("../header.php");
?>
<!-- Main content -->
<div class="container">
    <div class="card">
        <div class="card-header" style="text-align: right;">
            طلبات التواصل
        </div>
        <div class="card-body">
            <table class="table" style="text-align: right;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الإسم</th>
                        <th scope="col">رقم الجوال</th>
                        <th scope="col">البريد الالكتروني</th>
                        <th scope="col">العنوان</th>
                        <th scope="col">مقدم الخدمة</th>
                        <th scope="col">السعر</th>
                        <th scope="col">الحالة</th>
                        <th scope="col">تاريخ الطلب</th>
                        <th scope="col">تغيير مقدم الطلب</th>
                        <th scope="col">تعديل الحالة</th>

                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody style="text-align: right;">
                    <?php
                    $user = "";
                    if ($type == 'admin') {
                        $select_order = $conn->prepare("SELECT * FROM `orders`");
                        $select_order->execute();
                        if ($select_order->rowCount() > 0) {
                            $i = 1;
                            while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {
                                $user_id = $fetch_order['emp_id'];
                                $select_user = $conn->prepare("SELECT email FROM `users` where id =?");
                                $select_user->execute([$user_id]);
                                while ($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)) {
                                    $user = $fetch_user['email'];
                                }
                    ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $fetch_order['username'] ?></td>
                                    <td><?= $fetch_order['phone'] ?></td>
                                    <td><?= $fetch_order['email'] ?></td>
                                    <td><?= $fetch_order['address'] ?></td>
                                    <td><?= $user ?></td>
                                    <td><?= $fetch_order['price'] ?></td>
                                    <td><?= $fetch_order['status'] ?></td>
                                    <td><?= $fetch_order['timestamp'] ?></td>
                                    <td><a href="edit_emp.php?update=<?= $fetch_order['id']; ?>" class=" btn btn-success">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="edit.php?update=<?= $fetch_order['id']; ?>" class=" btn btn-success">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        if (isset($_SESSION['type']) && $_SESSION['type'] == 'admin') { ?>
                                            <a href="delete_order.php?delete=<?= $fetch_order['id']; ?>" class=" btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>

                                        <?php  }
                                        ?>
                                    </td>
                                </tr>
                        <?php

                                $i++;
                            }
                        } else {
                            echo '<p class="empty">لا يوجد طلبات</p>';
                        }
                    } else {
                        ?>
                        <?php
                        $select_order = $conn->prepare("SELECT * FROM `orders` WHERE emp_id=?");
                        $select_order->execute([$_SESSION['id']]);
                        if ($select_order->rowCount() > 0) {
                            $i = 1;
                            while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $fetch_order['username'] ?></td>
                                    <td><?= $fetch_order['phone'] ?></td>
                                    <td><?= $fetch_order['email'] ?></td>
                                    <td><?= $fetch_order['address'] ?></td>
                                    <td><?= $fetch_order['emp_id'] ?></td>
                                    <td><?= $fetch_order['price'] ?></td>
                                    <td><?= $fetch_order['status'] ?></td>
                                    <td><?= $fetch_order['timestamp'] ?></td>
                                    <td>

                                        <a href="edit.php?update=<?= $fetch_order['id']; ?>" class=" btn btn-success">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                    </td>
                                    <td>

                                        <?php
                                        if (isset($_SESSION['type']) && $_SESSION['type'] == 'admin') { ?>
                                            <a href="delete_order.php?delete=<?= $fetch_order['id']; ?>" class=" btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                    <?php
                                $i++;
                            }
                        } else {
                            echo '<p class="empty">لا يوجد طلبات</p>';
                        }
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