
<?php include('./header.php'); ?>

<h2>Вход</h2>
                    <form method="POST" action="login.php">
                       <fieldset class="form-group">
                                <label for="email">Електронна поща</label>
                                <input id="email" type="text" class="form-control"name="email" value="" required>
                       </fieldset>
                            
                       <fieldset class="form-group">
                            <label for="password">Парола</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </fieldset>

                        <fieldset class="form-group">
                                <button class="btn btn-primary btn-block" name="submit" type="submit">Влез</button>
                        </fieldset>
                    </form>
                    <?php
                        if(isset($_POST['submit'])):
                            $email = mysqli_real_escape_string($connect, $_POST['email']);
                            $password = mysqli_real_escape_string($connect, $_POST['password']);

                            // Checks
                            if(empty($email) || empty($password)) {
                                $_SESSION['errors'][] = 'Всички полета са задължителни.';
                                
                            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $_SESSION['errors'][] = 'Електронната поща е неправилна.';
                        
                            if(!isset($errors)):
                                $searchQuery = "SELECT * FROM `users` WHERE `email` = '$email'"; 
                                $search = mysqli_query($connect, $searchQuery);
                                $a = mysqli_fetch_assoc($search);
                                if(password_verify($password, $a['password']) && $email === $a['email']) {
                                    session_start();
                                    $_SESSION['name'] = $a['name'];
                                    $_SESSION['id'] = $a['id'];
                                    $_SESSION['is_logged'] = 1;
                                    $_SESSION['success'] = 'Успешно влязохте.';
                                    header('Location: index.php');
                                } else {
                                    $_SESSION['errors'][] = 'Неправилно потребителско име или парола.';
                                }
                            endif;
                        endif;
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
