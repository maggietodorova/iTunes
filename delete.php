<?php include './config/config.php'; ?>
<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connect, "DELETE FROM `audio` WHERE `audio_id` = $id");
    if($query) {
        header('Location: read.php'); 
    }
} else {
    echo 'err';
}