<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';
// In this file we store comments in the database.


if (isset($_POST['post_content'], $_POST['post_id'], $_POST['user_id'], $_POST['username'])) {
  $user_id = trim(filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT));
  $content = filter_var($_POST['post_content'], FILTER_SANITIZE_STRING);
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $post_id = $_POST['post_id'];
  $statement = $pdo->prepare('INSERT INTO Comments (user_id, content, post_id, username)
  VALUES (:user_id, :content, :post_id, :username)');


    if (!$statement){
        die(var_dump($pdo->errorInfo()));
    };

    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':content', $content, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();
};


redirect('/index.php');
