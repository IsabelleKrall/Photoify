<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if (isset($_POST['profile_bio'])) {
    $id = $_SESSION['user']['id'];
    $bio = filter_var($_POST['profile_bio'],FILTER_SANITIZE_STRING);
    $statement = $pdo->prepare('UPDATE Users SET profile_bio = :profile_bio WHERE id = :id');

      if (!$statement){
            die(var_dump($pdo->errorInfo()));
      }

      //Binds variables to parameteres for INSERT statement
      $statement->bindParam(':profile_bio', $bio, PDO::PARAM_STR);
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      $statement->execute();
      $statement = $pdo->prepare('SELECT * FROM Users WHERE id = :id');
      $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
      $statement->execute();
      $user = $statement->fetch(PDO::FETCH_ASSOC);

      $_SESSION['logedin'] = [
          'id' => $user['id'],
          'email' => $user['email'],
          'name' => $user['name'],
          'profile_pic' => $user['profile_pic'],
          'profile_bio' => $user['profile_bio'],
          'created_at' => $user['created_at'],
          'username' => $user['username'],
        ];

redirect('/profile.php');
