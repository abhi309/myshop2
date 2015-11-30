<!DOCTYPE html>
<html>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="<?php echo "../assets/css/style.css"; ?>" type="text/css" />
   <title>My Shop</title>
   <?php include("connection.php"); ?>
</head>

<body>

<div id="topbar">
	<div class="logo">
		<img src="assets/images/logo.png" alt="logo" />
	</div>
	<?php date_default_timezone_set("Asia/Kolkata"); ?>
	<div class="date">
	<?php echo " " . date('l jS F, h:i A'); ?>
	</div>
</div>