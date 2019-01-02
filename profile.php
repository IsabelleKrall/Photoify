<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
?>

<article>
  <?php if (isset($_SESSION['user'])): ?>
      <p>Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>
  <?php endif; ?>
</article>


<!-- //To-do: add statement if pp exist - show pp. -->


<form action="/views/profile.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="image">Choose a profile picture</label>
        <input type="file" name="profile_pic" id="image" accept=".jpg", ".jpeg", ".png" required>
    </div>

    <button type="submit" name ="submit">Upload picture</button>
</form>

<div class="biography">
    <form action="/app/users/bio.php" method="post" enctype="multipart/form-data">
        <div class="bio-form">
            <p>Name:</p> <!--add echo statement here-->
            <p>Username:</p> <!--add echo statement here-->
            <p>Biography:</p> <!--add echo statement here-->
            <textarea class="bio-text" type="user_bio" name="user_bio" id="user_bio"></textarea>
        </div>
    </div>
    <button type="submit">Done</button><br>
</form>
</div>



<?php require __DIR__.'/views/footer.php'; ?>
