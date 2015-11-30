<?php include("../index.php"); ?>
<div id="main">
	<h2>Product List</h2><hr>
	<form method="post" action="filter_company.php">
	<div class="filter">
		<?php
		$sql ="SELECT DISTINCT name FROM products";
		try {
			$stmt = $DB->prepare($sql);
			$stmt->execute();
			$results = $stmt->fetchAll();
		} 
		catch(Exception $ex) {
			echo($ex->getMessage());
		}	
		?>
		<select name="product-filter" class="table-filter" onchange="filterName(this);">
			<option value="">Filter Name</option>
		<?php foreach ($results as $rs) { ?>
			<option value="<?php echo $rs["product_id"]; ?>"><?php echo $rs["name"]; ?></option>
		<?php } ?>
		</select>
	</div>
	<?php 
		$query = "SELECT p.product_id, p.name, p.model_no, p.image, p.price, c.color_name,
				  w.width, h.height, ca.category_name, co.company_name FROM products p
				  LEFT JOIN color 		c 	ON c.color_id 		= p.color_id
				  LEFT JOIN width 		w 	ON w.width_id 		= p.width_id
				  LEFT JOIN height 		h 	ON h.height_id 		= p.height_id
				  LEFT JOIN category 	ca 	ON ca.category_id 	= p.category_id
				  LEFT JOIN company 	co 	ON co.company_id 	= p.company_id
				  WHERE p.status = 1
				  ORDER BY p.product_id";
		try {
			$stmt = $DB->prepare($query);
			$stmt->execute();
			$rows = $stmt->fetchAll();
		} 
		catch(Exception $ex) {
			echo($ex->getMessage());
		}
	
	?>
	<table class="store-table" id="order">
		<thead class="thead">
			<tr class="th">
				<th>Name</th>
				<th>Model Number</th>
				<th>Color</th>
				<th>Width</th>
				<th>Height</th>
				<th>Image</th>
				<th>Price (Rs)</th>
				<th>Category</th>
				<th>Company</th>
				<th>Delete</th>
				<th>Edit</th>
				<th>Sale</th>
			</tr>
		</thead>
		<?php foreach($rows as $row) { ?>		
		<tbody class="tbody">
			<tr>		
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['model_no']; ?></td>
				<td><?php echo $row['color_name']; ?></td>
				<td><?php echo $row['width']; ?></td>
				<td><?php echo $row['height']; ?></td>
				<td><?php echo $row['image']; ?></td>
				<td><?php echo $row['price']; ?></td>
				<td><?php echo $row['category_name']; ?></td>
				<td><?php echo $row['company_name']; ?></td>
				<td class ="delete"><a href="../products/delete.php?product_id=<?php echo $row["product_id"]; ?>"
					onclick="return confirm('You are about to delete a record. Are you sure?');">Delete</a></td>
				<td class ="edit"><a href="../products/edit.php?product_id=<?php echo $row["product_id"]; ?>">Edit</a></td>
				<td class ="sale"><a href="../products/sale.php?product_id=<?php echo $row["product_id"]; ?>">Sale</a></td>
			</tr>
		</tbody>
		<?php } ?>
	</table>
		
	<?php
	$query2 = "SELECT COUNT(product_id) FROM products WHERE status = 1";
	try {
		$stmt = $DB->prepare($query2);
		$stmt->execute();
		$rows2 = $stmt->fetchAll();
	} 
	catch(Exception $ex) {
		echo($ex->getMessage());
	}
	foreach($rows2 as $row) {
		$totalProduct = $row['COUNT(product_id)'];
	}
	?>
	<div class="totalAmount"><?php echo 'Total Products: ' .$totalProduct; ?></div>
	</form>
</div>