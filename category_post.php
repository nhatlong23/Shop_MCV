<?php
include 'inc/header.php';
?>

<?php
if (!isset($_GET['id_post']) || $_GET['id_post'] == null) {
    echo "<script>window.location = '404.php'</script>";
} else {
    $id = $_GET['id_post'];
}

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $catName = $_POST['catName'];

//     $updateCat = $cat->update_category($catName, $id);
// }
?>

<div class="main">
    <div class="content">
        <?php
        $name_cat = $pos->get_post_by_cat_id($id);
        if ($name_cat) {
            while ($result_name = $name_cat->fetch_assoc()) {
        ?>
                <div class="content_top">
                    <div class="heading">
                        <h3>Category:<?php echo $result_name['title'] ?> </h3>
                    </div>
                    <div class="clear"></div>
            <?php
            }
        }
            ?>
                </div>
                <div class="section group">
                    <?php
                    $postbycat = $pos->get_post_by_cat($id);
                    if ($postbycat) {
                        while ($result = $productbycat->fetch_assoc()) {
                    ?>
                            <div class="grid_1_of_4 images_1_of_4">
                                <a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" width="200px" alt="" /></a>
                                <h2><?php echo $result['productName'] ?> </h2>
                                <p><?php echo $result['title'] ?></p>
                                <p><span class="price"><?php echo $fm->format_currency($result['price']) ?></span></p>
                                <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
                            </div>
                    <?php
                        }
                    } else {
                        echo 'Hiện tại Sản phẩm chưa có';
                    }
                    ?>
                </div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>