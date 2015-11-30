<?php
$company_id = ($_REQUEST["company_id"] <> "") ? trim($_REQUEST["company_id"]) : "";
if ($company_id <> "") {
    $query = "SELECT p.product_id, p.name, p.model_no, p.image, p.price, c.color_name, w.width, h.height, ca.category_name, co.company_name FROM products p
				  LEFT JOIN color 		c 	ON c.color_id 		= p.color_id
				  LEFT JOIN width 		w 	ON w.width_id 		= p.width_id
				  LEFT JOIN height 		h 	ON h.height_id 		= p.height_id
				  LEFT JOIN category 	ca 	ON ca.category_id 	= p.category_id
				  LEFT JOIN company 	co 	ON co.company_id 	= p.company_id
				  WHERE p.status = 1
				  ORDER BY p.product_id";
		$run = mysql_query($query);
		while($row = mysql_fetch_array($run)) {
			$name = $row['name'];
			$model = $row['model_no'];
			$color = $row['color_name'];
			$width = $row['width'];
			$height = $row['height'];
			$image= $row['image'];
			$price = $row['price'];
			$category = $row['category_name'];
			$company = $row['company_name'];
?>

<?php if (count($run) > 0) { ?>

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
		
		<tbody class="tbody">
			<tr>
				<td><?php echo $name; ?></td>
				<td><?php echo $model; ?></td>
				<td><?php echo $color; ?></td>
				<td><?php echo $width; ?></td>
				<td><?php echo $height; ?></td>
				<td><?php echo $image; ?></td>
				<td><?php echo $price; ?></td>
				<td><?php echo $category; ?></td>
				<td><?php echo $company; ?></td>
				<td class ="delete"><a href="../products/delete.php?product_id=<?php echo $row["product_id"]; ?>"
					onclick="return confirm('You are about to delete a record. Are you sure?');">Delete</a></td>
				<td class ="edit"><a href="../products/edit.php?product_id=<?php echo $row["product_id"]; ?>">Edit</a></td>
				<td class ="sale"><a href="../products/sale.php?product_id=<?php echo $row["product_id"]; ?>">Sale</a></td>
			</tr>
		</tbody>
		
<?php	} } ?>
</table>

<?php
}
?>