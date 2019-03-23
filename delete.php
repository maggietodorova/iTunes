<?php include './config/config.php'; ?>
<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connect, "DELETE FROM `audio` WHERE `id` = $id");
    if($query) {
        header('Location: index.php'); 
    }
} else {
    header('Location: index.php');
}