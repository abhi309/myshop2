<?php include("../includes/header.php"); ?>
<?php
	if(isset($_POST['submit'])) {
		
		$id = $_POST['product_id'];
		$name = $_POST['product_name'];
		$model = $_POST['model_no'];
		$color = $_POST['color'];
		$width = $_POST['width'];
		$height = $_POST['height'];
		$image = $_FILES['image']['name'];;
		$price = $_POST['price'];
		$category = $_POST['category'];
		$company = $_POST['company'];				   
		
		//$id = intval($_POST["product_id"]);						   
		//foreach ($_POST as $key => $value) $_POST[$key] = mysql_real_escape_string($value);
		$query = "UPDATE products SET
				  name = '$name', model_no = '$model', color_id = '$color', width_id = '$width', height_id = '$height',
				  image = '$image', price = '$price', category_id = '$category', company_id = '$company'
				  WHERE product_id = $id";
								   
		
		$result = mysql_query($query) or die("Could not update" .mysql_error());
		
		//echo "<center><h1>Product updated successfully</h1></center>";
		echo "<script>alert('Product updated successfully')</script>";
		//redirect to list page;
		echo "<meta http-equiv='refresh' content='0;url=../stores/store.php'>";
	}
	
	if(isset($_POST['cancel'])) {
		//redirect to list page;
		echo "<meta http-equiv='refresh' content='0;url=../stores/store.php'>";
	}

?>

<?php include("../includes/footer.php"); ?>