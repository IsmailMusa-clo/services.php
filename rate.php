<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<?php
include_once("header.php");
include_once('database/connect.php');
if(isset($_SESSION['customer'])) { 
    
    if($_SERVER['REQUEST_METHOD']=="POST") {
        $rate_id = isset($_GET['rate_id']) ? $_GET['rate_id'] : 0 ; 
        $rating = $_POST['rating'] ; 
        $stmt=$conn->prepare("INSERT INTO rating(rate , rate_id) VALUES (? , ?)") ;
        $stmt->execute(array($rating , $rate_id)) ;

        
    }
    ?>

<section class="rate-section">
<div class="card border-primary">
  <h5 class="card-header text-bg-primary">قم بالتقييم الآن</h5>
  <div class="card-body">
  <form action="" method="POST">
    <input type="range" name="rating" min=1 max=10 class="form-range">
    <input type="submit" class="custom-button" value="تقييم">
    </form>
  </div>
</div>

</section>
</div>

    <?php
} else{
    header("Location: c-login.php") ;
}
include_once("footer.php");
?>