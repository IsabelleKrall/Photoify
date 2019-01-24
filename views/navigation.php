
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Photoify</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor03">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php"><span class="sr-only">(current)</span>Home</a>
      </li><!-- /nav-item -->

    <!-- If user is not logedin -->
      <?php if (!isset($_SESSION['user'])): ?>
        <li class="nav-item active">
          <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/signup.php' ? 'active' : ''; ?>" href="/signup.php">Sign up</a>
        </li><!-- /nav-item -->
      <?php endif;?>

    <!-- If user is logedin -->
      <li class="nav-item active">
        <?php if (isset($_SESSION['user'])): ?>
        </li><!-- /nav-item -->
            <a class="nav-link" href="/profile.php">Profile</a>
            <a class="nav-link" href="/posts.php">Create post</a>
            <a class="nav-link" href="/update-user.php">Account settings</a>
            <a class="nav-link" href="/app/users/logout.php">Logout</a>
        <?php else: ?>
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
        <?php endif; ?>
    </ul><!-- /navbar-nav mr-auto -->
  </div>
</nav><!-- /navbar -->
