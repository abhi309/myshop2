<?php include("../includes/header.php"); ?>

<?php
	if(isset($_GET['product_id'])) {
	$product_id = intval($_GET["product_id"]);
	$query1 = "SELECT p.product_id, p.name, p.model_no, p.image, p.price, c.color_name, w.width,
			  h.height, ca.category_name, co.company_name FROM products p  
			  LEFT JOIN color 		c 	ON c.color_id 		= p.color_id
			  LEFT JOIN width 		w 	ON w.width_id 		= p.width_id
			  LEFT JOIN height 		h 	ON h.height_id 		= p.height_id
			  LEFT JOIN category 	ca 	ON ca.category_id 	= p.category_id
			  LEFT JOIN company 	co 	ON co.company_id 	= p.company_id
			  WHERE p.product_id = $product_id";
	$run = mysql_query($query1);
	$row = mysql_fetch_array($run);
	if($row) {
		//$id = $row['product_id'];
		$name = $row['name'];
		$model = $row['model_no'];
		$color_name = $row['color_name'];
		$width_name = $row['width'];
		$height_name = $row['height'];
		$image= $row['image'];
		$price = $row['price'];
		$category_name = $row['category_name'];
		$company_name = $row['company_name'];		
?>

<div id="main">
	<hr>
	<form method="post" action="#" enctype="multipart/form-data">
		<!-- The outter table to contain the form and the instruction panel --> 
		<table class="outer-table" width="650px" border="0" cellpadding="2px" cellspacing="1px" bgcolor="#FFCC66">
			<tr bgcolor="#FFFFDD">
				<td width="2px" bgcolor="#FFCC66"></td>
				<td width="400px">
					<div class="tableHeading">Selling Product</div>
					<!-- The inner table below is a container for form -->
					<table class="customer-table" width="100%" border="0" cellpadding="3px" cellspacing="0">
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td>Name :</td>
							<td><input type="text" name="name"></td>
						</tr>
						<tr>
							<td>Date :</td>
							<td><input type="date" name="date"></td>
						</tr>
						<tr>
							<td>Phone Number :</td>
							<td><input type="text" name="contact"></td>
						</tr>
						<tr>
							<td>Email :</td>
							<td><input type="text" name="email"></td>
						</tr>
						<tr>
							<td>Address :</td>
							<td><textarea name="address"></textarea></td>
						</tr>
					</table>
					<table class="sale-table" width="100%" border="0" cellpadding="3px" cellspacing="0">	
						<tr>
							<input type="hidden" name="product_id">
						</tr>
						<tr>
							<td class="sale-td1">Product Name :</td>
							<td class="sale-td2"><?php echo $name; ?></td>
						</tr>
						<tr>
							<td class="sale-td1">Model Number :</td>
							<td class="sale-td2"><?php echo $model; ?></td>
						</tr>
						<tr>
							<td class="sale-td1">Color :</td>
							<td class="sale-td2"><?php echo $color_name; ?></td>
						</tr>
						<tr>
							<td class="sale-td1">Width :</td>
							<td class="sale-td2"><?php echo $width_name; ?></td>
						</tr>
						<tr>
							<td class="sale-td1">Height :</td>
							<td class="sale-td2"><?php echo $height_name; ?></td>
						</tr>
						<tr>
							<td class="sale-td1">Image :</td>
							<td class="sale-td2"><?php echo $image; ?></td>
						</tr>
						<tr>
							<td class="sale-td1">Price(RS) :</td>
							<td class="sale-td2"><?php echo $price; ?></td>
						</tr>
						<tr>
							<td class="sale-td1">Category :</td>
							<td class="sale-td2"><?php echo $category_name; ?></td>
						</tr>
						<tr>
							<td class="sale-td1">Company :</td>
							<td class="sale-td2"><?php echo $company_name; ?></td>
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
					<input type="submit" value="Sale" name="submit" class="button">
					<input type="submit" value="Cancel" name="cancel" class="button"> 
				</td>
			</tr>
		</table>
		<?php } ?>
	</form><hr>
</div>

<?php
			if(isset($_POST['submit'])) {
				
				$product_id = $_GET['product_id'];
				//$sale_id = $_POST['sale_id'];
				$name = $_POST['name'];
				$date = $_POST['date'];
				$contact = $_POST['contact'];
				$email = $_POST['email'];
				$address = $_POST['address'];
				
				$query2 = "INSERT INTO sale(product_id, customer_name, date, contact, email, address)
						   VALUES('$product_id', '$name', '$date', '$contact', '$email', '$address')";
						 
				$query3 = "UPDATE products SET
						   status = 0
						   WHERE product_id = '$product_id'";

				$query4= "INSERT INTO account(product_id, amount)
						   VALUES('$product_id', '$price')";
						   
				//echo var_dump($query4);
				
				$result2 = mysql_query($query2) or die("Could not insert into sale table" .mysql_error());
				$result3 = mysql_query($query3) or die("Could not update products" .mysql_error());
				$result4 = mysql_query($query4) or die("Could not insert into account table" .mysql_error());
				
				echo "<script>alert('Product Sold successfully')</script>";
				//redirect to list page;
				echo "<meta http-equiv='refresh' content='0;url=../stores/store.php'>";
			}
	
		}
		
		if(isset($_POST['cancel'])) {
			//redirect to list page;
			echo "<meta http-equiv='refresh' content='0;url=../stores/store.php'>";
		}
?>

<?php include("../includes/footer.php"); ?>
