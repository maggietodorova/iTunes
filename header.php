<?php include('./config/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($title) ? $title : '' ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   
</head>
<body>
        <header>Проект по PHP на Магдалена и Цветелина</header>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Начало</a>
                    </li>
                    <?php if(!isset($_SESSION['name']) && !isset($_SESSION['is_logged'])): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Влез</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Регистрирай се</a>
                    </li>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['name']) && isset($_SESSION['is_logged'])): ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="create.php">Качете аудио</a>
                    </li>

                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link active" href="read.php">Аудио</a>
                    </li>
                    
                    
</ul>
    <main class="p-3">
            
