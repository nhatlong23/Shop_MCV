<?php
include    'inc/header.php';
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>

<style>
    h3.payment {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        text-decoration: underline;
    }

    .warper_method {
        text-align: center;
        width: 550px;
        margin: 0 auto;
        border: 1px solid #666;
        padding: 20px;
        background: cornsilk;
    }

    .warper_method a {
        padding: 10px;
        background: red;
        color: #fff;
    }

    .warper_method h3 {
        margin-bottom: 20px;
    }

    .warper_method a a {
        word-wrap: break-word;
    }

    .warper_method a {
        padding: 6px;
        background: red;
        color: #fff;
        display: block;
        width: 150px;
        margin: 0 auto;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
    }
</style>


<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Thanh Toán Online</h3>
            </div>
            <div class="clear"></div>
            <div class="warper_method">
                <h3 class="payment">Chọn cổng thanh toán online</h3>
                <a href="donhangthanhtoanonline.php" class="btn btn-primary">Thanh Toán VNPAY</a>
                <a href="donhangthanhtoanonline.php" class="btn btn-danger alpha">Thanh Toán MOMO</a>
                <a class="btn btn-success" href="cart.php">>>Previous</a>
            </div>
        </div>
    </div>
</div>
</div>


<?php
include 'inc/footer.php';
?>