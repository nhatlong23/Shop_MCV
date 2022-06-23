<?php
ob_start();
include	'inc/header.php';
?>

<?php

if (!isset($_GET['proid']) || $_GET['proid'] == null) {
	echo "<script>window.location = '404.php'</script>";
} else {
	$id = $_GET['proid'];
}
$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
	$productid = $_POST['productid'];
	$insertCompare = $product->insertCompare($productid, $customer_id);
}

$customer_id = Session::get('wishlist');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
	$productid = $_POST['productid'];
	$insertWishlist = $product->insertWishlist($productid, $customer_id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$insertCart = $ct->add_to_cart($quantity, $id);
}

if (isset($_POST['comment_submit'])) {
	$comment_insert = $cs->insert_comment();
}
?>


<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$get_product_details = $product->get_details($id);
			if ($get_product_details) {
				while ($result_details = $get_product_details->fetch_assoc()) {
			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result_details['productName'] ?></h2>
							<p><?php echo $result_details['title'] ?></p>
							<!-- <p><?php echo $fm->textShorten($result_details['product_desc'], 50) ?></p> -->
							<div class="price">
								<p>Price: <span><?php echo $fm->format_currency($result_details['price']) . " " . "VND" ?></span></p>
								<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
								<p>Brand:<span><?php echo $result_details['brandName'] ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="POST">
									<input type="number" class="buyfield" name="quantity" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>
								<?php
								if (isset($AddtoCart)) {
									echo '<span style="color:red;font-size:18px">Sản phẩm đã đưuọc thêm</span>';
								}
								?>
							</div>
							<div class="add-cart">
								<div class="button_details">
									<form action="" method="POST">
										<!-- <a class="buysubmit" href="?wlist=<?php echo $result_details['productId'] ?>">Save to Wishlist</a>
									<a class="buysubmit" href="?compare=<?php echo $result_details['productId'] ?>">Compare Product</a> -->
										<input type="hidden" name="productid" value="<?php echo $result_details['productId'] ?>" />
										<?php
										$login_check = Session::get('customer_login');
										if ($login_check) {
											echo '<input type="submit" class="buysubmit" name="compare" value="Compare Product" />' . '  ';
										} else {
											echo '';
										}
										?>

									</form>

									<form action="" method="POST">
										<!-- <a class="buysubmit" href="?wlist=<?php echo $result_details['productId'] ?>">Save to Wishlist</a>
									<a class="buysubmit" href="?compare=<?php echo $result_details['productId'] ?>">Compare Product</a> -->
										<input type="hidden" name="productid" value="<?php echo $result_details['productId'] ?>" />
										<?php
										$login_check = Session::get('customer_login');
										if ($login_check) {

											echo '<input type="submit" class="buysubmit" name="wishlist" value="Save to Wishlist" />';
										} else {
											echo '';
										}
										?>

									</form>
								</div>
								<?php
								if (isset($insertCompare)) {
									echo $insertCompare;
								}
								?>
								<?php
								if (isset($insertWishlist)) {
									echo $insertWishlist;
								}
								?>
							</div>
						</div>
						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?php echo $result_details['product_desc'] ?></p>
						</div>
					</div>
			<?php
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php
					$getall_Category = $cat->show_category_fondend();
					if ($getall_Category) {
						while ($result_allcat = $getall_Category->fetch_assoc()) {
					?>
							<li><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName'] ?></a></li>
					<?php
						}
					}
					?>
				</ul>
			</div>
		</div>
		<div class="comment">
			<div class="row">
				<div class="col-md-8">
					<h5>Ý kiến sản phẩm</h5>
					<?php
					if (isset($comment_insert)) {
						echo $comment_insert;
					}
					?>
					<form action="" method="POST">
						<p><input type="hidden" value="<?php echo $id ?>" name="product_id_comment"></p>
						<p><input type="text" placeholder="Điền tên" class="form-control" name="comment_Name"></p>
						<p><textarea rows="5" style="resize: none;" placeholder="Bình Luận" class="form-control" name="comment"></textarea></p>
						<p><input type="submit" name="comment_submit" class="btn btn-success" value="Gửi Bình Luận"></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
include	'inc/footer.php';
?>