<?php require __DIR__.'/views/header.php';
  $user_id = $_GET['id'];
?>

<div class="profile-container">
    <div class="profile-image-container">

    <?php
      $updateUser = getUserProfile($user_id, $pdo);
    ?>

      <!--User profile info -->
      <img class="profile-image" src="/views/img/<?= $updateUser[0]['profile_pic'];?>" alt="">
      <h1> <?= $updateUser[0]['username'];?></h1>
      <h4> <?= $updateUser[0]['name'];?></h4>
      <h2><?= $updateUser[0]['profile_bio'];?></h2>

    </div> <!--//profile-image-container-->
</div><!--//profile-container-->
</br>
</br>

<div class="user-post-container">
    <div class="posts">

      <?php
      //Get all posts from user_id:
      $statement = $pdo->prepare('SELECT * from Posts WHERE user_id = :id');
      $statement->bindParam(':id', $user_id , PDO::PARAM_INT);
      $statement->execute();
      $user = $statement->fetchAll(PDO::FETCH_ASSOC);
      ?>


      <?php
      foreach ($user as $key => $value) {
        $picFilePath = '/app/uploads/' . $value['content'];
      ?>

        <img class="img-posts" src="<?php echo $picFilePath ?>"></br>
        <div class="pic-description"><?= $value['created_at']; ?></div>
        <div class="pic-description"><?= $value['description']; ?></div>

      <?php if (!isset($_SESSION['user'])): ?>
        <div class="edit">
          <a href="edit.php?id=<?php echo $value['id'] ?>">Edit post</a>
        </div

      <?php endif; ?>

      <!-- comments -->

      <div class="comments"><u><b>Comments:</b></u></div>

      <?php
      $statement = $pdo->prepare('SELECT * from Comments WHERE post_id = :post_id');
      $statement->bindParam(':post_id', $value['id'], PDO::PARAM_INT);
      $statement->execute();
      $user_comments = $statement->fetchAll(PDO::FETCH_ASSOC);

      foreach ($user_comments as $key => $commentValue) {
        print_r($commentValue['username'].": ".$commentValue['content']."</br>");
        if($_SESSION['user']['id'] == $commentValue['user_id']){
          ?>



          <?php if (isset($_SESSION['user'])): ?>
            <a href="edit-comment.php?id=<?php echo $commentValue['id'] ?>">Edit my comment</a>
              <?php endif; ?>
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
