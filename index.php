<?php session_start(); ?>
<html>
<head>
	<title>Homepage</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="view.css">
</head>

<body>
	<div id="header">
		Welcome to CarPoint
	</div>
	
	<?php
	if(isset($_SESSION['valid'])) {	

		include("connection.php");					
		$result = mysqli_query($mysqli, "SELECT * FROM users");

	?>
				
		Welcome <?php echo $_SESSION['name'] ?> ! <a class='nav-button' href='logout.php'>Logout</a><br/>
		<br/>
		<a href='view.php' class='nav-button'>View your listed items</a>
			<br/><br/>
	
	<?php	
	} else {
		echo "<a class='nav-button' href='login.php'>Login</a> 
		<a class='nav-button' href='register.php'>Register</a>";
	}
	?>

	<div id="footer">
		<h1>All Cars for sale</h1>
	</div>

	<?php 
	
	include_once("connection.php");

	$result = mysqli_query($mysqli, "SELECT items.*, users.name AS name, users.email AS email, users.phone AS phone 
	FROM items 
	JOIN users ON items.user_id = users.id
	ORDER BY items.id DESC");
	?>
	
	<table class="data-table">
			<tr class="header-row">
				<td>Title</td>
				<td>Description</td>
				<td>Publication Date</td>
				<td>Image</td>
				<td>Seller Name</td>
				<td>Seller Email</td>
				<td>Seller Phone</td>
			</tr>
			<?php
			while ($res = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>".$res['title']."</td>";
				echo "<td>".$res['description']."</td>";
				echo "<td>".$res['publication_date']."</td>";
				echo "<td><img src='".$res['image_path']."' class='item-image'></td>";
				echo "<td>".$res['name']."</td>";
				echo "<td>".$res['email']."</td>";
				echo "<td>".$res['phone']."</td>";
				echo "</tr>";
			}
			?>
		</table>
</body>
</html>
