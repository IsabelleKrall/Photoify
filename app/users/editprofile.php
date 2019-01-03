<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';


//Checks if exists in the POST request:
if (isset($_POST['profile_bio'], $_POST['name'], $_POST['email'], $_POST['username'],$_POST['password']){
  if(!isset($_SESSION['user'])){
    redirect('/profile.php')
  } else {
      $id = $_SESSION['user']['id'];
      $bio = trim(filter_var($_POST['profile_bio'],FILTER_SANITIZE_STRING));
      $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
      $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
      $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    $statement = $pdo->prepare('UPDATE Users SET profile_bio = :profile_bio, name = :name, email = :email, username = :username, password = :password
    WHERE id = :id');

        if (!$statement){
          die(var_dump($pdo->errorInfo()));
        }

    //Binds variables to parameteres for insert statement
    $statement->bindParam(':profile_bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
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
        'username' => $user['username'],
        ];

    redirect('/profile.php');
    }
