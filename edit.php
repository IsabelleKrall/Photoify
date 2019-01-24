<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
?>


<div class="jumbotron">
    <?php
    $postId = $_GET['id'];
    $singlePost = getSinglePost((int)$postId, $pdo);

    $picFilePath = '/app/uploads/'. $singlePost['content'];
    ?>

  <img class="img-posts" src="<?php echo $picFilePath; ?>">

<form action="app/posts/edit.php"  method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_description">Edit description</label>
    <div class="form-control">

    <textarea type="text" name="post_description" value="<?php echo $singlePost['description']; ?>"> <?php echo $singlePost['description']; ?></textarea></div>
    </div>
<div class="edit">
<button type="submit" class="post" name="post_id" value="<?= $singlePost['id'] ?>">EDIT</button></div>
</form>

<form action="app/posts/delete.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="delete">Delete Post</label>
    </div>
    <div class="delete"><button type="submit" class="post" name="post_id" value="<?= $singlePost['id'] ?>">DELETE</button></div>

</form>

</div>

<?php require __DIR__.'/views/footer.php'; ?>
