<?php require __DIR__.'/views/header.php'; ?>

<h1>Photoify</h1>

<?php if (isset($_SESSION['user'])): ?>
      <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
<?php endif; ?>

<?php if (!isset($_SESSION['user'])): ?>
<h3>Sign up to see photos from your friends
<a class="" href="/signup.php">Sign up</a></h4>



  <h4>Have an account? <a class="" href="/login.php">Log in</a></h4>


    <?php endif;?>


<!-- Redirect to login if user is not logged in: -->




<?php require __DIR__.'/views/footer.php'; ?>
