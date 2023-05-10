<?php
include_once("../header.php");
?>
<!-- Main content -->
<div class="container">
    <div class="card">
        <div class="card-header">
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
                        <th scope="col">الرسالة</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_contact = $conn->prepare("SELECT * FROM `contact`");
                    $select_contact->execute();
                    if ($select_contact->rowCount() > 0) {
                        $i = 1;
                        while ($fetch_contact = $select_contact->fetch(PDO::FETCH_ASSOC)) {
                            
                    ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $fetch_contact['username'] ?></td>
                                <td><?= $fetch_contact['phone'] ?></td>
                                <td><?= $fetch_contact['email'] ?></td>
                                <td><?= $fetch_contact['address'] ?></td>
                                <td><textarea class="from-class" disabled style="width: 500; height:100px"><?=$fetch_contact['message']?></textarea> </td>
                                <td>
                                    <a href="delete_con.php?delete=<?= $fetch_contact['id']; ?>" class=" btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                    <?php

                            $i++;
                        }
                    } else {
                        echo '<p class="empty">لا يوجد طلبات</p>';
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