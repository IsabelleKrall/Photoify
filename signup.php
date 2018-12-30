<?php require __DIR__.'/views/header.php';
?>

<h1>Register your account</h1>

<form action="app/users/signup.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" required>
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" id="username" required>
            <small class="form-text text-muted">Please provide the your username (passphrase).</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="name" name="name" id="name" required>
            <small class="form-text text-muted">Please provide the your name (passphrase).</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="r_password">Repeat Password</label>
            <input class="form-control" type="password" name="r_password" id="r_password" required>
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" name ="submit" class="btn btn-primary">Create account</button>
    </form>


<?php require __DIR__.'/views/footer.php'; ?>
