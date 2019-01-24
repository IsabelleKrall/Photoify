<?php require __DIR__.'/views/header.php'; ?>
<div class="jumbotron">
  <div class="postsedit">

    <h2>Create a new post</h2>
    <form action="app/posts/posts.php" method="post" enctype="multipart/form-data">

        <h6>Add photo</h6>
        <input type="file" name="content" id="content" type="file" multiple="">
      </br></br>
      <h6>Write something about this photo</h6>
        <input type="text" name="description" placeholder="Write something..">
      <br>
      <input type="hidden" name="username" value="<?php echo $_SESSION['user']['username']?>">
      <button type="submit" name="button">Upload</button>
    </form>

  </div>
  </div>
<?php require __DIR__.'/views/footer.php'; ?>
