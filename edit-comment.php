<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
?>



    <?php
    $comment_id = $_GET['id'];
    
    $statement = $pdo->prepare('SELECT * FROM Comments WHERE id = :id');
    $statement->bindParam(':id', $comment_id, PDO::PARAM_INT);
    $statement->execute();
    $singleComment = $statement->fetch(PDO::FETCH_ASSOC);
    ?>

    <form class="" action="app/posts/edit-comment.php" method="post">
      <textarea name="content" rows="4" cols="40"><?php echo $singleComment['content'] ?></textarea>
      <input type="hidden" name="id" value="<?php echo $comment_id ?>">
      <button type="submit" name="button">EDIT</button>
    </form>
    <form class="" action="app/posts/edit-comment.php" method="post">
      <input type="hidden" name="deletecomment" value="<?php echo $comment_id ?>">
      <button type="submit" name="button">DELETE</button>
    </form>

<?php require __DIR__.'/views/footer.php'; ?>
