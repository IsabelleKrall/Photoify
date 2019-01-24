<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';

?>


<p class="change-password"> Change password</p>

<form action="app/users/change-password.php" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input class="" type="text" name="username" required>
  </div><!-- /form-group -->

  <div class="form-group">
    <label for="password">Current Password</label>
    <input class="" type="password" name="password" required>
  </div><!-- /form-group -->

  <div class="form-group">
    <label for="newPassword">New Password</label>
    <input class="" type="password" name="newPassword" required>
  </div><!-- /form-group -->


  <div class="form-group">
    <label for="repNewPassword">Repeat New Password</label>
    <input class="" type="password" name="repNewPassword" required>

    <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>">
    <button type="submit" name ="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</br>

<?php if (isset($_SESSION['message'])):?>
    <p class="message"><?=$_SESSION['message']; unset($_SESSION['message']);?></p>
<?php endif;?>


<a href="profile.php">
  <p class="profile-edit"> Back to profile</p>
</a>





<?php require __DIR__.'/views/footer.php'; ?>
