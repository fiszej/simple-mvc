<?php include 'part/head.php'; ?>
<body>
    <div class="container">
            <h2 class="text-center">Login</h2>
            <form class="form-control" action="/login" method="POST">
                <label>Email</label>
                <input class="form-control" name="email" type="text" autocomplete="off">
                <span class="text-danger">
                    <?= $errors['email']?>
                </span><br>
                <label>Password</label>
                <input class="form-control" name="passwd" type="password" autocomplete="off">
                <span class="text-danger">
                    <?= $errors['passwd']?>
                </span><br>
                <input class="btn btn-secondary btn-sm" type="submit" name="submit" value="Register">
            </form>
    </div>
</body>
</html>