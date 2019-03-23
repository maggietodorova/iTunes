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
    <a class = "btn btn-success mb-3" href='create.php'>Create</a>
    <?php
        $result = mysqli_query($connect, 'SELECT * FROM audio INNER JOIN users ON audio.user_id = users.id');
        echo '<table border=1>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Audio</th>';
        echo '<th>Singer</th>';
        echo '<th>User</th>';
        echo '<th>Rate</th>';
        echo '<th>Download</th>';
        echo '<th></th>';
        echo '<th></th>';
        echo '<th></th>';
        echo '</tr>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
                echo '<td>' . $row['audio_name']. '</td>';
                echo '<td>' . $row['audio']. '</td>';
                echo '<td>' . $row['singer']. '</td>';
                echo '<td>' . $row['name']. '</td>';
                echo '<td>' . $row['ratings']. '</td>';
                echo '<td>' . $row['downloads']. '</td>';
               ?>
               <td>
                <form action="read.php" method="post">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="audio" value="<?= $row['audio'] ?>">
                    <button name="submit" type="submit">Свали</td>';
                </form>
               </td>
               <?php
                echo '<td><a class="btn btn-success" href = update.php?id=' .$row['id']. '>Update</a></td>';
                echo '<td><a class="btn btn-danger" href = delete.php?id=' .$row['id']. '>Delete</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    ?>

    <?php
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $id = $_POST['audio'];
        $q = mysqli_connect($connect, "UPDATE audio SET downloads = downloads + 1 WHERE id = $id");
        header('Content-Disposition: attachment; filename="' . 'uploads/' . $audio . '"');    }


        ?>
</body>
</html>