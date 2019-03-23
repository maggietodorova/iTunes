<?php $title = 'Непознатата България / Начало'; ?>
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
if(isset($_POST['submit']))
    {

$path = "audio/"; //file to place within the server
$valid_formats1 = array("mp3", "ogg", "flac"); //list of file extention to be accepted
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
    {
        $file1 = $_FILES['file1']['name']; //input file name in this code is file1
        $size = $_FILES['file1']['size'];

        if(strlen($file1))
            {
                list($txt, $ext) = explode(".", $file1);
                if(in_array($ext,$valid_formats1))
                {
                        $actual_image_name = time() .".".$ext;
                        $tmp = $_FILES['file1']['tmp_name'];
                        if(move_uploaded_file($tmp, $path.$actual_image_name))
                            {   
                                echo '<p class="alert alert-success">Успех!</p>';
                            }
                        else
                            echo "failed";              
                    }
        }
    }
}
?>
<form enctype="multipart/form-data" method="post" action="index.php">
<fieldset class="form-group">
    <p>Аудио</p>
    <input type="file" name="file1" accept=".ogg,.flac,.mp3" required="required"/>
</fieldset>

<input type="submit" value="Качи!" class="btn btn-primary" name="submit"/>
</form>
<audio>
  <source src="audio/1553190003.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
<?php include('./footer.php'); ?>