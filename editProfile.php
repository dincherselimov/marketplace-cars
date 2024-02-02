<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
include_once("connection.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
	
	if(empty($name) || empty($surname) || empty($email) || empty($phone) || empty($city)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($surname)) {
			echo "<font color='red'>Surname field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}		
        if(empty($phone)) {
			echo "<font color='red'>Phone field is empty.</font><br/>";
		}	
        if(empty($city)) {
			echo "<font color='red'>City field is empty.</font><br/>";
		}
	} else {	
		$result = mysqli_query($mysqli, "UPDATE users SET name='$name', surname='$surname', email='$email', phone='$phone', city='$city' WHERE id=$id");
		
		header("Location: profile.php");
	}
}
?>
<?php
$id = $_GET['id'];

$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
    $surname = $res['surname'];
	$email = $res['email'];
	$phone = $res['phone'];
	$city = $res['city'];
}
?>
<html>
<head>	
	<title>Edit Profile</title>
</head>

<body>
	<a href="index.php">Home</a> | <a href="view.php">View Cars</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	
	<form name="form1" method="post" action="editProfile.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
            <tr> 
				<td>Surname</td>
				<td><input type="text" name="surname" value="<?php echo $surname;?>"></td>
			</tr>
            <tr> 
				<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $email;?>"></td>
			</tr>
            <tr> 
				<td>Phone</td>
				<td><input type="text" name="phone" value="<?php echo $phone;?>"></td>
			</tr>
            <tr> 
				<td>City</td>
				<td><input type="text" name="city" value="<?php echo $city;?>"></td>
			</tr>
		
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>