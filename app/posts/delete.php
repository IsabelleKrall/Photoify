<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';
// In this file we delete posts in the database.

if(isset($_POST['post_id'])){
  $delete = trim(filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT));

  $statement = $pdo->prepare('DELETE FROM Posts WHERE id = :id');

if (!$statement){
    die(var_dump($pdo->errorInfo()));
}

$statement->bindParam(':id', $delete, PDO::PARAM_INT);
$statement->execute();

}

redirect('/profile.php');
