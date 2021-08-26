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
<h4>Your profile data</h4>
<pre>Firstname : <?= $user->firstname?></pre>
<pre>Lastname : <?= $user->lastname?></pre>
<pre>Email : <?= $user->email?></pre>
<a href="/update">Update your profile</a>
<?php endif; ?>
</body>
</html>