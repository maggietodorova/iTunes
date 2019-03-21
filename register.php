<?php $title = 'Непознатата България / Регистрирай се'; ?>
<?php include('./header.php'); ?>

<h2>Регистрация</h2>
                    <form method="POST" action="register.php">
                        <fieldset class="form-group">
                            <label for="name">Име</label>
                                <input id="name" type="text" class="form-control" required name="name">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="email">Електронна поща</label>
                                <input id="email" type="email" class="form-control" required data-parsley-type="alphanum" data-parsley-type="email" name="email">

                        </fieldset>
                        <fieldset class="form-group">
                            <label for="password" class="col-md-4 control-label">Парола</label>
                                <input id="password" minlength="6" type="password" required class="form-control" name="password">
                            </fieldset>

                            <fieldset class="form-group">
                                <button class="btn btn-primary btn-block" name="submit" required type="submit">Регистрирайте се</button>
                            </fieldset>
                            </form>
                            <?php 
                                if(isset($_POST['submit'])) {
                                    $name= mysqli_real_escape_string($connect, $_POST['name']);
                                    $password=mysqli_real_escape_string($connect, $_POST['password']);
                                    $email=mysqli_real_escape_string($connect, $_POST['email']);
                                    $password=password_hash($password, PASSWORD_DEFAULT);

                                    // Checks
                                     if(empty($name) || empty($password) || empty($email)) {
                                        $_SESSION['errors'][] = 'Всички полета са задължителни.';
                                    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $_SESSION['errors'][] = 'Електронната поща е неправилна.';
                                    if($password < 6) $_SESSION['errors'][] = 'Паролата е прекалено кратка.';
                                    $searchQuery =  "SELECT * FROM `users` WHERE `email` = '$email'"; 
                                    $search = mysqli_query($connect, $searchQuery);

                                        if (mysqli_num_rows($search) > 0) {
                                            $_SESSION['errors'][] = 'Вече съществува такъв потребител.';
                                        }else{
                                            $insert_query ="INSERT INTO users(name, email, password) VALUES ('$name','$email','$password')";
                                        $insert_result= mysqli_query($connect, $insert_query);
                                         $_SESSION['success'] = 'Успешно се регистрирахте.';
                                            header('Location: index.php');
                                        }
                            }         
                            
                            ?>

                    <?php if(isset($_SESSION['errors'])): ?>
                        <ul>
                        <?php foreach($_SESSION['errors'] as $error): ?>
                            <li class="alert alert-danger"><i class="fa fa-exclamation fa-2x" aria-hidden="true"></i><?= $error ?></li>
                        <?php endforeach; ?>
                        </ul>
                         <?php unset($_SESSION['errors']); ?>
                    <?php endif; ?>

<?php include('./footer.php'); ?>



 