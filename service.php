<?php
// session_start(); 
include_once("header.php");
include_once('database/connect.php');
if(isset($_SESSION['customer'])) {
?>

<!-- start domain -->
<section class="domain pad-sec">
    <div class="container">
        <div class="content">
            <div class="title-sec">
                <h3>ابحث عن الخدمة التي ترغب بها </h3>
            </div>
            <div class="boxes">
                <?php
                $id= $_GET['id'];
                $select_services = $conn->prepare("SELECT * FROM `services` where category_id=? ");
                $select_services->execute([$id]);
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
                            <a href="user.php?id=<?= $fetch_services['id']?>">
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
<?php
} else{
    header("Location: c-login.php") ;
}
include_once("footer.php");
?>