<?php require __DIR__.'/views/header.php'; ?>

<div class="jumbotron">
  <div class="feed">


<?php if (!isset($_SESSION['user'])): ?>

  <h4><a class="" href="/signup.php">Sign up</a> to see photos from your friends</h4>

  <h4>Have an account? <a class="" href="/login.php">Log in</a></h4>
<?php endif;?>
<!-- Redirect to login if user is not logged in: -->

<?php if (isset($_SESSION['user'])): ?>
      <h2>Welcome <?php echo $_SESSION['user']['username']; ?>! See the latest posts.</h2></br></br>


      <!-- Newsfeed: -->

            <?php
            //Get all posts from user_id:
            $statement = $pdo->prepare('SELECT * from Posts ORDER BY created_at DESC');
            // $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
            $statement->execute();
            $newsfeedPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
            // print_r($newsfeedPosts);


            foreach ($newsfeedPosts as $newsfeedPost => $newsfeedPostValue){
              $postFilePath = '/app/uploads/' . $newsfeedPostValue['content'];
              if ($newsfeedPostValue['user_id'] == $_SESSION['user']['id']) {
                ?><h4 class="username"><a href="/profile.php"><?php  echo $newsfeedPostValue['username'];?></a> </h4><?php
              } else {
                ?><a href="/view-profile.php?id=<?=  $newsfeedPostValue['user_id']?>"><h4 class="username"><?php echo $newsfeedPostValue['username']?></h4></a>
                <?php
              }
              ?>

                <!-- <p><?php echo $newsfeedPostValue['created_at']?></p> -->
                <div class="card" style="width: 40rem;">
                <img class="card-img-top" src="<?php echo $postFilePath?>">
                  <div class="card-body">
                    <small class="text-muted"><?= $newsfeedPostValue['created_at']; ?></small>
                  <h4 class="card-title"><?php echo $newsfeedPostValue['description']; ?></h4>
                </div><!--//card-body-->

                <!--comments -->
                <div class="card-body">

                <?php
                $statement = $pdo->prepare('SELECT * from Comments WHERE post_id = :post_id');
                $statement->bindParam(':post_id', $newsfeedPostValue['id'], PDO::PARAM_INT);
                $statement->execute();
                $user_comments = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($user_comments as $key => $commentValue) {
                  print_r($commentValue['username'].": ".$commentValue['content']);
                      if($_SESSION['user']['id'] == $commentValue['user_id']) {
                        ?>
                      </br>

                      <small class="text-muted"><a href="edit-comment.php?id=<?php echo $commentValue['id'] ?>">Edit Comment</a></small></br>

                        <?php
                        }?> <!-- //end if($_SESSION['user']['id'] == $commentValue['user_id']): -->

                <?php
                }
                ?> <!-- //end foreach ($user_comments as $key => $commentValue): -->

              </div><!-- //card-body-->

          <!-- comment section: -->
              <div class="card-body">
                <form action="/app/posts/comments.php" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <h6 class="modal-title">Add a comment...</h6>
                      </div>
                      <!-- <div class="form-control"> -->
                        <div class="form-group">
                          <textarea class="form-control "type="text" name="post_content" value=""></textarea>
                        </div>

                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']?>">
                    <input type="hidden" name="post_id" value="<?php echo $newsfeedPostValue['id']?>">
                    <input type="hidden" name="username" value="<?php echo $_SESSION['user']['username']?>">
                    <button type="submit" class="btn btn-outline-primary" >Submit</button>
                    </form>
                </div><!--//card-body-->

            </div><!--//card-->


              <!-- </br>
            </br>

            </div> -->

          <?php
        }
          ?> <!-- // end foreach $newsfeedPosts -->

      </div><!-- //feed -->
    </div><!-- //jumbotron -->


<?php endif; ?> <!-- //User session -->





</div>
</div>






<?php require __DIR__.'/views/footer.php'; ?>
