<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
$user_id = $_GET['id'];
?>
<div class="jumbotron">
  <div class="profile">
    <div class="profile-container">

      <?php
        $updateUser = getUserProfile($user_id, $pdo);
      ?>

      <div class="visit-profile">
        <img class="profile-img-circle-visit" src="/views/img/<?= $updateUser[0]['profile_pic'];?>" alt="">
          <!--User profile info: -->
          <div class="user-info-box-visit">
                <h2><?= $updateUser[0]['username'];?></h2>
                <h4> <?= $updateUser[0]['name'];?></h4>
                <h3><?= $updateUser[0]['profile_bio'];?></h3>
          </div> <!-- //user-info-box -->

      </div>
    </div> <!--//profile-container-->
  </div><!-- //profile -->

  <div class="profile-content">
    <?php
    //Get all posts from user_id:
    $statement = $pdo->prepare('SELECT * from Posts WHERE user_id = :id');
    $statement->bindParam(':id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

      <?php
          foreach ($user as $key => $value) {
            $picFilePath = '/app/uploads/' . $value['content'];
      ?>

    <div class="card" style="width: 25rem;">
      <img class="card-img-top" src="<?php echo $picFilePath ?>">
        <div class="card-body">
          <small class="text-muted"><?= $value['created_at']; ?></small>
          <h4 class="card-title"><?= $value['description']; ?></h4>

          <?php if (!isset($_SESSION['user'])): ?>
            <a class="btn btn-outline-primary" href="edit.php?id=<?php echo $value['id'] ?>">Edit post</a>
          <?php endif; ?>

        </div><!-- //card-body-->

        <!-- comments -->
        <div class="card-body">
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
                    <small class="text-muted"><a href="edit-comment.php?id=<?php echo $commentValue['id'] ?>">Edit Comment</a></small></br>
                  <?php
                    }
                  }
                ?>
        </div><!-- card body -->

        <!-- comment section: -->
            <div class="card-body">
              <form action="/app/posts/comments.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <h6 class="modal-title">Add a comment...</h6>
                      </div>
                    <div class="form-group">
                      <textarea class="form-control "type="text" name="post_content" value=""></textarea>
                    </div>
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']?>">
                  <input type="hidden" name="post_id" value="<?php echo $value['id']?>">
                  <input type="hidden" name="username" value="<?php echo $_SESSION['user']['username']?>">
                <button type="submit" class="btn btn-outline-primary" >Submit</button>
                </form>
            </div><!-- /card-body-->
    </div><!-- /card-->
            <?php
              };
            ?>

    </div> <!-- //profile-content -->
</div> <!-- //jumbotron -->



<?php require __DIR__.'/views/footer.php'; ?>
