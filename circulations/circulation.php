<?php include("../includes/header.php"); ?>

<div id="main">
	<div class="filter">
	<?php
		$sql ="SELECT company_id,company_name FROM company";
		try {
			$stmt = $DB->prepare($sql);
			$stmt->execute();
			$results = $stmt->fetchAll();
		} 
		catch(Exception $ex) {
			echo($ex->getMessage());
		}	
	?>
		<select name="product-filter" class="table-filter" onchange="filterCompany(this);">
			<option value="">Filter Company</option>
		<?php foreach ($results as $rs) { ?>
			<option value="<?php echo $rs["company_id"]; ?>"><?php echo $rs["company_name"]; ?></option>
		<?php } ?>
		</select>
	</div>
	<?php
	$query = "SELECT p.product_id, p.name, p.model_no, p.price, s.customer_name,s.date, s.contact,
			  s.email, s.address, ca.category_name, co.company_name FROM products p
			  LEFT JOIN sale		s	ON s.product_id		= p.product_id
			  LEFT JOIN category 	ca 	ON ca.category_id 	= p.category_id
			  LEFT JOIN company 	co 	ON co.company_id 	= p.company_id
			  WHERE p.status = 0 
			  ORDER BY s.sale_id";
	try {
		$stmt = $DB->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll();
	} 
	catch(Exception $ex) {
		echo($ex->getMessage());
	}
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
	<?php
	$query2 = "SELECT COUNT(product_id) FROM products WHERE status = 0";
	try {
		$stmt = $DB->prepare($query2);
		$stmt->execute();
		$rows2 = $stmt->fetchAll();
	} 
	catch(Exception $ex) {
		echo($ex->getMessage());
	}
	foreach($rows2 as $row) {
		$totalSold = $row['COUNT(product_id)'];
	}
	?>
	<div class="totalAmount"><?php echo 'Total Sold: ' .$totalSold; ?></div>
	
	</div>
</div>

<script src="jquery-1.9.0.min.js"></script>
<script>
	function filterCompany(sel) {
		var company_id = sel.options[sel.selectedIndex].value;
		$("#filter-table").html('<h2>set the Table here</h2>');
		$("#output2").html("");
		if (company_id.length > 0) {

			$.ajax({
				type: "POST",
				url: "filter_circulation.php",
				data: "company_id=" + company_id,
				cache: false,
				beforeSend: function() {
					$('#filter-table').html('<img src="loader.gif" alt="" width="24" height="24">');
				},
				success: function(html) {
					$("#filter-table").html(html);
				}
			});
		}
	}
</script>

<?php include("../includes/footer.php"); ?>
