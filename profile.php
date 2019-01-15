<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
?>

<div class="profile-container">
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


    <h1> <?=$_SESSION['user']['username'];?></h1>
      <h3>About: <?=$_SESSION['logedin']['profile_bio'];?></h3>

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
  <button type="button" name="create-post">Create new post</button>
</a>


<div class="user-post-container">

    <div class="posts">
      <?php
      //Get all posts from user_id:
      $statement = $pdo->prepare('SELECT * from Posts WHERE user_id = :id');
      $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
      $statement->execute();
      $user = $statement->fetchAll(PDO::FETCH_ASSOC);
      ?>


<?php
      foreach ($user as $key => $value) {
        $picFilePath = '/app/uploads/' . $value['content'];
        ?>

        <!-- Likes: -->

        <?php
        // $likes = getLikes((int)$value['id'], $pdo);

        // var_dump($likes);

      ?>

        <!-- <form action="app/posts/likes.php"  method="post" enctype="multipart/form-data">
          <button type="submit" name ="like">Like</button>

        </form> -->

        <!-- //Likes: -->


        <img class="img-posts" src="<?php echo $picFilePath ?>"></br>
        <div class="pic-description"><?= $value['created_at']; ?></div>
        <div class="pic-description"><?= $value['description']; ?></div>

        <div class="edit">
          <a href="edit.php?id=<?php echo $value['id'] ?>">Edit post</a>
        </div




      <!-- comments -->

      <div class="comments"><u><b>Comments:</b></u></div>

      <?php
      $statement = $pdo->prepare('SELECT * from Comments WHERE post_id = :post_id');
      $statement->bindParam(':post_id', $value['id'], PDO::PARAM_INT);
      $statement->execute();
      $user_comments = $statement->fetchAll(PDO::FETCH_ASSOC);

      foreach ($user_comments as $key => $commentValue) {
        print_r($commentValue['username'].": ".$commentValue['content']);
        if($_SESSION['user']['id'] == $commentValue['user_id']){
          ?>
        </br>
            <a href="edit-comment.php?id=<?php echo $commentValue['id'] ?>">Edit Comment</a>
          <?php
        }
      }
      ?>


        <form action="/app/posts/comments.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="post_content"><b>Comment on this post:</b></label>
              <div class="form-control">

              <textarea type="text" name="post_content" value=""></textarea></div>
              </div>
          <div class="edit">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']?>">
            <input type="hidden" name="post_id" value="<?php echo $value['id']?>">
            <input type="hidden" name="username" value="<?php echo $_SESSION['user']['username']?>">
          <button type="submit" class="post" >Submit</button></div>
          </form>
        <?php
      };
      ?>

    </div><!--//posts-->

</div><!--//user-post-container-->











<?php require __DIR__.'/views/footer.php'; ?>
