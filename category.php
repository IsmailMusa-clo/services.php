<?php
include_once("header.php");
include_once('database/connect.php');
if(isset($_SESSION['customer'])) {
?>
<!-- start services -->
<h2 style="text-align: center; margin-top:30px"> التصنيفات</h2>
<section class="services container" style="margin:20px  ;">
    <?php
    $select_cat = $conn->prepare("SELECT * FROM `catagories` order by `id` ");
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

<?php

} else{
    header("Location: c-login.php") ;
}
include_once("footer.php");
?>