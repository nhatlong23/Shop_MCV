<?php
include	'inc/header.php';
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check==false) {
	header('Location:login.php');
}
?>


<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>404</h2>

			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
