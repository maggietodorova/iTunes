    <?php include('./header.php'); 
    ?>
    <?php if(isset($_GET['id'])): ?>
    <?php
        $id = $_GET['id'];
        $result = mysqli_query($connect, "SELECT * FROM audio WHERE audio_id = $id");
        while($row = mysqli_fetch_assoc($result)):
    ?>
    <form action="update.php?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
        <fieldset class="form-group">
            <label>Име</label>
            <input type="text" name="audio_name" value="<?= $row['audio_name'] ?>" class="form-control">
        </fieldset>
        <fieldset class="form-group">
    <label>Качи аудио</label>
    <input type="file" name="file1" accept=".ogg,.flac,.mp3">
    </fieldset>
        <fieldset class="form-group">
            <label>Изпълнител</label>
            <input type="text" name="singer" value="<?= $row['singer'] ?>" class="form-control">
        </fieldset>
        <fieldset class="form-group">
            <button class="btn btn-primary" name="submit" type="submit">Update</button>
        </fieldset>
    </form>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php if(isset($_POST['audio_name'])): ?>
    <?php 
        $path = "./uploads/"; //file to place within the server
        $valid_formats1 = array("mp3", "ogg", "flac"); //list of file extention to be accepted
        if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $file1 = $_FILES['file1']['name']; //input file name in this code is file1
                $size = $_FILES['file1']['size'];
                $audio_name = $_POST['audio_name'];
                $singer = $_POST['singer'];
                // Checks
                if(empty($singer) || empty($audio_name)) {
                    $_SESSION['errors'][] = 'Всички полета са задължителни.';
                    
                }
                var_dump($_SESSION['errors']);
                if(empty($_SESSION['errors'])):
                    if($file1) {
                        if(strlen($file1)) {
                            list($txt, $ext) = explode(".", $file1);
                            if(in_array($ext,$valid_formats1)) {
                                    $actual_image_name = time() .".".$ext;
                                    $tmp = $_FILES['file1']['tmp_name'];
                                    if(move_uploaded_file($tmp, $path.$actual_image_name)) {
                                            $audio = $actual_image_name;
            
                                            $result = mysqli_query($connect, "UPDATE audio SET `audio_name` = '$audio_name', `audio` = '$audio', `singer` = '$singer' WHERE `audio_id` = $id");
                                            if($result) {
                                               header('Location: read.php');
                                            } else {
                                                echo 'err';
                                            }
                                    }}}
                    } else {
 
                                            $result = mysqli_query($connect, "UPDATE audio SET `audio_name` = '$audio_name', `singer` = '$singer' WHERE `audio_id` = $id");
                                            if($result) {
                                               header('Location: read.php');
                                            } else {
                                                echo 'err';
                                            }

                    }
                    
                endif;
        }
    ?>

    <?php endif; ?>
    <?php if(isset($_SESSION['errors'])): ?>
                        
                        <?php foreach($_SESSION['errors'] as $error): ?>
                            <p class="mt-3 alert alert-danger"><i class="fa fa-exclamation fa-2x" aria-hidden="true"></i><?= $error ?></p>
                        <?php endforeach; ?>
                        
                         <?php unset($_SESSION['errors']); ?>
                    <?php endif; ?>
    <?php include('./footer.php'); ?>