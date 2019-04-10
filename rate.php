<?php
include './config/config.php';
$user_id = $_SESSION['id'];
$audio_id = mysqli_real_escape_string($connect, $_GET['id']);
$rate = mysqli_real_escape_string($connect, $_POST['rate']);

$q= mysqli_query($connect, "INSERT INTO user_rate (`user_id`, `audio_id`, `rate`) VALUES ($user_id, $audio_id, $rate)");

header('Location: read.php');