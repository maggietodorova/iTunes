<?php 


include('./header.php'); 

?>
<?php
if(isset($_POST['audio'])) {
    $id = $_POST['id'];
    $audio = $_POST['audio'];
    $q1 = mysqli_query($connect, "UPDATE audio SET downloads = downloads + 1 WHERE audio_id = $id");
    header('Location: uploads/'.$audio);
}
?>
    <?php if(isset($_SESSION['success'])): ?>
        <p class="alert alert-success"><i class="fa fa-check fa-2x" aria-hidden="true"></i><?= $_SESSION['success'] ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <?php
        $result = mysqli_query($connect, 'SELECT * FROM audio INNER JOIN users ON audio.user_id = users.id');
        echo '<table class="table table-hover table-responsive-sm">';
        echo '<thead><tr>';
        echo '<th>Име на песента</th>';
        echo '<th>Изпълнител</th>';
        echo '<th>Потребител</th>';
        echo '<th>Оценка</th>';
        echo '<th>Изтегли</th>';
        echo '<th></th>';
        echo '<th></th>';
        echo '<th></th>';
        echo '<th></th>';
        echo '</thead></tr>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
                echo '<td>' . $row['audio_name']. '</td>';
                echo '<td>' . $row['singer']. '</td>';
                echo '<td>' . $row['name']. '</td>';
               ?>
               <td>
               <?php 
                $q = mysqli_query($connect, "SELECT AVG(rate) FROM user_rate WHERE audio_id = " . $row['audio_id']);
                $r = mysqli_fetch_assoc($q);
                $r = $r['AVG(rate)'];
                if($r !== NULL) {
                    echo "<strong>$r</strong>";
                } else {
                    echo "<strong>0</strong>";
                }
               ?>
               <form action="rate.php?id=<?= $row['audio_id'] ?>" method="POST">
                    <select name="rate" >
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                    <button type="submit" class="btn btn-success">Оцени</button>
               </form>
               </td>
               <?php
                echo '<td>' . $row['downloads']. '</td>';
                ?> <td><audio controls>
                <source src="./uploads/<?= $row['audio'] ?>" type="audio/mpeg">
              Your browser does not support the audio element.
              </audio>
               </td>
               <td>
                <form action="read.php" method="post">
                    <input type="hidden" name="id" value="<?= $row['audio_id'] ?>">
                    <input type="hidden" name="audio" value="<?= $row['audio'] ?>">
                    <input type="submit" class="btn btn-info" value="Свали">
                </form>
               </td>
               <?php
                echo '<td><a class="btn btn-success" href = update.php?id=' .$row['audio_id']. '>Промени</a></td>';
                echo '<td><a class="btn btn-danger" href = delete.php?id=' .$row['audio_id']. '>Изтрий</a></td>';
            echo '</tr>';
        }
        echo '</table>';
        
    ?>

<?php include 'footer.php'; ?>
