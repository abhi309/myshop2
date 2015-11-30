<?php include("../includes/header.php"); ?>

<div id="main">
	<h2>Account Detail</h2><hr>
	<?php
	
	$query = "SELECT a.account_id, a.amount, p.product_id, p.name, p.model_no, p.status, 
			  s.customer_name, s.date, s.contact, ca.category_name, co.company_name FROM account a
			  LEFT JOIN sale		s	ON s.product_id		= a.product_id
			  LEFT JOIN products	p	ON p.product_id		= a.product_id
			  LEFT JOIN category 	ca 	ON ca.category_id 	= p.category_id
			  LEFT JOIN company 	co 	ON co.company_id 	= p.company_id
			  WHERE p.status = 0
			  ORDER BY a.account_id";
	try {
		$stmt = $DB->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll();
	} 
	catch(Exception $ex) {
		echo($ex->getMessage());
	}
	?>
	<table class="store-table">
		<thead class="thead">
			<tr class="th">
				<th>Customer Name</th>
				<th>Customer Contact</th>
				<th>Purchase Date</th>
				<th>Product Name</th>
				<th>Model Number</th>
				<th>Category</th>
				<th>Company</th>
				<th>Total Amount (Rs)</th>
			</tr>
		</thead>
		<?php foreach($rows as $row) { ?>
		<tbody class="tbody">
			<tr>
				<td><?php echo $row['customer_name']; ?></td>
				<td><?php echo $row['contact']; ?></td>
				<td><?php echo $row['date']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['model_no']; ?></td>
				<td><?php echo $row['category_name']; ?></td>
				<td><?php echo $row['company_name']; ?></td>
				<td><?php echo $row['amount']; ?></td>
			</tr>	
		</tbody>
		<?php } ?>
	</table>
	<?php
	$query2 = "SELECT SUM(price) FROM products WHERE status = 0";
	try {
		$stmt = $DB->prepare($query2);
		$stmt->execute();
		$rows2 = $stmt->fetchAll();
	} 
	catch(Exception $ex) {
		echo($ex->getMessage());
	}
	foreach($rows2 as $row) {
		$totalAmount = $row['SUM(price)'];
	}
	?>
	<div class="totalAmount"><?php echo 'Total Amount: ' .$totalAmount; ?></div>
</div>
<?php include("../includes/footer.php"); ?>
