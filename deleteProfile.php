<?php session_start(); ?>

<?php
	if(!isset($_SESSION['valid'])) {
		header('Location: login.php');
	}
?>

<?php
	include("connection.php");

	$id = $_GET['id'];

	$result=mysqli_query($mysqli, "DELETE FROM users WHERE id=$id");

	session_destroy();

	header("Location:view.php");
?>

