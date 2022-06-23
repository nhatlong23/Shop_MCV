<?php
include	'inc/header.php';
include	'inc/slider.php';
?>


<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$product_feathered = $product->get_product_feathered();
			if ($product_feathered) {
				while ($result = $product_feathered->fetch_assoc()) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					<h2><?php echo $result['productName'] ?> </h2>
					<p><?php echo $result['title'] ?></p>
					<!-- <p><?php echo $fm->textShorten($result['product_desc'], 50) ?></p> -->
					<p><span class="price"><?php echo $fm->format_currency($result['price']) . " " . "VND" ?></span></p>
					<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$product_new = $product->get_product_new();
			if ($product_new) {
				while ($result_new = $product_new->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php?proid=<?php echo $result_new['productId'] ?>"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
						<h2><?php echo $result_new['productName'] ?> </h2>
						<p><?php echo $result_new['title'] ?></p>
						<!-- <p><?php echo $fm->textShorten($result_new['product_desc'], 50) ?></p> -->
						<p><span class="price"><?php echo $fm->format_currency($result_new['price']) . " " . "VND" ?></span></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div>
			<?php
			$product_all = $product->get_all_product();
			$product_count = mysqli_num_rows($product_all);
			$product_button = $product_count / 3;
			$i = 1;
			for ($i = 1; $i <= $product_button; $i++) {
				echo '<a style="margin 0 5px;" href="index.php?trang='.$i.'"> '.$i.' </a>' ;
			}
			?>
		</div>
	</div>
</div>

<?php
include	'inc/footer.php';
?>