<?php include 'part/head.php'?>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <?php if(!isset($_SESSION['user'])) : ?>
        <div class="navbar-nav">
          <a class="nav-link" href="/login">Login</a>
          <a class="nav-link" href="/register">Register</a>
        </div>
    <?php endif; ?>
    <?php if($_SESSION['user']): ?>
      <div class="navbar-nav">
          <a class="nav-link" href="/profile">Profile</a>
          <a class="nav-link" href="/logout">Logout</a>
      </div>
    <?php endif ;?>
    </div>
  </div>
</nav>
<?php if(isset($_SESSION['flash']['403'])) : ?>
    <h2 class="text-danger text-center"><?= $_SESSION['flash']['403'] ?? '' ?></h2>
    <h3 class="text-success text-center"><a href="/login">Login</a></h3>
<?php else: ?>
    <div class="container">
        <h2 class="text-center">Update account</h2>
            <form class="form-control" action="/update" method="POST">
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
                <input class="form-control" name="passwd" type="password" autocomplete="off"">
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
    <?php endif ;?>
</body>
</html>