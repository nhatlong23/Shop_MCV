<?php
ob_start();
include 'lib/session.php';
Session::init();
?>

<?php
include  'lib/database.php';
include  'helpers/format.php';


spl_autoload_register(function ($class) {
    include_once "classes/" . $class . ".php";
});


$db = new Database();
$fm = new Format();
$ct = new cart();
$cat = new category();
$cs = new customer();
$product = new product();
$br = new brand();
$pos = new post();
$cs = new customer();


?>

<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>


<!DOCTYPE HTML>

<head>
    <title>Store Website</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/css.css" rel="stylesheet" type="text/css" media="all" />

    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/nav-hover.js"></script>
    <script type="text/javascript" src="js/js.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function($) {
            $('#dc_mega-menu-orange').dcMegaMenu({
                rowItems: '4',
                speed: 'fast',
                effect: 'fade'
            });
        });
    </script>
</head>

<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        padding: 12px 16px;
        z-index: 2;
        background: antiquewhite;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>

<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="" /></a>
            </div>
            <div class="header_top_right">
                <div class="search_box">
                    <form action="search.php" method="POST">
                        <input type="text" placeholder="Search" name="tukhoa">
                        <input type="submit" name="search_product" value="Tìm kiếm">
                    </form>
                </div>
                <div class="shopping_cart">
                    <div class="cart">
                        <a href="cart.php" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart</span>
                            <span class="no_product">
                                <?php
                                $check_cart = $ct->check_cart();
                                if ($check_cart) {
                                    $sum = Session::get("sum");
                                    $qty = Session::get("qty");
                                    echo $fm->format_currency($sum) . 'đ' . '-' . 'Qty:' . $qty;
                                } else {
                                    echo 'Empty';
                                }
                                ?>
                            </span>
                        </a>
                    </div>
                </div>

                <?php
                if (isset($_GET['customer_id'])) {
                    $customer_id = $_GET['customer_id'];
                    $delCart = $ct->del_all_data_cart();
                    $delCompare = $ct->del_compare($customer_id);
                    Session::destroy();
                }
                ?>
                <div class="login">
                    <?php
                    $login_check = Session::get('customer_login');
                    if ($login_check == false) {
                        echo '<a href="login.php">Login</a></div>';
                    } else {
                        echo '<a href="?customer_id=' . Session::get('customer_id') . '">Logout</a></div>';
                    }
                    ?>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="menu">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav">
                            <!-- <ul id="dc_mega-menu-orange" class="dc_mm-orange"> -->
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="products.php">Products</a></li>
                            <li><a href="topbrands.php">top brand</a></li>


                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Tin Tức
                                    <span class="caret"></span></a>
                                <ul class="dropdown-content">
                                    <?php
                                    $pos = $pos->show_category_post();
                                    if ($pos) {
                                        while ($result_new = $pos->fetch_assoc()) {
                                    ?>
                                            <li>
                                                <a href="category_post.php?id_post=<?php echo $result_new['id_cate_post'] ?>"> <?php echo $result_new['title'] ?> </a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>

                            <?php
                            $check_cart = $ct->check_cart();
                            if ($check_cart == true) {
                                echo '<li><a href="cart.php">Cart</a></li>';
                            } else {
                                echo '';
                            }
                            ?>

                            <?php
                            $customer_id = Session::get('customer_id');

                            $check_order = $ct->check_order($customer_id);
                            if ($check_order == true) {
                                echo '<li><a href="orderdetail.php">Ordered</a></li>';
                            } else {
                                echo '';
                            }
                            ?>

                            <?php
                            $login_check = Session::get('customer_login');
                            if ($login_check == false) {
                                echo '';
                            } else {
                                echo '<li><a href="profile.php">Profile</a> </li>';
                            }
                            ?>

                            <?php
                            $login_check = Session::get('customer_login');
                            if ($login_check) {
                                echo '<li><a href="compare.php">Compare</a> </li>';
                            }
                            ?>

                            <?php
                            // $login_check = Session::get('customer_login');
                            // if ($login_check) {
                            //     echo '<li><a href="wishlist.php">Wishlist</a> </li>';
                            // }
                            ?>
                            <li><a href="contact.php">Contact</a> </li>

                            <div class="clear"></div>
                            <!-- </ul> -->
                        </ul>
                    </div>
                </nav>
            </div>