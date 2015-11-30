<?php include("../includes/header.php"); ?>

<?php
	$id = intval($_GET["product_id"]);
	$query = "DELETE FROM products
			  WHERE product_id = $id";
	
	$result = mysql_query($query) or die("Could not delete" .mysql_error());
		
	//echo "<center><h1>Product deleted successfully</h1></center>";
		
	//redirect to list page;
	echo "<meta http-equiv='refresh' content='0;url=../stores/store.php'>";

?>

<?php include("../includes/footer.php"); ?>
