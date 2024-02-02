<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
}

include_once("connection.php");

if (isset($_POST['Submit'])) {    
    
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

    $user_id = $_SESSION['id'];
    
    if (empty($title) || empty($description) || empty($_FILES['image']['name'])) {
        echo "<font color='red'>Please fill in all the required fields.</font><br/>";
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } 
    else { 

        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $upload_path = "uploads/";  

        if (move_uploaded_file($file_tmp, $upload_path . $file_name)) {
            $image_path = $upload_path . $file_name;

            $result = mysqli_query($mysqli, "INSERT INTO items(title, description, image_path, user_id) VALUES('$title','$description','$image_path', '$user_id')");

            if ($result) {
                echo "<font color='green'>Item added successfully.</font>";
                echo "<br/><a href='view.php'>View Result</a>";
            } else {
                echo "<font color='red'>Error adding data to the database.</font>";
            }
        } else {
            echo "<font color='red'>Error uploading the image.</font>";
        }
    }
}
?>