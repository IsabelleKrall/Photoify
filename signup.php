<?php require __DIR__.'/views/header.php';
?>

<h1>Register your account</h1>

<form action="app/users/register.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" required>
            <small class="form-text text-muted">Please provide your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" id="username" required>
            <small class="form-text text-muted">Please provide your username.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="firstName">First name</label>
            <input class="form-control" type="text" name="firstName" id="firstName" required>
            <small class="form-text text-muted">Please provide your first name.</small>
        </div>
        <!-- /form-group -->

        <div class="form-group">
            <label for="lastName">Last name</label>
            <input class="form-control" type="text" name="lastName" id="lastName" required>
            <small class="form-text text-muted">Please provide your last name.</small>
        </div>
        <!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text text-muted">Please provide your password.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Confirm Password</label>
            <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" required>
            <small class="form-text text-muted">Please confirm your password.</small>
        </div><!-- /form-group -->

        <button type="submit" name ="submit" class="btn btn-primary">Create account</button>
    </form>


<?php require __DIR__.'/views/footer.php'; ?>
