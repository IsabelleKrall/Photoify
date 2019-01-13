<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';
// In this file we edit posts in the database.

if(isset($_POST['content'], $_POST['id'])){
  $newComment  = trim(filter_var($_POST['content'], FILTER_SANITIZE_STRING));
  $id = (int) $_POST['id'];
  $statement = $pdo->prepare('UPDATE Comments SET content = :content WHERE id = :id');


  if (!$statement){
      die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':content', $newComment, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();
}

if(isset($_POST['deletecomment'])){
  $comment_id = trim(filter_var($_POST['deletecomment'], FILTER_SANITIZE_NUMBER_INT));

  $statement = $pdo->prepare('DELETE FROM Comments WHERE id = :id');

if (!$statement){
    die(var_dump($pdo->errorInfo()));
}

$statement->bindParam(':id', $comment_id, PDO::PARAM_INT);
$statement->execute();

}
redirect('/profile.php');
