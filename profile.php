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
            <label for="image">Choose a profile picture</label></br>
            <input type="file" name="profile_pic" id="image" accept=".jpg", ".jpeg", ".png" required>
        </div>
        <button type="submit" name ="submit">Upload picture</button>
    </form>

    <h1> <?=$_SESSION['user']['username'];?></h1>
      <h3>Bio: <?=$_SESSION['logedin']['profile_bio'];?></h3>

  <div class="user-profile">
        <a href="update-user.php">
          <p class="profile-edit">Edit profile</p>
        </a>
        <a href="/app/users/logout.php">
            <p class="profile-edit">Logout</p>
        </a>
  </div> <!--//user-profile-->
</div> <!--//profile-container-->


<a href="posts.php">
  <h1 class="create-post">Create post</h1>
</a>
<h1> POSTS</h1></br>

<div class="user-post-container">

    <div class="posts">
      <?php
      //hämta alla posts ifrån posts där user id är = session user id
      $statement = $pdo->prepare('SELECT * from Posts WHERE user_id = :id');
      $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
      $statement->execute();
      $user = $statement->fetchAll(PDO::FETCH_ASSOC);
      ?>


<?php
      foreach ($user as $key => $value) {
        $picFilePath = '/app/uploads/' . $_SESSION['user']['id'] . '/posts/' . $value['content'];
        ?>

        <!-- //Likes: -->

        <?php
        $likes = getLikes((int)$value['id'], $pdo);
        var_dump($likes);

      ?>

        <form action="app/posts/likes.php"  method="post" enctype="multipart/form-data">
          <button type="submit" name ="like">Like</button>

        </form>


        <img class="img-posts" src="<?php echo $picFilePath ?>"></br>
        <div class="pic-description"><?= $value['description']; ?></div>
        <div class="pic-description"><?= $value['created_at']; ?></div>

        <div class="edit">
          <a href="edit.php?id=<?php echo $value['id'] ?>">Edit post</a>
        </div>
        <?php
      };
      ?>





    </div><!--//posts-->

</div><!--//user-post-container-->











<?php require __DIR__.'/views/footer.php'; ?>
