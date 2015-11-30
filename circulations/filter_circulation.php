<?php
include("../includes/connection.php");

$company_id = ($_REQUEST["company_id"] <> "") ? trim($_REQUEST["company_id"]) : "";

if ($company_id <> "") {
    $query = "SELECT p.product_id, p.name, p.model_no, p.price, s.customer_name,s.date, s.contact,
				  s.email, s.address, ca.category_name, co.company_name FROM products p
				  LEFT JOIN sale		s	ON s.product_id		= p.product_id
				  LEFT JOIN category 	ca 	ON ca.category_id 	= p.category_id
				  LEFT JOIN company 	co 	ON co.company_id 	= p.company_id
				  WHERE p.status = 0 AND co.company_id = '$company_id'
				  ORDER BY s.sale_id";
		try {
			$stmt = $DB->prepare($query);
			//$stmt->bindValue('$company_id', trim($country_id));
			$stmt->execute();
			$rows = $stmt->fetchAll();
		} 
		catch(Exception $ex) {
			echo($ex->getMessage());
		}
    if (count($rows) > 0) {
    ?>
	<div id="filter-table">
	<table class="store-table">
		<thead class="thead">
			<tr class="th">
				<th>Customer Details</th>
				<th>Product Name</th>
				<th>Model Number</th>
				<th>Date</th>
				<th>Price (Rs)</th>
				<th>Category</th>
				<th>Company</th>
				<th>Status</th>
			</tr>
		</thead>
		<?php foreach($rows as $row) { ?>
		<div id="output1"></div>
		<tbody class="tbody">
			<tr>
				<td><?php echo 'Name:  ' . $row['customer_name'] .'<br>'. 'Contact:  ' . $row['contact'] .'<br>'. 'Email:  ' . 
								$row['email'] .'<br>'. 'Address:  ' . $row['address']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['model_no']; ?></td>
				<td><?php echo $row['date']; ?></td>
				<td><?php echo $row['price']; ?></td>
				<td><?php echo $row['category_name']; ?></td>
				<td><?php echo $row['company_name']; ?></td>
				<td class ="sold"><?php echo "Sold"; ?></td>
			</tr>
		</tbody>

	<?php }  ?>
	</table>
	</div>
    <?php
	$query2 = "SELECT COUNT(p.product_id) FROM products p
		LEFT JOIN company co ON co.company_id 	= p.company_id
		WHERE status = 0 AND co.company_id = '$company_id'";
	try {
		$stmt = $DB->prepare($query2);
		$stmt->execute();
		$rows2 = $stmt->fetchAll();
	} 
	catch(Exception $ex) {
		echo($ex->getMessage());
	}
	foreach($rows2 as $row) {
		$totalSold = $row['COUNT(p.product_id)'];
	}
	?>
	<div class="totalAmount"><?php echo 'Total Sold: ' .$totalSold; ?></div>
	<?php
    }
	else { ?>
	<div id="filter-table">
	<table class="store-table">
		<thead class="thead">
			<tr class="th">
				<th>Customer Details</th>
				<th>Product Name</th>
				<th>Model Number</th>
				<th>Date</th>
				<th>Price (Rs)</th>
				<th>Category</th>
				<th>Company</th>
				<th>Status</th>
			</tr>
		</thead>		
		<tbody class="tbody">
			<td style="border: 1px solid #ddd ;"></td>
			<td style="border: 1px solid #ddd ;"></td>
			<td style="border: 1px solid #ddd ;"></td>
			<td style="border: 1px solid #ddd ;"><?php echo "<h2>No products in selected Comapny</h2>"; ?></td>
			<td style="border: 1px solid #ddd ;"></td>
			<td style="border: 1px solid #ddd ;"></td>
			<td style="border: 1px solid #ddd ;"></td>
			<td style="border: 1px solid #ddd ;"></td>
		</tbody>
	</table> 
	</div>
	<?php
		
	}
}
?>