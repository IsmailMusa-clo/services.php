<?php
include_once("header.php");
include_once('database/connect.php');
if(isset($_SESSION['customer'])) {
?>
<!-- start product -->
<section class="broduct pad-sec">
    <div class="container">
        <div class="content">
            <div class="head">
                <a href="service.php">اختر مقدمي الخدمات المميزين في مجتمعنا</a>
            </div>
            <hr>
            <div class="boxes">


                <?php
                $select_emp = $conn->prepare("SELECT * FROM `users` where services_id=?");
                $select_emp->execute([$_GET['id']]);
                $service = "";
                if ($select_emp->rowCount() > 0) {
                    $i = 1;
                    while ($fetch_emp = $select_emp->fetch(PDO::FETCH_ASSOC)) {
                        $services_id = $fetch_emp['services_id'];
                        $select_service = $conn->prepare("SELECT name FROM `services` WHERE id=?");
                        $select_service->execute([$services_id]);

                        if ($select_service->rowCount() > 0) {
                            while ($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)) {
                                $service = $fetch_service['name'];
                            }
                        }
                ?>
                        <!-- start box -->
                        <div class="box">
                            <div class="img" style="background-image:url('controller/uploaded_img/<?= $fetch_emp['avatar'] ?>');background-position:center;background-size:cover"></div>
                            <div class="text">
                                <h3><?= $service ?></h3>
                                <div class="person">
                                    <i class="fa fa-user"></i>
                                    <span> <?= $fetch_emp['username'] ?> </span>
                                </div>
                                <div class="date">
                                    <div class="txt">
                                        <i class="fa fa-file"></i>
                                        <span><?= $fetch_emp['address'] ?></span>
                                    </div>
                                    <div class="time">
                                        <i class="fa fa-phone"></i>
                                        <span><?= $fetch_emp['phone'] ?></span>
                                    </div>
                                </div>
                                <h3 class="price">Dollar <?= $fetch_emp['service_price'] ?> <i class="fa fa-dollar"></i></h3>
                                <a href="order.php?id=<?=$fetch_emp['id']?>" class="btn">طلب الخدمة</a>
                            </div>
                        </div>
                        <!-- end box -->
                <?php

                        $i++;
                    }
                } else {
                    echo '<p class="empty">لا يوجد موظفين</p>';
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- end product -->
<?php
} else{
    header("Location: c-login.php") ;
}
include_once("footer.php");
?>