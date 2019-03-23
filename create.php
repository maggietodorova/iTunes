<?php include './config/config.php'; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<form action="create.php" method="POST">
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

    <?php
        if(isset($_POST['name'])) {
            $name = $_POST['name'];
            $audio = $_POST['audio'];
            $singer = $_POST['singer'];
            $result = mysqli_query($connect, "INSERT INTO audio(`name`, `audio`, `singer`) VALUES ('$name', '$audio', '$singer')");
            if($result) {
                header('Location: index.php');
            } else {
                echo 'err';
            }
    }
    ?>
</form>