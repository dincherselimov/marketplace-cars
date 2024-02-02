<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
	include_once("connection.php");

	$result = mysqli_query($mysqli, "SELECT * FROM items WHERE user_id=".$_SESSION['id']." ORDER BY id DESC");
?>

<html>
<head>
	<title>Homepage</title>
	<link rel="stylesheet" type="text/css" href="view.css">
</head>

<body>
	<div class="navigation">

	<a href="index.php" class="nav-button">Home</a> 
	<a href="add.html" class="nav-button">Add New Data</a> 
	<a href="profile.php" class="nav-button">My Profile</a> 
	<a href="logout.php" class="nav-button">Logout</a>

	
	</div>
	<div class="content">
		<h1>Your listed items for sale</h1>
		<table class="data-table">
			<tr class="header-row">
				<td>Title</td>
				<td>Description</td>
				<td>Publication Date</td>
				<td>Image</td>
				<td>Edit</td>
			</tr>
			<?php
			while($res = mysqli_fetch_array($result)) {		
				echo "<tr>";
				echo "<td>".$res['title']."</td>";
				echo "<td>".$res['description']."</td>";
				echo "<td>".$res['publication_date']."</td>";
				echo "<td><img src='".$res['image_path']."' class='item-image'></td>"; // Adjust the width as needed
				echo "<td><a href=\"editItem.php?id=$res[id]\" class='edit-link'>Edit</a> | <a href=\"deleteItem.php?id=$res[id]\" class='delete-link' onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
			}
			?>
		</table>
	</div>
</body>
</html>
