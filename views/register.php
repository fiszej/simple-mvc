<?php include 'part/head.php'; ?>
<body>
    <div class="container">
            <h2 class="text-center">Register new account</h2>
            <form class="form-control" action="/create" method="POST">
                <label>Firstname</label>
                <input class="form-control" name="firstname" type="text" autocomplete="off" value="<?= $user->firstname ?? ''?>">
                <span class="text-danger">
                    <small>
                        <?= $errors['req']?>
                    </small>
                    </span><br>
                <label>Lastname</label>
                <input class="form-control" name="lastname" type="text" autocomplete="off" value="<?= $user->lastname ?? ''?>">
                <span class="text-danger">
                    <small>
                        <?= $errors['req']?>
                    </small>
                </span><br>
                <label>Email</label>
                <input class="form-control" name="email" type="text" autocomplete="off" value="<?= $user->email ?? ''?>">
                <span class="text-danger">
                    <small>
                        <?= $errors['email'] ?? '';?> 
                        <?= $errors['is_exists'] ?? '';?> 
                    </small>
                </span><br>
                <label>Password</label>
                <input class="form-control" name="passwd" type="password" autocomplete="off" value="<?= $user->passwd ?? ''?>">
                <span class="text-danger">
                    <small>
                    <?= $errors['req'] ?? ''?>
                    <?= $errors['min'] ?? ''?>
                    <?= $errors['max'] ?? ''?>
                    <?= $errors['password'] ?? ''?>
                </small>
                </span><br>
                <label>Password Confirm</label>
                <input class="form-control" name="passwdC" type="password" autocomplete="off" value="<?= $user->passwdC ?? ''?>">
                <span class="text-danger">
                    <small>
                    <?= $errors['req'] ?? ''?>
                    <?= $errors['min'] ?? ''?>
                    <?= $errors['max'] ?? ''?>
                    <?= $errors['password'] ?? ''?>
                    </small>
                </span><br>
                <input class="btn btn-secondary btn-sm" type="submit" name="submit" value="Register">
            </form>
    </div>
</body>
</html>