<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Photoify</a>

    <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
      </li><!-- /nav-item -->
      <?php if (!isset($_SESSION['user'])): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/signup.php' ? 'active' : ''; ?>" href="/signup.php">Sign up</a>
        </li><!-- /nav-item -->
      <?php endif;?>

      <li class="nav-item">
    <?php if (isset($_SESSION['user'])): ?>
      </li><!-- /nav-item -->
        <a class="nav-link" href="/profile.php">Profile</a>
        <a class="nav-link" href="/posts.php">Create post</a>
        <a class="nav-link" href="/update-user.php">Account settings</a>
        <a class="nav-link" href="/app/users/logout.php">Logout</a>
    <?php else: ?>
        <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
    <?php endif; ?>
</li><!-- /nav-item -->
</ul><!-- /navbar-nav -->
</nav><!-- /navbar -->
