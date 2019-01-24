<?php require __DIR__.'/views/header.php'; ?>
<div class="jumbotron">


<h4>Update/edit your account</h4>


  <?php
  if ($_SESSION['user']['profile_pic'] === "default.jpg") {
    ?>
        <img class="profile-image" src="/views/img/default.jpg" alt="avatar">
  <?php
  } else {
    ?>
        <img class="profile-image" src="/views/img/<?= $_SESSION['logedin']['profile_pic'];?>" alt="">
    <?php

}
  ?>

<?php
  //Get all user data from db:
  $user_id = $_SESSION['user']['id'];
  $updateUser = getUserProfile($user_id, $pdo);
?>

    <form action="/views/profile.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="image">Choose a profile picture</label></br>
            <input type="file" name="profile_pic" id="image" accept=".jpg", ".jpeg", ".png" required>
        </div>
        <button type="submit" name ="submit">Upload picture</button>
    </form>
</br>

<p class="user-info">Profile information </p>

<form action="app/users/update-user.php" method="post" enctype="multipart/form-data">
  <label for="name">Name</label>
  <input class="" type="text" name="name" value="<?= $updateUser[0]['name'];?>"required>
  <br>
  <label for="bio">Bio</label>
  <input class="" type="text" name="profile_bio" value="<?= $updateUser[0]['profile_bio'];?>"required>
  </br>
  </br>

<p class="user-info">Personal Information </p>
    <label for="firstName">First Name</label>
    <input class="" type="text" name="firstName" value="<?= $updateUser[0]['first_name'];?>"required>
    <br>
    <label for="lastName">Last Name</label>
    <input class="" type="text" name="lastName" value="<?= $updateUser[0]['last_name'];?>"required>
    <br>
    <label for="username">Username</label>
    <input class="" type="text" name="username" value="<?= $updateUser[0]['username'];?>"required>
    <br>
    </br>

    <p class="user-info">Private Information</p>
    <label for="email">Email</label>
    <input class="" type="text" name="email" value="<?= $updateUser[0]['email'];?>"required>
    <br>
    </br>

    <p><b><i>Enter current password to verify changes</i></b></p>
    <label for="password">Password</label>
    <input class="" type="password" name="password" required>
    <br>
    <label for="password">Confirm Password</label>
    <input class="" type="password" name="confirmPassword" required>
    <br>
    <a href="profile.php">
        <button type="submit" class="">Submit</button>
    </a>
</form>
</br>

    <p class="user-info">Password Settings</p>
    <a href="change-password.php">
      <button type="button" name="change-password">Change password</button>
    </a>
    </br></br>

    <p class="user-info">Delete Account</p>

        <form action="app/users/delete-user.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="username">Username</label>
            <input class="" type="text" name="username" required>
          </div><!-- /form-group -->

          <div class="form-group">
            <label for="password">Password</label>
            <input class="" type="password" name="password" required>
          </div><!-- /form-group -->

          <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input class="" type="password" name="confirmPassword" required>

            <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>">
            <button type="submit" name ="submit" class="btn btn-primary">Delete account</button>
          </div>
        </form>
        </br>

<a href="/app/users/logout.php">
    <p class="profile-edit">Logout</p>
</a>

</div>


<?php require __DIR__.'/views/footer.php';?>
