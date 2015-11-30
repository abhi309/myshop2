<script>
	function setActive() {
		aObj = document.getElementById('menu').getElementsByTagName('a');
		for(i=0; i<aObj.length; i++) {
			if(document.location.href.indexOf(aObj[i].href) >=0) {
				aObj[i].className='active';
			}
		}
	}
	window.onload = setActive;
</script>
<body>
<div class="sidebar">
	<div class="side-row">
		<div class="side-menu">
			<div class="side sidebar-nav">
				<ul class="nav nav-list">
					<li class="active"><a href="<?php echo "../../myshop2/index.php"; ?>">Dashboard</a></li>
					<li><a href="<?php echo "../../myshop2/stores/store.php"; ?>">Store</a></li>
					<li><a href="<?php echo "../../myshop2/circulations/circulation.php"; ?>">Circulation</a></li>
					<li><a href="<?php echo "../../myshop2/products/add.php"; ?>">Products</a></li>
					<li><a href="<?php echo "../../myshop2/accounts/account.php"; ?>">Accounts</a></li>
					<li><a href="#">Reports</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
