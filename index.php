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

<?php include('./footer.php'); ?>