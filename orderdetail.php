<?php
include    'inc/header.php';
?>


<?php
// if (isset($_GET['cartid'])) {
// 	$cartid = $_GET['cartid'];
// 	$delcart = $ct->del_product_cart($cartid);
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
// 	$cartId = $_POST['cartId'];
// 	$quantity = $_POST['quantity'];
// 	$update_quantity_Cart = $ct->update_quantity_Cart($quantity, $cartId);

// 	if ($quantity <= 0) {
// 		$delcart = $ct->del_product_cart($cartId);
// 	}
// }
?>

<?php
$ct = new cart();
$customer_id = Session::get('customer_id');
if ($login_check == false) {
    header('Location:login.php');
}

if (isset($_GET['confirmid'])) {
    $id = $_GET['confirmid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $shifted_confirm = $ct->shifted_confirm($id, $time, $price);
}
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Details Ordered</h2>

                <table class="tblone">
                    <tr>
                        <th width="10%">ID</th>
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="10%">Date</th>
                        <th width="10%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
                    $customer_id = Session::get('customer_id');
                    $get_cart_ordered = $ct->get_cart_ordered($customer_id);
                    if ($get_cart_ordered) {
                        $i = 0;
                        $qty = 0;
                        while ($result = $get_cart_ordered->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $result['productName'] ?> </td>
                                <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
                                <td><?php echo $fm->format_currency($result['price']) . ' ' . 'VNĐ' ?></td>
                                <td><?php echo $result['quantity'] ?></td>
                                <td><?php echo $fm->formatDate($result['date_order']) ?></td>
                                <td>
                                    <?php
                                    if ($result['status'] == '0') {
                                        echo 'Chờ xác nhận';
                                    } elseif ($result['status'] == 1) {
                                    ?>
                                        <span>Đang giao đơn</span>

                                    <?php
                                    } elseif ($result['status'] == 2) {
                                        echo 'Đã nhận hàng';
                                    }
                                    ?>


                                </td>
                                <?php
                                if ($result['status'] == '0') {
                                ?>
                                    <td><?php echo 'N/A'; ?></td>
                                <?php
                                } elseif ($result['status'] == 1) {
                                ?>
                                    <td><a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Xác nhận</a></td>
                                <?php
                                } else {
                                ?>
                                    <td><a onclick="return confirm('Are you want to delete');" href="?cartid=<?php echo $result['id'] ?>">X</a></td>
                                <?php
                                }
                                ?>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>

            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php
include    'inc/footer.php';
?>