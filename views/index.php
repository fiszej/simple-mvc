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
<?php if(isset($_SESSION['flash'])) : ?>
    <h2 class="text-success text-center"><?= $_SESSION['flash']['success'] ?? '' ?></h2>
    <h2 class="text-success text-center"><?= $_SESSION['user'] ?? '' ?></h2>
    <?php elseif(!isset($_SESSION['user'])) :?>
    <h3 class="text-success text-center"><a href="/login">Login to your account</a></h3>
<?php endif ;?>
</body>
</html>