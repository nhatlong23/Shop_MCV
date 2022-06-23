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
    .warper_method h3{
        margin-bottom: 20px;
    }
    .warper_method a a {
        word-wrap: break-word;
    }

</style>


<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Payment Method</h3>
            </div>
            <div class="clear"></div>
            <div class="warper_method">
                <h3 class="payment">Choose Your method payment</h3>
                <a class="btn btn-success" href="offlinepayment.php">Offline Payment</a>
                <a class="btn btn-success" href="donhangthanhtoanonline.php">Online Payment</a>
                <p></p>
                <a class="btn btn-danger-cart" href="cart.php">>>Previous</a>
            </div>
        </div>
    </div>
</div>
</div>


<?php
include 'inc/footer.php';
?>