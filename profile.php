<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
	include_once("connection.php");

	$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=".$_SESSION['id']." ");
?>

<html>
<head>
	<title>Homepage</title>
</head>

<body>
	<a href="index.php">Home</a> | <a href="view.php">View Cars</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	</br>	
	<h1>Account Information</h1>
	<table width='100%' border=0>
		<tr bgcolor='#CCCCCC'>
			<td>Name</td>
			<td>Surname</td>
			<td>Email</td>
            <td>Phone</td>
            <td>City</td>
			<td>Edit</td>
		</tr>
		<?php
		while($res = mysqli_fetch_array($result)) {		
			echo "<tr>";
			echo "<td>".$res['name']."</td>";
            echo "<td>".$res['surname']."</td>";
			echo "<td>".$res['email']."</td>";
			echo "<td>".$res['phone']."</td>";
            echo "<td>".$res['city']."</td>";

			echo "<td><a href=\"editProfile.php?id=$res[id]\">Edit</a> | <a href=\"deleteProfile.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
		}
		?>
	</table>	
</body>
</html>
