<?php
include	'inc/header.php';
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Latest from HUAWEI</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$get_Latest_Huawei = $product->get_Latest_Huawei();
			if ($get_Latest_Huawei) {
				while ($result_Huawei = $get_Latest_Huawei->fetch_assoc()) {
			?>
			<div class="grid_1_of_4 images_1_of_4">
			<a href="details.php?proid=<?php echo $result_Huawei['productId'] ?>"><img src="admin/uploads/<?php echo $result_Huawei['image'] ?>" alt="" /></a>
				<h2><?php echo $result_Huawei['productName'] ?> </h2>
				<p><?php echo $result_Huawei['title'] ?></p>
				<p><span class="price"><?php echo $fm->format_currency($result_Huawei['price']) . " " . "VND" ?></span></p>
				<div class="button"><span><a href="details.php?proid=<?php echo $result_Huawei['productId'] ?>" class="details">Details</a></span></div>
			</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>Latest from OPPO</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
		<?php
			$get_Latest_Oppo = $product->get_Latest_Oppo();
			if ($get_Latest_Oppo) {
				while ($result_Oppo = $get_Latest_Oppo->fetch_assoc()) {
			?>
			<div class="grid_1_of_4 images_1_of_4">
			<a href="details.php?proid=<?php echo $result_Oppo['productId'] ?>"><img src="admin/uploads/<?php echo $result_Oppo['image'] ?>" alt="" /></a>
				<h2><?php echo $result_Oppo['productName'] ?> </h2>
				<p><?php echo $result_Oppo['title'] ?></p>
				<p><span class="price"><?php echo $fm->format_currency($result_Oppo['price']) . " " . "VND" ?></span></p>
				<div class="button"><span><a href="details.php?proid=<?php echo $result_Oppo['productId'] ?>" class="details">Details</a></span></div>
			</div>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>

<?php
include	'inc/footer.php';
?>