<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
}

include_once("connection.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $result = mysqli_query($mysqli, "SELECT image_path FROM items WHERE id=$id");
    $res = mysqli_fetch_array($result);
    $existingImagePath = $res['image_path'];

    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $upload_path = "uploads/";

    if (!empty($file_name)) {

        $unique_name = time() . '_' . $file_name;
        if (move_uploaded_file($file_tmp, $upload_path . $unique_name)) {
            $image_path = $upload_path . $unique_name;
        } else {
            echo "<font color='red'>Error uploading the new image.</font><br/>";
            exit;
        }
    } else {
        $image_path = $existingImagePath;
    }

    $result = mysqli_query($mysqli, "UPDATE items SET title='$title', description='$description', image_path='$image_path' WHERE id=$id");

    if ($result) {
        echo "<font color='green'>Data updated successfully.</font><br/>";
        header("Location: view.php");
    } else {
        echo "<font color='red'>Error updating data.</font><br/>";
    }
}

$id = $_GET['id'];

$result = mysqli_query($mysqli, "SELECT * FROM items WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
    $title = $res['title'];
    $description = $res['description'];
    $image = $res['image_path'];
}
?>

<html>
<head>    
    <title>Edit Data</title>
</head>

<body>
    <a href="index.php">Home</a> | <a href="view.php">View Cars</a> | <a href="logout.php">Logout</a>
    <br/><br/>
    
    <form name="form1" method="post" action="editItem.php" enctype="multipart/form-data">
        <table border="0">
            <tr> 
                <td>Brand</td>
                <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
            </tr>
            <tr> 
                <td>Description</td>
                <td><input type="text" name="description" value="<?php echo $description; ?>"></td>
            </tr>
            <tr> 
                <td>Image</td>
                <td><input type="file" name="image"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>
