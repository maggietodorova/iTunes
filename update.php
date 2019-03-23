<?php include './config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <?php if(isset($_GET['id'])): ?>
    <?php
        $id = $_GET['id'];
        $result = mysqli_query($connect, "SELECT * FROM audio WHERE id = '$id'");
        while($row = mysqli_fetch_assoc($result)):
    ?>
    <form action="update.php?id=<?= $_GET['id'] ?>" method="POST">
        <fieldset class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
        </fieldset>
        <fieldset class="form-group">
            <label>Audio</label>
            <input type="text" name="audio" class="form-control">
        </fieldset>
        <fieldset class="form-group">
            <label>Singer</label>
            <input type="text" name="singer" class="form-control">
        </fieldset>
        <fieldset class="form-group">
            <button class="btn btn-primary" type="submit">Create</button>
        </fieldset>
    </form>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php if(isset($_POST['name'])): ?>
    <?php 
        $id = $_GET['id'];
        $name = $_POST['name'];
        $audio = $_POST['audio'];
        $singer = $_POST['singer'];
        $query = mysqli_query($connect, "UPDATE audio SET `name` = '$name', `audio` = '$audio', `singer` = '$singer' WHERE `id`= $id");
        if($query) {
            header('Location: index.php');
        } else {
            echo 'err';
        }
    ?>

    <?php endif; ?>
</body>
</html>