<?php
session_start(); 
include_once('database/connect.php');
if(isset($_SESSION['customer'])) {
?>
<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الخدمات</title>
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- start header -->
    <header>
        <!-- start navbar section -->
        <nav>
            <div class="container">
                <div class="content">
                    <div class="right-sec">
                        <!-- start brand sec  -->
                        <div class="brand">
                            <a href="index.php">
                                <img src="assets/images/logo-ar.png" alt="">
                            </a>
                        </div>
                        <!-- end brand sec -->
                        <ul>
                            <li><a href="index.php"><i class="fa fa-home"></i><span>الرئيسية</span></a></li>
                            <li><a href="category.php"><i class="fa fa-windows"></i><span>التصنيفات</span></a></li>
                            <li><a href="about.php"><i class="fa fa-commenting"></i><span>من نحن</span></a></li>
                            <li><a href="contact.php"><i class="fa fa-commenting"></i><span>تواصل معنا</span></a></li>
                        </ul>
                    </div>
                    <div class="left-sec">
                        <a href="admin/login.php" id="tr"><i class="fa fa-user"></i></a>
                        
                        <?php 
                            if(isset($_SESSION['customer'])) {
                                echo '<a href="logout.php" id="tr"><i class="fa fa-minus"></i></a>' ;
                            } else {
                                echo '<a href="c-login.php" id="tr"><i class="fa fa-plus"></i></a>' ;
                            }
                        ?>               
                        </div>
                    
                </div>
            </div>
        </nav>
        <!-- end navbar section -->
        <!-- start about us -->
        <section class="about-us" style="background-image:url('assets/images/2.jpg');">
            <div class="container">
                <div class="content pad-sec">
                    <h3>أكبر نظام عربي لتقديم جميع الخدمات التي يحتاجها كل بيت عربي</h3>
                    <p>أنجز جميع أعمالك بكل سهولة وأمان وأعلى</p>
                    <a href="category.php" class="btn"> اطلب الآن</a>
                </div>
            </div>
        </section>
        <!-- end about us -->
    </header>
    <!-- end header -->
    <!-- start main -->
    <main>
        <section class="about_sec">
            <div class="container">
                <div class="about">
                    <div class="image">
                        <div class="back" style="background-image: url('assets/images/logo-ar.png');"></div>
                    </div>
                    <div class="about__content">
                        <h1 class="about__title"> من نحن</h1>
                        <p class="about__desc"> تأسست شركة [اسم الشركة] برؤية واضحة لتحسين جودة الخدمات المقدمة لعملائنا الكرام في [مجال العمل]. نحن نؤمن بأن الخدمات عالية الجودة هي المفتاح لنجاح أي عمل، ومن هنا جاءت فلسفتنا في توفير خدمات عالية الجودة التي تلبي احتياجات عملائنا بأفضل شكل. تتميز شركتنا بالمهنية والتفاني في تقديم خدماتنا، كما أننا نستخدم التقنيات الحديثة لتحسين جودة الخدمات المقدمة. نحن نضمن رضا العملاء ونسعى جاهدين لتحقيق رؤيتنا المتمثلة في أن نصبح الشركة الأفضل في مجال الخدمات العالية الجودة. نقدم خدماتنا لعدد كبير من العملاء من مختلف القطاعات، مثل [القطاعات التي نعمل معها] ونحن نعتبر عملائنا شركاء في النجاح، ونعمل بكل جهدنا لتحقيق أهدافهم وأهدافنا معًا. نحن نفخر بتقديم خدمات عالية الجودة وتوفير الحلول المبتكرة لعملائنا، ونحن دائمًا ملتزمون بالتفاني والاحترافية في عملنا لضمان رضا العملاء ونجاحنا المستمر.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- start services -->
        <h2 class="title-sec" style="margin:40px ;"><a href="category.php"> التصنيفات</a> </h2>
        <section class="services pad-sec container">
            <?php
            $select_cat = $conn->prepare("SELECT * FROM `catagories` order by `id` desc limit 4");
            $select_cat->execute();
            if ($select_cat->rowCount() > 0) {
                while ($fetch_cat = $select_cat->fetch(PDO::FETCH_ASSOC)) {

            ?>
                    <div class="box">
                        <a href="service.php?id=<?= $fetch_cat['id'] ?>">
                            <img src="controller/uploaded_img/<?= $fetch_cat['image'] ?>" style="border-radius:50%;" alt="">
                            <h3><?= $fetch_cat['name'] ?></h3>
                        </a>
                    </div>
            <?php
                }
            }
            ?>

        </section>
        <!-- end services -->
        <!-- start domain -->
        <section class="domain pad-sec">
            <div class="container">
                <div class="content">
                    <div class="title-sec">
                        <h3>ابحث عن الخدمة التي ترغب بها </h3>
                    </div>
                    <div class="boxes">
                        <?php
                        $select_services = $conn->prepare("SELECT * FROM `services` ORDER BY id desc LIMIT 8 ");
                        $select_services->execute();
                        if ($select_services->rowCount() > 0) {
                            $i = 1;
                            while ($fetch_services = $select_services->fetch(PDO::FETCH_ASSOC)) {
                                $category_id = $fetch_services['category_id'];
                                $category_name = '';
                                $select_category = $conn->prepare("SELECT * FROM `catagories`WHERE id = ?");
                                $select_category->execute([$category_id]);
                                if ($select_category->rowCount() > 0) {
                                    while ($row = $select_category->fetch(PDO::FETCH_ASSOC)) {
                                        $category_name = $row['name'];
                                    }
                                }
                        ?>
                                <!-- start box -->
                                <div class="box">
                                    <a href="user.php?id=<?= $fetch_services['id'] ?>">
                                        <div class="brand"><img src="controller/uploaded_img/<?= $fetch_services['image'] ?>" style="width: 150px;height:200px;"></div>
                                        <h3><?= $fetch_services['name'] ?></h3>
                                    </a>
                                </div>
                                <!-- end box -->
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- end domain -->
        <!-- start product -->
        <section class="broduct pad-sec">
            <div class="container">
                <div class="content">
                    <div class="head">
                        <a href="category.php">اختر مقدمي الخدمات المميزين في مجتمعنا</a>
                    </div>
                    <hr>
                    <div class="boxes">

                        <?php
                        $select_emp = $conn->prepare("SELECT * FROM `users`");
                        $select_emp->execute();
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
                                        <a href="rate.php?rate_id=<?php echo $fetch_emp['id'] ?>">تقييم</a>

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

        <!-- start search -->
        <!-- <section class="search pad-sec">
            <div class="container">
                <div class="content">
                    <h3>مع منصة خدماتي لتقديم الخدمات بسهولة وسرعة وأداء دقيق|KH</h3>
                    <h3>ابق على اطلاع على احدث الخدمات المقدمة</h3>

                    <p>سيصلك الجديد بشكل دائم بحيث نسهل عليكم المهام </p>
                </div>
            </div>
        </section> -->
        <!-- end search -->
    </main>
    <!-- end main -->

    <!-- start footer -->
    <footer class="pad-sec">
        <div class="container">
            <div class="bottom">
                <p>جميع الحقوق محفوظة لدى FED</p>
                <ul>
                    <li><a href=""><i class="fa fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa  fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- end footer -->
</body>

</html>

<?php

} else {
    header("Location: c-login.php") ;
}


?>