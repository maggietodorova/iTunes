<?php $title = 'iTunes'; ?>
<?php include('./header.php'); ?>
    <?php if(isset($_SESSION['success'])): ?>
        <p class="alert alert-success"><i class="fa fa-check fa-2x" aria-hidden="true"></i><?= $_SESSION['success'] ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
<?php if(isset($_SESSION['error'])): ?>
        <p class="alert alert-danger"><i class="fa fa-exclamation fa-2x" aria-hidden="true"></i><?= $_SESSION['error'] ?></p>
        <?php unset($_SESSION['error']); ?>
<?php endif; ?>
    <?php if(isset($_SESSION['name']) && isset($_SESSION['is_logged'])): ?>
        <p class="alert alert-info">Привет, <?= $_SESSION['name'] ?>! <a href="logout.php">Излез</a></p>
    <?php endif; ?>
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
        if(empty($_SESSION['errors'])):

            if(strlen($file1)) {
                list($txt, $ext) = explode(".", $file1);
                if(in_array($ext,$valid_formats1)) {
                        $actual_image_name = time() .".".$ext;
                        $tmp = $_FILES['file1']['tmp_name'];
                        if(move_uploaded_file($tmp, $path.$actual_image_name)) {
                                $audio = $actual_image_name;
                                $user =  $_SESSION['id'];
                                $result = mysqli_query($connect, "INSERT INTO audio(`audio_name`, `audio`, `singer`, `user_id`) VALUES ('$audio_name', '$audio', '$singer',  $user)");
                                if($result) {
                                    $_SESSION['success'] = 'Успех!';
                                   header('Location: read.php');
                                } else {
                                    echo 'err';
                                }
                        }}}
        endif;
}
?>
<form action="create.php" method="POST" enctype="multipart/form-data" autocomplete="off">
    <fieldset class="form-group">
        <label>Изпълнител</label>
        <input type="text" name="singer" id="name" class="form-control">
    </fieldset>
    <fieldset class="form-group">
        <label>Име на аудиото</label>
        <input type="text" name="audio_name" id="audio_name" class="form-control">
    </fieldset>
    <fieldset class="form-group">
    <label>Качи аудио</label>
    <input type="file" name="file1" accept=".ogg,.flac,.mp3" required="required"/>
    </fieldset>
<input type="submit" value="Качи!" class="btn btn-primary" name="submit"/>
</form> 
<?php if(isset($_SESSION['errors'])): ?>
                        
                        <?php foreach($_SESSION['errors'] as $error): ?>
                            <p class="mt-3 alert alert-danger"><i class="fa fa-exclamation fa-2x" aria-hidden="true"></i><?= $error ?></p>
                        <?php endforeach; ?>
                        
                         <?php unset($_SESSION['errors']); ?>
                    <?php endif; ?>
<?php include('./footer.php'); ?>