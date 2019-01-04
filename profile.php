<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
?>



<div class="profile-container">

    <div class="profile-image-container">
         <img class="profile-image" src="/views/img/<?= $_SESSION['logedin']['profile_pic'];?>" alt="">
    </div>

    <form action="/views/profile.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="image">Choose a profile picture</label>
            <input type="file" name="profile_pic" id="image" accept=".jpg", ".jpeg", ".png" required>
        </div>

        <button type="submit" name ="submit">Upload picture</button>
    </form>

    <h1> <?=$_SESSION['user']['username'];?></h1>


  <div class="user-profile">
        <a href="update-user.php">
          <p class="profile-edit">Edit profile</p>
        </a>
        <a href="/app/users/logout.php">
            <p class="profile-edit">Logout</p>
        </a>
  </div>

</div>




<!-- <div class="profile-content">
  <a href="/app/users/editprofile.php">
    <p class="edit-profile">Edit profile</p></a>
  <a href="/password_update.php">
    <p class="change-password"> Change password</p></a>
  <a href="/app/users/logout.php">
    <p class="log-out">Log out</p></a>
</div> -->


</div>


<div class="bio">
    <form action="/app/users/biography.php" method="post" enctype="multipart/form-data">
        <div class="bio-form">
            <p>Name:</p> <!--add echo statement here-->
            <p>Username:</p> <!--add echo statement here-->
            <p>Biography:</p> <!--add echo statement here--> <?php echo $_SESSION['logedin']['profile_bio']; ?></p>
            <textarea class="bio-text" type="user_bio" name="user_bio" id="user_bio"></textarea>
        </div>
    </div>
    <button type="submit">Done</button><br>
</form>
</div>



<?php require __DIR__.'/views/footer.php'; ?>
