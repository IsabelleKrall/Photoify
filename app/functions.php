<?php
declare(strict_types=1);
if (!function_exists('redirect')) {

    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

function getPosts(INT $id, $pdo) {
    $statement = $pdo->prepare('SELECT * FROM Posts WHERE user_id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function getSinglePost(INT $id, $pdo) {
    $statement = $pdo->prepare('SELECT * FROM Posts WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $singlePost = $statement->fetch(PDO::FETCH_ASSOC);
    return $singlePost;
}


function getLikes(INT $post_id, $pdo) {
  $statement = $pdo->prepare('SELECT * FROM Likes WHERE post_id = :id');
  $statement->bindParam(':id', $post_id, PDO::PARAM_INT);
  $statement->execute();
  $getLikes = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $getLikes;
}

function getUserProfile($user_id, $pdo) {
  $statement = $pdo->prepare('SELECT * from Users WHERE id = :id');
  $statement->bindParam(':id', $user_id, PDO::PARAM_INT);
  $statement->execute();
  $updateUser = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $updateUser;
}
