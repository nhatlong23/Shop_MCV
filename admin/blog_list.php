<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include_once '../classes/post.php'; ?>
<?php include_once '../classes/blog.php'; ?>

<?php
	$blog = new blog();

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$delblog = $pd->del_blog($id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Blog List</h2>
        <div class="block">
		<?php
			if(isset($delpro)){
				echo $delpro;
			}
		?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Desc</th>
					<th>Image</th>
					<th>Category</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$bloglist = $blog->show_blog();
					if($bloglist){
						$i = 0;
						while($result = $bloglist->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['title']?></td>
					<td><?php echo $result['description']?></td>
					<td><img src="uploads/<?php echo $result['image']?> " width="90"> </td>
                    <td><?php echo $result['title']?></td>
					<td><?php 
							if($result['status']==0){
								echo'Hiển thị';
							}else{
								echo 'Ẩn';
							}
					?></td>
					<td><a href="blog_edit.php?id=<?php echo $result['id']?>">Edit</a> || <a href="?id=<?php echo $result['id']?>">Delete</a></td>
				</tr>tbl_product
				<?php
					}
				}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
