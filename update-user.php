<?php require __DIR__.'/views/header.php'; ?>

<h4>Update/edit your account</h4>

<div class="profile-image-container">

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

    <form action="/views/profile.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="image">Choose a profile picture</label></br>
            <input type="file" name="profile_pic" id="image" accept=".jpg", ".jpeg", ".png" required>
        </div>
        <button type="submit" name ="submit">Upload picture</button>
    </form>


<form action="app/users/update-user.php" method="post" enctype="multipart/form-data">
    <label for="firstName">First Name</label>
    <input class="" type="text" name="firstName" value="<?= $_SESSION['user']['first_name'];?>"required>
    <br>
    <label for="lastName">Last Name</label>
    <input class="" type="text" name="lastName" value="<?= $_SESSION['user']['last_name'];?>"required>
    <br>
    <label for="username">Username</label>
    <input class="" type="text" name="username" value="<?= $_SESSION['user']['username'];?>"required>
    <br>
    <label for="bio">Bio</label>
    <input class="" type="text" name="profile_bio" value="<?= $_SESSION['logedin']['profile_bio'];?>"required>
    <br>
    <br><br>
    <p class="private-info">Private Information</p>
    <label for="email">Email</label>
    <input class="" type="text" name="email" value="<?= $_SESSION['user']['email'];?>"required>
    <br>
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
<?php
if(isset($_SESSION['error'])):?>
<?= $_SESSION['error']; ?>
<?php endif;?>
<?php require __DIR__.'/views/footer.php';?>
