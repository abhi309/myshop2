<?php include("../includes/header.php"); ?>
<div id="main">
	<hr>
	<form method="post" action="add.php" enctype="multipart/form-data">
		<!-- The outter table to contain the form and the instruction panel --> 
		<table class="outer-table" width="650px" border="0" cellpadding="2px" cellspacing="1px" bgcolor="#FFCC66">
			<tr bgcolor="#FFFFDD">
				<td width="2px" bgcolor="#FFCC66"></td>
				<td width="400px">
					<div class="tableHeading">Add Product</div>
					<!-- The inner table below is a container for form -->  
						<table class="product-table" width="100%" border="0" cellpadding="3px" cellspacing="0">
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td>Name :</td>
								<td><input type="text" name="product_name"></td>
							</tr>
							<tr>
								<td>Model Number :</td>
								<td><input type="text" name="model_no"></td>
							</tr>
							<?php
								$query = "SELECT * FROM color";
								$run = mysql_query($query); 
							?>
							<tr>
								<td>Color :</td>
								<td><select name="color">
								<option value="">Select Color</option>
								<?php
									while($row = mysql_fetch_array($run)) {
										$color_id = $row['color_id'];
										$color_name = $row['color_name'];			
								?>
										<option value="<?php echo $color_id; ?>"><?php echo $color_name; ?></option>
								<?php } ?>
								</select></td>
							</tr>
							<?php
								$query = "SELECT * FROM width";
								$run = mysql_query($query); 
							?>
							<tr>
								<td>Width :</td>
								<td><select name="width">
								<option value="">Select Width</option>
								<?php
									while($row = mysql_fetch_array($run)) {
										$width_id = $row['width_id'];
										$width = $row['width'];			
								?>
										<option value="<?php echo $width_id; ?>"><?php echo $width; ?></option>
								<?php } ?>
								</select></td>
							</tr>
							<?php
								$query = "SELECT * FROM height";
								$run = mysql_query($query); 
							?>
							<tr>
								<td>Height :</td>
								<td><select name="height">
								<option value="">Select Height</option>
								<?php
									while($row = mysql_fetch_array($run)) {
										$height_id = $row['height_id'];
										$height = $row['height'];			
								?>
										<option value="<?php echo $height_id; ?>"><?php echo $height; ?></option>
								<?php } ?>
								</select></td>
							</tr>
							<tr>
								<td>Image :</td>
								<td><input type="file" name="image"></td>
							</tr>
							<tr>
								<td>Price :</td>
								<td><input type="text" name="price"></td>
							</tr>
							<?php
								$query = "SELECT * FROM category";
								$run = mysql_query($query); 
							?>
							<tr>
								<td>Category :</td>
								<td><select name="category">
								<option value="">Select Category</option>
								<?php
									while($row = mysql_fetch_array($run)) {
										$category_id = $row['category_id'];
										$category_name = $row['category_name'];			
								?>
										<option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
								<?php } ?>
								</select></td>
							</tr>
							<?php
							
								//$query = "SELECT p.company_id, c.company_name FROM products p
								//		  LEFT JOIN company c ON c.company_id = p.company_id";
								
								$query = "SELECT * FROM company";
								
								$run = mysql_query($query);
								 
							?>
							<tr>
								<td>Company :</td>
								<td><select name="company">
								<option value="">Select Company</option>
								<?php
									while($row = mysql_fetch_array($run)) {
										$company_id = $row['company_id'];
										$company_name = $row['company_name'];			
								?>
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
				</td>
			</tr>
		</table>
	</form><hr>
</div>

<?php 
if(isset($_POST['submit'])) {
	
	$name = $_POST['product_name'];
	$model = $_POST['model_no'];
	$color = $_POST['color'];
	$width = $_POST['width'];
	$height = $_POST['height'];
	$image_name = $_FILES['image']['name'];
	$image_type = $_FILES['image']['type'];
	$image_size = $_FILES['image']['size'];
	$image_tmp = $_FILES['image']['tmp_name'];
	$price = $_POST['price'];
	$category = $_POST['category'];
	$company = $_POST['company'];
							   
	
	if($image_type=="image/jpeg" || $image_type=="image/png" || $image_type=="image/gif") {
		
		if($image_size <= 5000000) {
			move_uploaded_file($image_tmp, "../assets/images/$image_name");
		}
		else {
			echo "<script> alert('Image is larger only 50 kb size is allowed') </script>";
		}
		
	}
	else {
		echo "<script> alert('Image type is invalid') </script>";
	}
	
	$query = "INSERT INTO products(name, model_no, color_id, width_id, height_id, image, price, category_id, company_id)
							   VALUES('$name', '$model', '$color', '$width', '$height', '$image_name', '$price', '$category', '$company')";
							   
	
	$result = mysql_query($query) or die("Could not add" .mysql_error());
		
	echo "<center><h1>Product added successfully</h1></center>";
		
	//redirect to list page;
	//echo "<meta http-equiv='refresh' content='0;url=../products/add.php'>";
		
}

?>


<?php include("../includes/footer.php"); ?>
