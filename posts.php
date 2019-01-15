<?php require __DIR__.'/views/header.php'; ?>

    <h4>Create a new post</h4>
    <form action="app/posts/posts.php" method="post" enctype="multipart/form-data">

        <p><b>Add photo
        <input type="file" name="content" id="content" type="file" multiple="">
      </b></p></br>
      <p><b>Write something about this photo
        <input type="text" name="description" placeholder="Write something..">
      </b></p><br>
      <input type="hidden" name="username" value="<?php echo $_SESSION['user']['username']?>">
      <button type="submit" name="button">Upload</button>
    </form>

<?php require __DIR__.'/views/footer.php'; ?>
