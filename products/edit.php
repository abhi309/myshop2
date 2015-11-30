<?php include("../includes/header.php"); ?>

<?php
	if(isset($_GET['product_id'])) {
	$id = intval($_GET["product_id"]);
	$query = "SELECT p.product_id, p.name, p.model_no, p.image, p.price, p.color_id, c.color_name, p.width_id, w.width,
			  p.height_id, h.height, p.category_id, ca.category_name, p.company_id, co.company_name FROM products p  
			  LEFT JOIN color 		c 	ON c.color_id 		= p.color_id
			  LEFT JOIN width 		w 	ON w.width_id 		= p.width_id
			  LEFT JOIN height 		h 	ON h.height_id 		= p.height_id
			  LEFT JOIN category 	ca 	ON ca.category_id 	= p.category_id
			  LEFT JOIN company 	co 	ON co.company_id 	= p.company_id
			  WHERE p.product_id = $id";
	$run = mysql_query($query);
	$row = mysql_fetch_array($run);
	if($row) {
		$product_id = $row['product_id'];
		$name = $row['name'];
		$model = $row['model_no'];
		$color_id = $row['color_id'];
		$color_name = $row['color_name'];
		$width_id = $row['width_id'];
		$width_name = $row['width'];
		$height_id = $row['height_id'];
		$height_name = $row['height'];
		$image= $row['image'];
		$price = $row['price'];
		$category_id = $row['category_id'];
		$category_name = $row['category_name'];
		$company_id = $row['company_id'];
		$company_name = $row['company_name'];
?>

<div id="main">
	<hr>
	<form method="post" action="update.php" enctype="multipart/form-data">
		<!-- The outter table to contain the form and the instruction panel --> 
		<table class="outer-table" width="650px" border="0" cellpadding="2px" cellspacing="1px" bgcolor="#FFCC66">
			<tr bgcolor="#FFFFDD">
				<td width="2px" bgcolor="#FFCC66"></td>
				<td width="400px">
					<div class="tableHeading">Edit Product</div>
					<!-- The inner table below is a container for form --> 	
					<table class="product-table"  width="100%" border="0" cellpadding="3px" cellspacing="0">
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
						</tr>
						<tr>
							<td>Name :</td>
							<td><input type="text" name="product_name" value="<?php echo $name; ?>"></td>
						</tr>
						
						<tr>
							<td>Model Number :</td>
							<td><input type="text" name="model_no" value="<?php echo $model; ?>"></td>
						</tr>
						
						<?php $query = "SELECT * FROM color";
							$run = mysql_query($query); ?>
						<tr>
							<td>Color :</td>
							<td><select name="color">
							<option value="<?php echo $color_id; ?>"><?php echo $color_name; ?></option>
							<?php while($row = mysql_fetch_array($run)) {
									$color_id = $row['color_id'];
									$color_name = $row['color_name']; ?>
									<option value="<?php echo $color_id; ?>"><?php echo $color_name; ?></option>
							<?php } ?>
							</select></td>
						</tr>
						
						<?php $query = "SELECT * FROM width";
							$run = mysql_query($query); ?>
						<tr>
							<td>Width :</td>
							<td><select name="width">
							<option value="<?php echo $width_id; ?>"><?php echo $width_name; ?></option>
							<?php while($row = mysql_fetch_array($run)) {
									$width_id = $row['width_id'];
									$width = $row['width'];	?>
									<option value="<?php echo $width_id; ?>"><?php echo $width; ?></option>
							<?php } ?>
							</select></td>
						</tr>
						
						<?php $query = "SELECT * FROM height";
							$run = mysql_query($query); ?>
						<tr>
							<td>Height :</td>
							<td><select name="height">
							<option value="<?php echo $height_id; ?>"><?php echo $height_name; ?></option>
							<?php while($row = mysql_fetch_array($run)) {
									$height_id = $row['height_id'];
									$height = $row['height']; ?>
									<option value="<?php echo $height_id; ?>"><?php echo $height; ?></option>
							<?php } ?>
							</select></td>
						</tr>
						
						<tr>
							<td>Image :</td>
							<td><input type="file" name="image" value="<?php echo $image; ?>"></td>
						</tr>
						
						<tr>
							<td>Price(RS) :</td>
							<td><input type="text" name="price" value="<?php echo $price; ?>"></td>
						</tr>
						
						<?php $query = "SELECT * FROM category";
							$run = mysql_query($query); ?>
						<tr>
							<td>Category :</td>
							<td><select name="category">
							<option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
							<?php while($row = mysql_fetch_array($run)) {
									$category_id = $row['category_id'];
									$category_name = $row['category_name'];	?>
									<option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
							<?php } ?>
							</select></td>
						</tr>
						
						<?php $query = "SELECT * FROM company";
							  $run = mysql_query($query); ?>
						<tr>
							<td>Company :</td>
							<td><select name="company">
							<option value="<?php echo $company_id; ?>"><?php echo $company_name; ?></option>
							<?php while($row = mysql_fetch_array($run)) {
									$company_id = $row['company_id'];
									$company_name = $row['company_name']; ?>
									<option value="<?php echo $company_id; ?>"><?php echo $company_name; ?></option>
							<?php } ?>
							</select></td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr bgcolor="#FFCC66">
				<td>&nbsp;</td>
				<td colspan="2">
					<input type="submit" value="Save" name="submit" class="button">
					<input type="submit" value="Cancel" name="cancel" class="button"> 
				</td>
			</tr>
		</table>
		<?php } } ?>
	</form><hr>
</div>

<?php include("../includes/footer.php"); ?>
