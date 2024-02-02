<html>
<head>
	<title>Register</title>
</head>

<body>
<a href="index.php">Home</a> <br />
<?php
include("connection.php");

if(isset($_POST['submit'])) {

	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $surname = filter_var($_POST['surname'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = $_POST['phone'];
	$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
	$pass = $_POST['password'];

	if (empty($name) || empty($surname) || empty($email) || empty($phone) || empty($city) || empty($pass) ) {
		echo "All fields should be filled. Either one or many fields are empty.";
		echo "<br/>";
		echo "<a href='register.php'>Go back</a>";
	} else {
		mysqli_query($mysqli, "INSERT INTO users(name, surname, email, phone, city, password) VALUES('$name','$surname','$email', '$phone','$city', md5('$pass'))")
			or die("Could not execute the insert query.");
			
		echo "Registration successfully";
		echo "<br/>";
		echo "<a href='login.php'>Login</a>";
	}
} else {
?>
	<p><font size="+2">Register</font></p>
	<form name="form1" method="post" action="">
		<table width="75%" border="0">
			<tr> 
				<td width="10%">Name</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr> 
				<td>Surname</td>
				<td><input type="text" name="surname"></td>
			</tr>			
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr> 
				<td>Phone Number</td>
				<td><input type="text" name="phone"></td>
			</tr>
			<tr> 
				<td>City</td>
				<td><input type="text" name="city"></td>
			</tr>
			<tr> 
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr> 
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Submit"></td>
			</tr>
		</table>
	</form>
<?php
}
?>
</body>
</html>
