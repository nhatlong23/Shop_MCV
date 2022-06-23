<?php
include	'inc/header.php';
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>SAMSUNG</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$getTopBrandSamSung = $product->getTopBrandSamSung();
			if ($getTopBrandSamSung) {
				while ($resultSamsung = $getTopBrandSamSung->fetch_assoc()) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proid=<?php echo $resultSamsung['productId'] ?>"> <img src="admin/uploads/<?php echo $resultSamsung['image'] ?>" alt="" /></a>
					<h2><?php echo $resultSamsung['productName'] ?> </h2>
					<p><?php echo $resultSamsung['title'] ?></p>
					<p><span class="price"><?php echo $fm->format_currency($resultSamsung['price']) . " " . "VND" ?></span></p>
					<div class="button"><span><a href="details.php?proid=<?php echo $resultSamsung['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>APPLE</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$getTopBrandApple = $product->getTopBrandApple();
			if ($getTopBrandApple) {
				while ($resultApple = $getTopBrandApple->fetch_assoc()) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proid=<?php echo $resultApple['productId'] ?>"> <img src="admin/uploads/<?php echo $resultApple['image'] ?>" alt="" /></a>
					<h2><?php echo $resultApple['productName'] ?> </h2>
					<p><?php echo $resultApple['title'] ?></p>
					<p><span class="price"><?php echo $fm->format_currency($resultApple['price']) . " " . "VND" ?></span></p>
					<div class="button"><span><a href="details.php?proid=<?php echo $resultApple['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>DELL</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$getTopBrandDell = $product->getTopBrandDell();
			if ($getTopBrandDell) {
				while ($resultDell = $getTopBrandDell->fetch_assoc()) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proid=<?php echo $resultDell['productId'] ?>"> <img src="admin/uploads/<?php echo $resultDell['image'] ?>" alt="" /></a>
					<h2><?php echo $resultDell['productName'] ?> </h2>
					<p><?php echo $resultDell['title'] ?></p>
					<p><span class="price"><?php echo $fm->format_currency($resultDell['price']) . " " . "VND" ?></span></p>
					<div class="button"><span><a href="details.php?proid=<?php echo $resultDell['productId'] ?>" class="details">Details</a></span></div>
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