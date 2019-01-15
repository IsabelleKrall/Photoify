<?php require __DIR__.'/views/header.php'; ?>

<h1>Photoify</h1>

<?php if (!isset($_SESSION['user'])): ?>
  <h3>Sign up to see photos from your friends
  <a class="" href="/signup.php">Sign up</a></h4>

  <h4>Have an account? <a class="" href="/login.php">Log in</a></h4>
<?php endif;?>
<!-- Redirect to login if user is not logged in: -->

<?php if (isset($_SESSION['user'])): ?>
      <p>Welcome <?php echo $_SESSION['user']['username']; ?>! See the latest posts</p>


      <!-- Newsfeed: -->

      <div class="newsfeed-post-container">

          <div class="posts">

            <?php
            //Get all posts from user_id:
            $statement = $pdo->prepare('SELECT * from Posts ORDER BY created_at DESC');
            // $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
            $statement->execute();
            $newsfeedPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
            // print_r($newsfeedPosts);


            foreach ($newsfeedPosts as $newsfeedPost => $newsfeedPostValue){
              $postFilePath = '/app/uploads/' . $newsfeedPostValue['content'];

              ?>


              <!-- //Add link + make new file/page for users visiting other users -->
              <a href=""><h4><?php echo $newsfeedPostValue['username']?></h4></a>
                <p><?php echo $newsfeedPostValue['created_at']?></p>

                <img class="img-posts" src="<?php echo $postFilePath?>"></br>


                <!-- User comments: -->

                <div class="description">
                    <h3>
                    <?php echo $newsfeedPostValue['description']; ?>
                    </h3>
                </div>

                <b>Comments</b></br>

                <?php
                $statement = $pdo->prepare('SELECT * from Comments WHERE post_id = :post_id');
                $statement->bindParam(':post_id', $newsfeedPostValue['id'], PDO::PARAM_INT);
                $statement->execute();
                $user_comments = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($user_comments as $key => $commentValue) {
                  print_r($commentValue['username'].": ".$commentValue['content'] ."</br>");
                      if($_SESSION['user']['id'] == $commentValue['user_id']) {
                        ?>

                          <a href="edit-comment.php?id=<?php echo $commentValue['id'] ?>">Edit my comment</a>


                      <?php
                      }?> <!-- //end if($_SESSION['user']['id'] == $commentValue['user_id']): -->

                <?php
                }
                ?> <!-- //end foreach ($user_comments as $key => $commentValue): -->


                <form action="/app/posts/comments.php" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_content"><b>Comment on this post:</b></label>
                      <div class="form-control">

                      <textarea type="text" name="post_content" value=""></textarea></div>
                      </div>
                  <div class="edit">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']?>">
                    <input type="hidden" name="post_id" value="<?php echo $newsfeedPostValue['id']?>">
                    <input type="hidden" name="username" value="<?php echo $_SESSION['user']['username']?>">
                  <button type="submit" class="post" >Submit</button></div>
                </form>
              </br></br>

          <?php
        }
          ?> <!-- // end foreach $newsfeedPosts -->

          </div> <!-- //end div class="posts" -->
      </div>


<?php endif; ?> <!-- //User session -->









<?php require __DIR__.'/views/footer.php'; ?>
