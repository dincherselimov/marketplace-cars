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
	<link rel="stylesheet" type="text/css" href="view.css">
</head>

<body>
	<a href="index.php" class="nav-button">Home</a> 
	<a href="view.php" class="nav-button">View Cars</a> 
	<a href="logout.php" class="nav-button">Logout</a>
	<br/><br/>
	</br>	
	<div class="account-info">
        <h1>Account Information</h1>
        <table class="info-table">
            <tr class="table-header">
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
	</div>
</body>
</html>
