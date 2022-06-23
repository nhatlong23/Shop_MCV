<?php
include    'inc/header.php';
?>

<?php

if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insertOrder = $ct->insertOrder($customer_id);
    $delCart = $ct->del_all_data_cart();
    header('Location:success.php');
}
?>

<style type="text/css">
    .box_left {
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
    }

    .box_right {
        width: 47%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
    }

    .submit_order {
        padding: 10px 70px;
        border: none;
        background: red;
        font-size: 25px;
        color: #fff;
        margin: 10px;
        cursor: pointer;
    }

    a.a_order {
        background: red;
        padding: 7px 20px;
        color: #fff;
        font-size: 21px;
    }
</style>

<form action="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>OFFLINE PAYMENT</h3>
                </div>

                <div class="clear"></div>
                <div class="box_left">
                    <div class="cartpage">
                        <?php
                        if (isset($update_quantity_Cart)) {
                            echo $update_quantity_Cart;
                        }
                        ?>
                        <?php
                        if (isset($delcart)) {
                            echo $delcart;
                        }
                        ?>
                        <table class="tblone">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Product Name</th>
                                <th width="20%">Price</th>
                                <th width="20%">Quantity</th>
                                <th width="20%">Total Price</th>
                                <th width="10%">Action</th>
                            </tr>
                            <?php
                            $get_product_cart = $ct->get_product_cart();
                            if ($get_product_cart) {
                                $subtotal = 0;
                                $qty = 0;
                                $i = 0;
                                while ($result = $get_product_cart->fetch_assoc()) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td> <?php echo $i; ?> </td>
                                        <td> <?php echo $result['productname'] ?> </td>
                                        <td><?php echo $fm->format_currency($result['price']) . " " . "VND" ?></td>
                                        <td>
                                            <?php echo $result['quantity'] ?>
                                        </td>
                                        <td><?php $total = $result['price'] * $result['quantity'];
                                            echo $fm->format_currency($total) . ' ' . 'VNĐ';
                                            ?></td>
                                        <td> <a href="?cartid=<?php echo $result['cartId'] ?>">X</a></td>
                                    </tr>
                            <?php
                                    $subtotal += $total;
                                    $qty = $qty + $result['quantity'];
                                }
                            }
                            ?>
                        </table>
                        <?php
                        $check_cart = $ct->check_cart();
                        if ($check_cart) {
                        ?>
                            <table style="float:right;text-align:left;margin:5px;" width="40%">
                                <tr>
                                    <th>Sub Total : </th>
                                    <td>
                                        <?php
                                        echo $fm->format_currency($subtotal) . ' ' . 'VNĐ';
                                        Session::set('sum', $subtotal);
                                        Session::set('qty', $qty);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>VAT : </th>
                                    <td>10% (<?php $vat = $subtotal * 0.1;
                                                echo $fm->format_currency($vat) ?>) </td>
                                </tr>
                                <tr>
                                    <th>Grand Total :</th>
                                    <td>
                                        <?php
                                        $vat = $subtotal * 0.1;
                                        $gtotal = $subtotal + $vat;
                                        echo $fm->format_currency($gtotal) . ' ' . 'VNĐ';
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        <?php
                        } else {
                            echo 'Giỏ hàng trống';
                        }
                        ?>
                    </div>
                </div>
                <div class="box_right">
                    <table class="tblone">
                        <?php
                        $id = Session::get('customer_id');
                        $get_customer = $cs->show_customers($id);
                        if ($get_customer) {
                            while ($result = $get_customer->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td><?php echo $result['name'] ?></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>:</td>
                                    <td><?php echo $result['city'] ?></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>:</td>
                                    <td><?php echo $result['phone'] ?></td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>:</td>
                                    <td><?php echo $result['country'] ?></td>
                                </tr>
                                <tr>
                                    <td>Zip-Code</td>
                                    <td>:</td>
                                    <td><?php echo $result['zipcode'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><?php echo $result['email'] ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                    <td><?php echo $result['address'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>

        <?php
        $check_cart = $ct->check_cart();
        if (Session::get('customer_id') == true && $check_cart) {
        ?>
            <center> <a class="a_order" href="?orderid=order">Order Now</a> </center> <br>
        <?php
        } else {
        ?>
            <a class="btn btn-primary btn-thanhtoan" style="margin: auto; display: table;" href="cart.php"> Quay lại giỏ hàng </a></a>
        <?php
        }
        ?>
    </div>
</form>

<?php
include    'inc/footer.php';
?>