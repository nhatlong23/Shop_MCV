<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
            $getLastestDell = $product->getLastestDell();
            if ($getLastestDell) {
                while ($resultdell = $getLastestDell->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?proid=<?php echo $resultdell['productId'] ?>"> <img src="admin/uploads/<?php echo $resultdell['image'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Dell</h2>
                            <p><?php echo $resultdell['productName'] ?></p>
                            <div class="button"><span><a href="details.php?proid=<?php echo $resultdell['productId'] ?>">Add to cart</a></span></div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            <?php
            $getLastestOppo = $product->getLastestOppo();
            if ($getLastestOppo) {
                while ($resultOppo = $getLastestOppo->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?proid=<?php echo $resultOppo['productId'] ?>"><img src="admin/uploads/<?php echo $resultOppo['image'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>OPPO</h2>
                            <p><?php echo $resultOppo['productName'] ?></p>
                            <div class="button"><span><a href="details.php?proid=<?php echo $resultOppo['productId'] ?>">Add to cart</a></span></div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <div class="section group">
            <?php
            $getLastestApple = $product->getLastestApple();
            if ($getLastestApple) {
                while ($resultApple = $getLastestApple->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?proid=<?php echo $resultApple['productId'] ?>"> <img src="admin/uploads/<?php echo $resultApple['image'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Acer</h2>
                            <p><?php echo $resultApple['productName'] ?></p>
                            <div class="button"><span><a href="details.php?proid=<?php echo $resultApple['productId'] ?>">Add to cart</a></span></div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

            <?php
            $getLastestSamsung = $product->getLastestSamsung();
            if ($getLastestSamsung) {
                while ($resultSamsung = $getLastestSamsung->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                        <a href="details.php?proid=<?php echo $resultSamsung['productId'] ?>"> <img src="admin/uploads/<?php echo $resultSamsung['image'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Samsung</h2>
                            <p><?php echo $resultSamsung['productName'] ?></p>
                            <div class="button"><span><a href="details.php?proid=<?php echo $resultSamsung['productId'] ?>">Add to cart</a></span></div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <?php
                    $get_slider = $product->show_slides();
                    if($get_slider){
                        while ($result_slider = $get_slider->fetch_assoc()) {
                    ?>
                    <li><img src="admin/uploads/<?php echo $result_slider['slider_image'] ?>" alt="<?php echo $result_slider['sliderName'] ?>"/></li>
                    <?php
                    }}
                    ?>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>