<?php
include_once("header.php");
include_once('database/connect.php');
if(isset($_SESSION['customer'])) {

?>
<style>
    .contact {
        margin: 100px auto;
        border: 1px solid #fff;
    }

    .contact .container {
        border: 3px groove #008CBA;
        width: 700px;
        border-radius: 5px;
        box-shadow: 4px 4px 14px #008CBA;
        padding: 30px;
    }

    form {
        display: flex;
        flex-direction: column;
        max-width: 500px;
        margin: 0 auto;
    }

    label {
        font-weight: bold;
        margin-top: 1em;
    }

    input[type="text"],
    input[type="email"],
    textarea {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 0.5em;
        margin-top: 0.5em;
        font-size: 1em;
        width: 100%;
    }

    textarea {
        height: 150px;
        resize: none;
    }

    button[type="submit"] {
        background-color: #008CBA;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 1em;
        margin-top: 1em;
        font-size: 1em;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #00688B;
    }
</style>
<div class="contact">
    <div class="container">
        <form action="controller/order.php" method="POST">
            <label for="username">الاسم:</label>
            <input type="text" id="username" name="username" required>
            <label for="phone">الهاتف:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" required>
            <label for="address">العنوان:</label>
            <input type="text" id="address" name="address" required>
            <input type="hidden" name="emp_id" value="<?=$_GET['id']?>">
            <button type="submit" name="add_order">إرسال</button>
        </form>

    </div>
</div>

<?php
} else{
    header("Location: c-login.php") ;
}
include_once("footer.php");
?>