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
</head>

<body>
	<a href="index.php">Home</a> | <a href="add.html">Add New Data</a> | <a href="profile.php">My Profile</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	</br>	
	<h1>Your listed items for sale</h1>
	<table width='100%' border=0>
		<tr bgcolor='#CCCCCC'>
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
			echo "<td><img src='".$res['image_path']."' width='100'></td>"; // Adjust the width as needed
			echo "<td><a href=\"editItem.php?id=$res[id]\">Edit</a> | <a href=\"deleteItem.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
		}
		?>
	</table>	
</body>
</html>
